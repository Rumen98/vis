<h2>Ново запитване ({{ strtoupper($lead->source) }})</h2>

<ul>
    <li><strong>Име:</strong> {{ $lead->name }}</li>
    <li><strong>Телефон:</strong> {{ $lead->phone }}</li>
    <li><strong>Имейл:</strong> {{ $lead->email ?? '—' }}</li>
    <li><strong>Тип обект:</strong> {{ $lead->object_type ?? '—' }}</li>
</ul>

<p><strong>Съобщение:</strong></p>
<p>{{ $lead->message ?: '—' }}</p>

<p style="color:#666;font-size:12px;">
    Създадено: {{ $lead->created_at }}
</p>
