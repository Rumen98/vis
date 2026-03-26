<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use App\Models\Solution;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function services()
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        return view('pages.services', compact('services'));
    }

   public function solutions()
    {
        $businessSolutions = Solution::query()
            ->where('is_active', true)
            ->where('solution_type', 'business')
            ->with(['article' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->get();
    
        $smbSolutions = Solution::query()
            ->where('is_active', true)
            ->where('solution_type', 'smb')
            ->with(['article' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->get();
    
        $articles = Article::query()
            ->where('is_active', true)
            ->with('solution')
            ->orderByRaw('solution_id is null')
            ->orderBy('sort_order')
            ->get();
    
        return view('pages.solutions', compact(
            'businessSolutions',
            'smbSolutions',
            'articles'
        ));
    }

    public function why()
    {
        return view('pages.why');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function quote()
    {
        return view('pages.quote');
    }
}