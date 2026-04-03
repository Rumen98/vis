<?php

namespace App\Support;

use DOMDocument;
use DOMXPath;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SplFileInfo;
use ZipArchive;

class BrandCatalog
{
    private const DEFAULT_BUTTON_LABEL = 'Запитване за оферта';

    private const DEFAULT_INTRODUCTION_TITLE = 'Въведение';

    private const DOCUMENT_EXTENSIONS = ['doc', 'docx'];

    private const IMAGE_EXTENSIONS = ['png', 'jpg', 'jpeg', 'webp'];

    private const BRAND_DEFINITIONS = [
        [
            'identifier' => 'HIKVISION',
            'display_name' => 'Hikvision',
            'slug' => 'hikvision',
            'sort_order' => 10,
        ],
        [
            'identifier' => 'DAHUA',
            'display_name' => 'Dahua',
            'slug' => 'dahua',
            'sort_order' => 20,
        ],
        [
            'identifier' => 'AJAX',
            'display_name' => 'Ajax',
            'slug' => 'ajax',
            'sort_order' => 30,
        ],
        [
            'identifier' => 'TP-Link',
            'display_name' => 'TP-Link',
            'slug' => 'tp-link',
            'sort_order' => 40,
        ],
        [
            'identifier' => 'DVC',
            'display_name' => 'DVC',
            'slug' => 'dvc',
            'sort_order' => 50,
        ],
        [
            'identifier' => 'COMELIT',
            'display_name' => 'Comelit',
            'slug' => 'comelit',
            'sort_order' => 60,
        ],
    ];

    private ?Collection $brands = null;

    public static function routeSlugs(): array
    {
        return array_column(self::BRAND_DEFINITIONS, 'slug');
    }

    public static function legacyRouteKeys(): array
    {
        return array_merge(
            array_column(self::BRAND_DEFINITIONS, 'identifier'),
            self::routeSlugs()
        );
    }

    public function all(): Collection
    {
        if ($this->brands instanceof Collection) {
            return $this->brands;
        }

        $source = $this->resolveSource();

        if (! $source) {
            return $this->brands = collect();
        }

        return $this->brands = collect(File::directories($source['directory']))
            ->map(fn (string $directory) => $this->mapBrandDirectory($directory, $source['asset_base']))
            ->filter()
            ->sort(function (array $first, array $second): int {
                $orderComparison = $first['sort_order'] <=> $second['sort_order'];

                if ($orderComparison !== 0) {
                    return $orderComparison;
                }

                return strcasecmp($first['display_name'], $second['display_name']);
            })
            ->values();
    }

    public function find(string $identifierOrSlug): ?array
    {
        $normalizedSearch = Str::lower($identifierOrSlug);

        return $this->all()->first(function (array $brand) use ($normalizedSearch) {
            return Str::lower($brand['identifier']) === $normalizedSearch
                || Str::lower($brand['slug']) === $normalizedSearch;
        });
    }

    private function resolveSource(): ?array
    {
        foreach (config('brand-pages.paths', []) as $source) {
            $directory = $source['directory'] ?? null;

            if ($directory && File::isDirectory($directory)) {
                return $source;
            }
        }

        return null;
    }

    private function mapBrandDirectory(string $directory, string $assetBase): ?array
    {
        $identifier = basename($directory);
        $definition = $this->brandDefinition($identifier);
        $files = collect(File::files($directory));

        if ($files->isEmpty()) {
            return null;
        }

        $imageFiles = $files
            ->filter(fn (SplFileInfo $file) => $this->isImage($file))
            ->values();

        $logoFile = $imageFiles->first(
            fn (SplFileInfo $file) => Str::lower($file->getBasename('.'.$file->getExtension())) === Str::lower($identifier)
        );

        $galleryFiles = $imageFiles
            ->reject(fn (SplFileInfo $file) => $logoFile && $file->getFilename() === $logoFile->getFilename());

        $sortedGalleryFiles = $galleryFiles
            ->sort(function (SplFileInfo $first, SplFileInfo $second): int {
                $sizeComparison = $second->getSize() <=> $first->getSize();

                if ($sizeComparison !== 0) {
                    return $sizeComparison;
                }

                return strcasecmp($first->getFilename(), $second->getFilename());
            })
            ->values();

        $logo = $logoFile
            ? $this->mapMedia($assetBase, $identifier, $definition['display_name'], $logoFile, 'Лого')
            : null;

        $galleryImages = $sortedGalleryFiles
            ->values()
            ->map(fn (SplFileInfo $file, int $index) => $this->mapMedia(
                $assetBase,
                $identifier,
                $definition['display_name'],
                $file,
                'Изображение '.($index + 1)
            ))
            ->all();

        $documentFile = $files->first(
            fn (SplFileInfo $file) => in_array(Str::lower($file->getExtension()), self::DOCUMENT_EXTENSIONS, true)
        );

        $documentData = $this->documentData($documentFile, $definition['display_name']);
        $heroImage = $galleryImages[0] ?? null;
        $sectionImages = array_slice($galleryImages, 1, count($documentData['sections']));
        $trailingImages = array_slice($galleryImages, 1 + count($sectionImages));

        return [
            'identifier' => $identifier,
            'slug' => $definition['slug'],
            'display_name' => $definition['display_name'],
            'sort_order' => $definition['sort_order'],
            'logo' => $logo,
            'hero_image' => $heroImage,
            'section_images' => $sectionImages,
            'trailing_images' => $trailingImages,
            'gallery_images' => $galleryImages,
            'document_title' => $documentData['title'],
            'button_label' => $documentData['button_label'],
            'introduction_title' => $documentData['introduction_title'],
            'introduction_paragraphs' => $documentData['introduction']['paragraphs'],
            'introduction_bullets' => $documentData['introduction']['bullets'],
            'sections' => $documentData['sections'],
        ];
    }

    private function brandDefinition(string $identifier): array
    {
        foreach (self::BRAND_DEFINITIONS as $definition) {
            if (Str::lower($definition['identifier']) === Str::lower($identifier)) {
                return $definition;
            }
        }

        $displayName = str_replace('_', ' ', $identifier);

        return [
            'identifier' => $identifier,
            'display_name' => $displayName,
            'slug' => Str::slug($displayName),
            'sort_order' => 999,
        ];
    }

    private function isImage(SplFileInfo $file): bool
    {
        return in_array(Str::lower($file->getExtension()), self::IMAGE_EXTENSIONS, true);
    }

    private function mapMedia(
        string $assetBase,
        string $identifier,
        string $displayName,
        SplFileInfo $file,
        string $label
    ): array {
        return [
            'file' => $file->getFilename(),
            'asset_path' => $assetBase.'/'.$identifier.'/'.$file->getFilename(),
            'alt' => $displayName.' - '.$label,
            'label' => $label,
        ];
    }

    private function documentData(?SplFileInfo $documentFile, string $displayName): array
    {
        $documentText = $this->extractDocumentText($documentFile);
        $fallback = $this->fallbackDocumentData($displayName);

        if ($documentText === '') {
            return $fallback;
        }

        $lines = collect(preg_split('/\R/u', $documentText) ?: [])
            ->map(fn (string $line) => $this->normalizeDocumentLine($line))
            ->filter()
            ->values()
            ->all();

        if ($lines === []) {
            return $fallback;
        }

        $title = $displayName;
        $buttonLabel = self::DEFAULT_BUTTON_LABEL;
        $introductionTitle = self::DEFAULT_INTRODUCTION_TITLE;
        $introductionLines = [];
        $sections = [];
        $currentSection = null;
        $currentSubsection = null;

        foreach ($lines as $line) {
            if (Str::startsWith($line, 'H1:')) {
                $title = trim(Str::after($line, 'H1:'));

                continue;
            }

            if (Str::startsWith($line, 'CTA бутон:')) {
                $buttonLabel = $this->extractButtonLabel($line);

                continue;
            }

            if (Str::startsWith($line, 'H2:')) {
                $this->finalizeSubsection($currentSubsection, $currentSection);
                $this->finalizeSection($currentSection, $sections);

                $currentSection = [
                    'title' => trim(Str::after($line, 'H2:')),
                    'lines' => [],
                    'subsections' => [],
                ];

                continue;
            }

            if (Str::startsWith($line, 'H3:')) {
                if ($currentSection === null) {
                    continue;
                }

                $this->finalizeSubsection($currentSubsection, $currentSection);

                $currentSubsection = [
                    'title' => trim(Str::after($line, 'H3:')),
                    'lines' => [],
                ];

                continue;
            }

            if ($currentSubsection !== null) {
                $currentSubsection['lines'][] = $line;

                continue;
            }

            if ($currentSection !== null) {
                $currentSection['lines'][] = $line;

                continue;
            }

            if ($line === 'Въведение' && $introductionLines === []) {
                $introductionTitle = $line;

                continue;
            }

            $introductionLines[] = $line;
        }

        $this->finalizeSubsection($currentSubsection, $currentSection);
        $this->finalizeSection($currentSection, $sections);

        return [
            'title' => $title,
            'button_label' => $buttonLabel,
            'introduction_title' => $introductionTitle,
            'introduction' => $this->buildContentBlock($introductionLines),
            'sections' => $sections !== [] ? $sections : $fallback['sections'],
        ];
    }

    private function extractDocumentText(?SplFileInfo $documentFile): string
    {
        if (! $documentFile) {
            return '';
        }

        $documentXml = $this->extractDocumentXml($documentFile->getPathname());

        if ($documentXml !== '') {
            $documentText = $this->extractTextFromDocumentXml($documentXml);

            if ($documentText !== '') {
                return $documentText;
            }
        }

        $rawText = trim(File::get($documentFile->getPathname()));

        return $this->looksLikeStructuredText($rawText) ? $rawText : '';
    }

    private function extractDocumentXml(string $path): string
    {
        if (! class_exists(ZipArchive::class)) {
            return '';
        }

        $zip = new ZipArchive;

        if ($zip->open($path) !== true) {
            return '';
        }

        try {
            $documentXml = $zip->getFromName('word/document.xml');

            return is_string($documentXml) ? $documentXml : '';
        } finally {
            $zip->close();
        }
    }

    private function extractTextFromDocumentXml(string $documentXml): string
    {
        $dom = new DOMDocument;
        $previousUseInternalErrors = libxml_use_internal_errors(true);

        try {
            if (! $dom->loadXML($documentXml)) {
                return '';
            }
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousUseInternalErrors);
        }

        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');

        $paragraphs = [];

        foreach ($xpath->query('//w:body/w:p') as $paragraphNode) {
            $parts = [];

            foreach ($xpath->query('.//w:t', $paragraphNode) as $textNode) {
                $parts[] = $textNode->nodeValue;
            }

            $line = $this->normalizeDocumentLine(implode('', $parts));

            if ($line !== '') {
                $paragraphs[] = $line;
            }
        }

        return implode("\n", $paragraphs);
    }

    private function looksLikeStructuredText(string $rawText): bool
    {
        return Str::contains($rawText, ['H1:', 'H2:', self::DEFAULT_INTRODUCTION_TITLE]);
    }

    private function normalizeDocumentLine(string $line): string
    {
        $normalized = str_replace("\u{00A0}", ' ', $line);
        $normalized = preg_replace('/\s+/u', ' ', $normalized) ?? $normalized;

        return trim($normalized);
    }

    private function extractButtonLabel(string $line): string
    {
        if (preg_match('/[„"](.*?)[“"]/u', $line, $matches) === 1) {
            return trim($matches[1]);
        }

        return self::DEFAULT_BUTTON_LABEL;
    }

    private function finalizeSubsection(?array &$currentSubsection, ?array &$currentSection): void
    {
        if ($currentSubsection === null || $currentSection === null) {
            return;
        }

        $content = $this->buildContentBlock($currentSubsection['lines']);

        $currentSection['subsections'][] = [
            'title' => $currentSubsection['title'],
            'paragraphs' => $content['paragraphs'],
            'bullets' => $content['bullets'],
        ];

        $currentSubsection = null;
    }

    private function finalizeSection(?array &$currentSection, array &$sections): void
    {
        if ($currentSection === null) {
            return;
        }

        $content = $this->buildContentBlock($currentSection['lines']);

        $sections[] = [
            'title' => $currentSection['title'],
            'paragraphs' => $content['paragraphs'],
            'bullets' => $content['bullets'],
            'subsections' => $currentSection['subsections'],
        ];

        $currentSection = null;
    }

    private function buildContentBlock(array $lines): array
    {
        $paragraphs = [];
        $bullets = [];

        foreach ($lines as $line) {
            if ($this->shouldBeParagraph($line, $paragraphs, $bullets)) {
                $paragraphs[] = $line;

                continue;
            }

            $bullets[] = $line;
        }

        return [
            'paragraphs' => $paragraphs,
            'bullets' => $bullets,
        ];
    }

    private function shouldBeParagraph(string $line, array $paragraphs, array $bullets): bool
    {
        if (preg_match('/[.!?…:]["»”]?$/u', $line) === 1) {
            return true;
        }

        if (mb_strlen($line) >= 110) {
            return true;
        }

        return $paragraphs === [] && $bullets === [] && mb_strlen($line) >= 75;
    }

    private function fallbackDocumentData(string $displayName): array
    {
        return [
            'title' => $displayName,
            'button_label' => self::DEFAULT_BUTTON_LABEL,
            'introduction_title' => self::DEFAULT_INTRODUCTION_TITLE,
            'introduction' => [
                'paragraphs' => [
                    "Страницата за {$displayName} е подготвена и очаква финалното текстово съдържание.",
                ],
                'bullets' => [],
            ],
            'sections' => [
                [
                    'title' => 'За марката',
                    'paragraphs' => [
                        "Ще добавим официалното представяне на {$displayName}, за да бъде страницата напълно завършена.",
                    ],
                    'bullets' => [],
                    'subsections' => [],
                ],
            ],
        ];
    }
}
