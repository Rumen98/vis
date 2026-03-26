<?php

namespace App\Http\Controllers;

use App\Mail\LeadSubmitted;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function storeContact(Request $request)
    {
        $lead = $this->store($request, 'contact');

        Mail::to('rumenk98@gmail.com')->send(new LeadSubmitted($lead));

        return back()->with('success', 'Получихме запитването. Ще се свържем с вас в най-кратък срок.');
    }

    public function storeQuote(Request $request)
    {
        $lead = $this->store($request, 'quote');

        Mail::to('rumenk98@gmail.com')->send(new LeadSubmitted($lead));

        return back()->with('success', 'Супер — запитването за оферта е изпратено.');
    }

    private function store(Request $request, string $source): Lead
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'object_type' => ['nullable', 'string', 'max:50'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $data['source'] = $source;

        return Lead::create($data);
    }
}