<?php

namespace App\Http\Requests;

use App\Models\Lead;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'object_type' => ['nullable', 'string', 'max:50', Rule::in(array_keys(Lead::OBJECT_TYPES))],
            'service' => ['nullable', 'string', 'max:120', Rule::in(Lead::SERVICES)],
            'area' => ['nullable', 'string', 'max:120'],
            'timing' => ['nullable', 'string', 'max:60', Rule::in(Lead::TIMINGS)],
            // Подробното запитване иска изрично съгласие (както в дизайна);
            // кратката контактна форма няма такова поле.
            'consent' => $this->routeIs('quote.store')
                ? ['accepted']
                : ['nullable', 'boolean'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'consent' => $this->boolean('consent'),
        ]);
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'име',
            'phone' => 'телефон',
            'email' => 'имейл',
            'object_type' => 'тип обект',
            'service' => 'услуга',
            'area' => 'район / адрес',
            'timing' => 'предпочитан срок',
            'consent' => 'съгласие',
            'message' => 'описание',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'Полето :attribute е задължително.',
            'accepted' => 'Трябва да се съгласите да се свържем с вас.',
            'email' => 'Въведете валиден имейл адрес.',
            'max' => 'Полето :attribute е твърде дълго.',
            'in' => 'Изберете валидна стойност за :attribute.',
        ];
    }
}
