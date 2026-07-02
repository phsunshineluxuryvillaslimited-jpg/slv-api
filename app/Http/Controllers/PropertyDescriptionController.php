<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneratePropertyDescriptionRequest;
use App\Services\ClaudeClient;
use App\Models\Property;

class PropertyDescriptionController extends Controller
{
    public function __invoke(GeneratePropertyDescriptionRequest $request, Property $property, ClaudeClient $claude)
    {
        $payload = array_merge($property->toArray(), $request->validated());
        $description = $claude->generateDescription($payload);

        return response()->json(['description' => $description]);
    }
}
