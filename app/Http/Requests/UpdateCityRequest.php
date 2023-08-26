<?php

namespace App\Http\Requests;

use App\Models\City;
use App\Models\District;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
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
        $rules = City::$rules;
        $id = $this->route('city');
        foreach (config('app.available_locales') as $l) {
            $rules['name_' . $l] = (config('app.default_locale') == $l ? 'required' : 'sometimes') . '|update_unique:cities,name_' . $l . ',id,' . $id;
        }
        $rules['region_id'] = 'required|exists:regions,id';
        return $rules;

    }
}
