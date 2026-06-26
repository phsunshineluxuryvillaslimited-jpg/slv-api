<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'    => 'required|string|max:200',
            'last_name'     => 'required|string|max:200',
            'email'         => 'required|string|email|max:255|unique:clients,email',
            'mobile_number' => 'nullable|string',
            'phone_number'  =>  'nullable|string',
            'address'       =>  'nullable|string',
            'zipcode'       =>  'nullable|string',
            'nationality'   =>  'nullable|string',
            'id_card_number'=>  'nullable|string',
            'passport_number'=>  'nullable|string',
            'preferred_language' => 'nullable|string',
        ];
    }
}
