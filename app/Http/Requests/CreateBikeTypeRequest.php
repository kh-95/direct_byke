<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBikeTypeRequest extends FormRequest
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
            'name_ar' => 'required|unique:bike_types,name_ar',
            'name_en' => 'required|unique:bike_types,name_en',
            'desc_ar' => 'required',
            'desc_en' => 'required',
            'image_data' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        return $rules;
    }
}
