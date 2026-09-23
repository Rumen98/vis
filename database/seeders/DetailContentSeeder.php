<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Solution;
use Illuminate\Database\Seeder;
use RuntimeException;

class DetailContentSeeder extends Seeder
{
    /**
     * Populate only missing detail-page content. Existing edits made through the
     * administration panel always take precedence.
     */
    public function run(): void
    {
        $path = database_path('data/detail-content.json');

        if (! is_file($path)) {
            throw new RuntimeException('Missing detail page content source.');
        }

        /** @var array{services: array<int, array<string, mixed>>, solutions: array<int, array<string, mixed>>} $content */
        $content = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        $this->seedCollection($content['services'] ?? [], Service::class);
        $this->seedCollection($content['solutions'] ?? [], Solution::class);
    }

    /**
     * @param array<int, array<string, mixed>> $entries
     * @param class-string<Service|Solution> $modelClass
     */
    private function seedCollection(array $entries, string $modelClass): void
    {
        foreach ($entries as $entry) {
            $model = $modelClass::firstOrNew(['slug' => $entry['slug']]);
            $isNew = ! $model->exists;

            foreach (['title', 'description', 'intro_heading', 'intro_text', 'problems', 'bullets'] as $field) {
                if (($isNew || $this->isMissing($model->{$field})) && array_key_exists($field, $entry)) {
                    $model->{$field} = $entry[$field];
                }
            }

            $model->save();
        }
    }

    private function isMissing(mixed $value): bool
    {
        return $value === null || $value === '' || $value === [];
    }
}
