<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfferRequest extends FormRequest
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
        'name_ar' => 'required|unique:regions,name_ar',
        'name_en' => 'required|unique:regions,name_en',
        'percentage' => 'required|numeric',
        'start_at' => 'required|date|before:end_at|after:today',
        'end_at' => 'required|date|after:start_at|after:today',
       ];

        return $rules;
    }
}
