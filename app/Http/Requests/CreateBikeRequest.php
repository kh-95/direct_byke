<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBikeRequest extends FormRequest
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
            'bike_type_id' => 'required|exists:bike_types,id',
            'image_data' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'durations' => 'required|array',
        ];

        return $rules;
    }
}
