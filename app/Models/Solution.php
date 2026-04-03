<?php

namespace App\Models;

use App\Models\Concerns\HasActiveAndSortScopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Solution extends Model
{
    use HasActiveAndSortScopes;

    public const TYPE_BUSINESS = 'business';

    public const TYPE_SMB = 'smb';

    protected $fillable = [
        'title',
        'solution_type',
        'description',
        'icon',
        'bullets',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'bullets' => 'array',
        'is_active' => 'boolean',
    ];

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
            'article' => static fn (Builder $query) => $query->active(),
        ]);
    }

    public function scopeAvailableForArticle(Builder $query, ?int $currentSolutionId = null): void
    {
        $query->where(function (Builder $query) use ($currentSolutionId): void {
            $query->whereDoesntHave('article');

            if ($currentSolutionId !== null) {
                $query->orWhereKey($currentSolutionId);
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
