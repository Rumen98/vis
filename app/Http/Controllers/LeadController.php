<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Mail\LeadSubmitted;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function storeContact(StoreLeadRequest $request): RedirectResponse
    {
        return $this->storeLead(
            $request,
            'contact',
            'Получихме запитването. Ще се свържем с вас в най-кратък срок.',
        );
    }

    public function storeQuote(StoreLeadRequest $request): RedirectResponse
    {
        return $this->storeLead(
            $request,
            'quote',
            'Супер - запитването за оферта е изпратено.',
        );
    }

    private function storeLead(
        StoreLeadRequest $request,
        string $source,
        string $successMessage,
    ): RedirectResponse {
        $lead = $this->createLead($request->validated(), $source);

        Mail::to(config('services.leads.notification_email'))->send(new LeadSubmitted($lead));

        return back()->with('success', $successMessage);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function createLead(array $data, string $source): Lead
    {
        return Lead::create([
            ...$data,
            'source' => $source,
        ]);
    }
}
