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

    public function show(Service $service): View
    {
        abort_unless($service->is_active, 404);

        $related = Service::query()
            ->active()
            ->whereKeyNot($service->getKey())
            ->ordered()
            ->take(3)
            ->get();

        return view('pages.services.show', compact('service', 'related'));
    }
}
