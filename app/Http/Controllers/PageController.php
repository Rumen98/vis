<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\GalleryImage;
use App\Models\ObjectSolution;
use App\Models\Service;
use App\Models\Solution;
use App\Support\BrandCatalog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

class PageController extends Controller
{
    public function home(): View
    {
        $objectSolutions = ObjectSolution::query()
            ->active()
            ->ordered()
            ->with('solution:id,slug,is_active')
            ->get();

        $homeServices = Service::query()
            ->active()
            ->ordered()
            ->take(4)
            ->get();

        $galleryQuery = GalleryImage::query()->active()->ordered()->orderBy('id');
        $galleryTotal = (clone $galleryQuery)->count();
        $galleryImages = $galleryQuery->forPage(1, GalleryController::PER_PAGE)->get();
        $galleryHasMore = GalleryController::PER_PAGE < $galleryTotal;

        return view('pages.home', compact(
            'objectSolutions',
            'homeServices',
            'galleryImages',
            'galleryHasMore'
        ));
    }

    public function solutions(): View
    {
        $businessSolutions = $this->solutionCollection(Solution::TYPE_BUSINESS);
        $smbSolutions = $this->solutionCollection(Solution::TYPE_SMB);

        $articles = Article::query()
            ->active()
            ->with('solution')
            ->orderByRaw('solution_id is null')
            ->ordered()
            ->get();

        return view('pages.solutions', compact(
            'businessSolutions',
            'smbSolutions',
            'articles'
        ));
    }

    public function why(): View
    {
        return view('pages.why');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function quote(): View
    {
        return view('pages.quote');
    }

    public function tech(BrandCatalog $brandCatalog): View
    {
        return view('pages.tech', [
            'brands' => $brandCatalog->all(),
        ]);
    }

    public function legacyBrandRedirect(string $brand, BrandCatalog $brandCatalog): RedirectResponse
    {
        $brandData = $brandCatalog->find($brand);

        abort_if($brandData === null, 404);

        return redirect()->route('brands.show', ['brand' => $brandData['slug']], 301);
    }

    public function brand(string $brand, BrandCatalog $brandCatalog): View
    {
        $brands = $brandCatalog->all();
        $brandData = $brandCatalog->find($brand);

        abort_if(! $brandData, 404);

        $otherBrands = $brands
            ->reject(fn (array $item) => strcasecmp($item['slug'], $brandData['slug']) === 0)
            ->values();

        return view('pages.brands.show', [
            'brand' => $brandData,
            'otherBrands' => $otherBrands,
        ]);
    }

    private function solutionCollection(string $type): Collection
    {
        return Solution::query()
            ->active()
            ->forType($type)
            ->withActiveArticle()
            ->ordered()
            ->get();
    }
}
