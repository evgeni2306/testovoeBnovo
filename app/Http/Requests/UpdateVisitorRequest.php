<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateVisitorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['int', 'exists:visitors,id'],
            'name' => ['string', 'max:255'],
            'surname' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:visitors,email'],
            'phone' => ['string', 'max:255', 'unique:visitors,phone', 'regex:/^\+?[1-9][0-9]{7,14}$/'],
            'country' => ['string', 'max:255'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();

        throw new HttpResponseException(
            response()->json(['data' => $errors], 422)
        );
    }
}
