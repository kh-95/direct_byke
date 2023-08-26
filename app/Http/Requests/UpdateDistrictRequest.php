<?php

namespace App\Http\Requests;

use App\Models\City;
use App\Models\District;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDistrictRequest extends FormRequest
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
        $id = $this->route('district');
        foreach (config('app.available_locales') as $l) {
            $rules['name_' . $l] = (config('app.default_locale') == $l ? 'required' : 'sometimes') . '|update_unique:districts,name_' . $l . ',id,' . $id;
        }
        $rules['city_id'] = 'required|exists:cities,id';
        return $rules;

    }
}
