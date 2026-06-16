<?php

namespace App\Models;

use App\Models\Concerns\HasActiveAndSortScopes;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasActiveAndSortScopes;

    protected $fillable = [
        'image',
        'caption',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function imageUrl(): ?string
    {
        // host-relative (работи и локално, и на сървъра), както и при статиите
        return $this->image ? asset('storage/'.$this->image) : null;
    }
}
