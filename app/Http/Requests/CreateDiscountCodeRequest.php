<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDiscountCodeRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       $rules = [
        'discount_code' => 'required:unique:discount_codes',
        'rate_discount_code' => 'required:numeric',
        'start_at' => 'required|date',
        'end_at' => 'required|date',
        'start_at' => 'before:end_at',
        'start_at' => 'after:today',
        'end_at' => 'after:today',
       ];

        return $rules;
    }
}
