<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServicesController extends Controller
{
    public function index(): View
    {
        $services = Service::query()
            ->active()
            ->ordered()
            ->get();

        return view('pages.services', compact('services'));
    }
}
