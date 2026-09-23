<h2>Ново запитване ({{ strtoupper($lead->source) }})</h2>

<ul>
    <li><strong>Име:</strong> {{ $lead->name }}</li>
    <li><strong>Телефон:</strong> {{ $lead->phone }}</li>
    <li><strong>Имейл:</strong> {{ $lead->email ?: '—' }}</li>
    <li><strong>Тип обект:</strong> {{ $lead->objectTypeLabel() ?: '—' }}</li>

    @if (filled($lead->service))
        <li><strong>Услуга:</strong> {{ $lead->service }}</li>
    @endif

    @if (filled($lead->area))
        <li><strong>Район / адрес:</strong> {{ $lead->area }}</li>
    @endif

    @if (filled($lead->timing))
        <li><strong>Предпочитан срок:</strong> {{ $lead->timing }}</li>
    @endif

    @if ($lead->source === 'quote')
        <li><strong>Съгласие за контакт:</strong> {{ $lead->consent ? 'Да' : 'Не' }}</li>
    @endif
</ul>

<p><strong>Съобщение:</strong></p>
<p>{{ $lead->message ?: '—' }}</p>

<p style="color:#666;font-size:12px;">
    Създадено: {{ $lead->created_at }}
</p>
