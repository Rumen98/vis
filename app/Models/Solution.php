<?php

namespace App\Models;

use App\Models\Concerns\HasActiveAndSortScopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Solution extends Model
{
    use HasActiveAndSortScopes;

    public const TYPE_BUSINESS = 'business';

    public const TYPE_SMB = 'smb';

    protected $fillable = [
        'title',
        'slug',
        'solution_type',
        'description',
        'intro_heading',
        'intro_text',
        'featured_image',
        'body',
        'icon',
        'bullets',
        'problems',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'bullets' => 'array',
        'problems' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::updating(function (self $solution): void {
            if ($solution->isDirty('featured_image') && $solution->getOriginal('featured_image')) {
                Storage::disk('public')->delete($solution->getOriginal('featured_image'));
            }
        });

        static::deleting(function (self $solution): void {
            if ($solution->featured_image) Storage::disk('public')->delete($solution->featured_image);
        });
    }

    public function article(): HasOne
    {
        return $this->hasOne(Article::class);
    }

    public function scopeForType(Builder $query, string $type): void
    {
        $query->where('solution_type', $type);
    }

    public function scopeWithActiveArticle(Builder $query): void
    {
        $query->with([
            'article' => static fn ($query) => $query->active(),
        ]);
    }

    public function scopeAvailableForArticle(Builder $query, ?int $currentSolutionId = null): void
    {
        $query->where(function (Builder $query) use ($currentSolutionId): void {
            $query->whereDoesntHave('article');

            if ($currentSolutionId !== null) {
                $query->orWhere($this->getQualifiedKeyName(), $currentSolutionId);
            }
        });
    }

    /**
     * @return array<string, string>
     */
    public static function typeOptions(): array
    {
        return [
            self::TYPE_BUSINESS => 'Бизнес решения',
            self::TYPE_SMB => 'SMB решения',
        ];
    }
}
