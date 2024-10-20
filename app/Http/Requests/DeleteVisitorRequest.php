<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteVisitorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['int', 'exists:visitors,id'],
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
