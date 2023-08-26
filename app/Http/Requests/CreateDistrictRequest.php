<?php

namespace App\Http\Requests;

use App\Models\City;
use App\Models\District;
use Illuminate\Foundation\Http\FormRequest;

class CreateDistrictRequest extends FormRequest
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
        $rules = District::$rules;
        foreach (config('app.available_locales') as $l) {
            $rules['name_' . $l] = (config('app.default_locale') == $l ? 'required' : 'sometimes') . '|create_unique:districts,name_' . $l . '';
        }
        $rules['city_id'] = 'required|exists:cities,id';
        return $rules;

    }
}
