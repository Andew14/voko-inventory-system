<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @author Ildefonso Sotelo, Andrew Roy
 */
class StoreInventoryMovementRequest extends FormRequest
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
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:entrada,salida'],
            'quantity' => ['required', 'integer', 'min:1'],
            'observations' => ['nullable', 'string'],
        ];
    }
}
