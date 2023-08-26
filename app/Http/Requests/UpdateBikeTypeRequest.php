<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBikeTypeRequest extends FormRequest
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
        $id = $this->route('bike_type');
        $rules = [
            'name_ar' => 'required|unique:bike_types,name_ar,' . $id,
            'name_en' => 'required|unique:bike_types,name_en,' . $id,
            'desc_ar' => 'required',
            'desc_en' => 'required',
            'image_data' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        return $rules;
    }
}
