<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public const PER_PAGE = 8;

    public function load(Request $request): JsonResponse
    {
        $page = max(1, (int) $request->integer('page', 1));

        $query = GalleryImage::query()->active()->ordered()->orderBy('id');

        $total = (clone $query)->count();
        $images = $query->forPage($page, self::PER_PAGE)->get();

        return response()->json([
            'html' => view('partials.gallery-list', ['images' => $images])->render(),
            'hasMore' => ($page * self::PER_PAGE) < $total,
        ]);
    }
}
