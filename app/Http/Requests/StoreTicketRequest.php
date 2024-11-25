<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255', // Cambia i campi in base alla tua tabella
            'description' => 'required|string',
            'operator_id' => 'required|exists:operators,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:open,closed,in-progress', // Enum specifico
        ];
    }
}
