<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBikeRequest extends FormRequest
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
        $id = $this->route('user');
        $rules = [
            'name_ar' => 'required|unique:regions,name_ar,' . $id,
            'name_en' => 'required|unique:regions,name_en,' . $id,
            'bike_type_id' => 'required|exists:bike_types,id'
        ];
        
        return $rules;
    }
}
