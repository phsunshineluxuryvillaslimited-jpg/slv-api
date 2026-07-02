<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneratePropertyDescriptionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'extra_features' => 'nullable|array',
            'extra_features.*' => 'string',
            'tone' => 'nullable|string',
            'audience' => 'nullable|string',
            'word_count' => 'nullable|integer|min:350|max:5000',
        ];
    }
}
