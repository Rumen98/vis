<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Contracts\View\View;

class SolutionController extends Controller
{
    public function show(Solution $solution): View
    {
        abort_unless($solution->is_active, 404);

        $related = Solution::query()
            ->active()
            ->forType($solution->solution_type)
            ->whereKeyNot($solution->getKey())
            ->ordered()
            ->take(3)
            ->get();

        return view('pages.solutions.show', compact('solution', 'related'));
    }
}
