<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class IncomeFormRequest extends FormRequest
{

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
         'amount' => ['required', 'numeric', 'min:100'],
            'income-category' => ['required', 'string'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
      throw new HttpResponseException(response()->json([
          'status' => \Symfony\Component\HttpFoundation\Response::HTTP_UNPROCESSABLE_ENTITY,
          'errors' => $validator->errors()
      ]));
    }
}
