<?php

namespace App\Support;

use App\Models\Service;
use App\Models\Solution;
use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;
use Illuminate\Support\Facades\Storage;

class ExportContentImporter
{
    /** @var array<string, string> */
    private const SERVICE_SLUGS = [
        'videonabliudenie' => 'videonabliudenie',
        'alarmni-sistemi' => 'oxranitelni-sistemi-sot',
        'lan-wifi' => 'lan-i-wi-fi-mrezi',
        'videodomofoni-kontrol-dostap' => 'kontrol-na-dostiepa',
        'parking-resenia' => 'parking-reseniia',
        'strukturno-okabeliavane' => 'struktorno-okabeliavane',
        'abonamentna-poddrazhka' => 'abonamentna-poddriezka',
    ];

    /** @return array{services: int, solutions: int} */
    public function import(string $exportPath): array
    {
        $counts = ['services' => 0, 'solutions' => 0];

        foreach (self::SERVICE_SLUGS as $exportSlug => $slug) {
            $file = $exportPath.'/services/'.$exportSlug.'/index.html';
            $service = Service::query()->where('slug', $slug)->first();
            if ($service && is_file($file)) {
                $this->fillRecord($service, $file, 'services', false);
                $counts['services']++;
            }
        }

        foreach (glob($exportPath.'/solutions/*/index.html') ?: [] as $file) {
            $slug = basename(dirname($file));
            $solution = Solution::query()->where('slug', $slug)->first();
            if ($solution) {
                $this->fillRecord($solution, $file, 'solutions', true);
                $counts['solutions']++;
            }
        }

        return $counts;
    }

    private function fillRecord(Service|Solution $record, string $file, string $directory, bool $hasProblems): void
    {
        $dom = new DOMDocument;
        @$dom->loadHTMLFile($file);
        $xpath = new DOMXPath($dom);

        $hero = $this->first($xpath, "//section[contains(concat(' ', normalize-space(@class), ' '), ' page-hero ')]");
        $detail = $this->first($xpath, "//*[contains(concat(' ', normalize-space(@class), ' '), ' detail-copy ')]");
        $scope = $this->first($xpath, "//*[contains(concat(' ', normalize-space(@class), ' '), ' scope-card ')]");

        $description = $this->text($this->firstRelative($xpath, $hero, './/h1/following-sibling::p[1]'));
        $introHeading = $this->text($this->firstRelative($xpath, $detail, './/h2[1]'));
        $introText = $this->text($this->firstRelative($xpath, $detail, './/h2[1]/following-sibling::p[1]'));
        $scopeItems = $this->scopeItems($xpath, $scope);
        $problems = $hasProblems ? $this->problems($xpath) : [];

        $record->fill(array_filter([
            'description' => $description ?: null,
            'intro_heading' => $introHeading ?: null,
            'intro_text' => $introText ?: null,
            'bullets' => $scopeItems ?: null,
            'problems' => $problems ?: null,
            'featured_image' => $this->importHeroImage($hero, $file, $directory, $record->slug),
        ], static fn ($value) => $value !== null));
        $record->save();
    }

    /** @return list<array{title: string, text: string}> */
    private function scopeItems(DOMXPath $xpath, ?DOMNode $scope): array
    {
        if (! $scope) return [];
        $items = [];
        foreach ($xpath->query('.//*[contains(concat(" ", normalize-space(@class), " "), " scope-item ")]', $scope) ?: [] as $item) {
            $title = $this->text($this->firstRelative($xpath, $item, './/b[1]'));
            $text = $this->text($this->firstRelative($xpath, $item, './/p[1]'));
            if ($title) $items[] = ['title' => $title, 'text' => $text];
        }
        return $items;
    }

    /** @return list<array{title: string, text: string}> */
    private function problems(DOMXPath $xpath): array
    {
        $items = [];
        foreach ($xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' problem-card ')]") ?: [] as $item) {
            $title = $this->text($this->firstRelative($xpath, $item, './/h3[1]'));
            $text = $this->text($this->firstRelative($xpath, $item, './/p[1]'));
            if ($title) $items[] = ['title' => $title, 'text' => $text];
        }
        return $items;
    }

    private function importHeroImage(?DOMNode $hero, string $htmlFile, string $directory, string $slug): ?string
    {
        if (! $hero instanceof DOMElement) return null;
        if (! preg_match("/url\\(['\"]?([^'\")]+)['\"]?\\)/", $hero->getAttribute('style'), $match)) return null;
        $source = realpath(dirname($htmlFile).'/'.$match[1]);
        if (! $source || ! is_file($source)) return null;

        $destination = $directory.'/'. $slug.'-hero.'.pathinfo($source, PATHINFO_EXTENSION);
        Storage::disk('public')->put($destination, file_get_contents($source));

        return $destination;
    }

    private function first(DOMXPath $xpath, string $query): ?DOMNode
    {
        return $xpath->query($query)->item(0);
    }

    private function firstRelative(DOMXPath $xpath, ?DOMNode $context, string $query): ?DOMNode
    {
        return $context ? $xpath->query($query, $context)->item(0) : null;
    }

    private function text(?DOMNode $node): string
    {
        return $node ? trim(preg_replace('/\s+/u', ' ', $node->textContent) ?? '') : '';
    }
}
