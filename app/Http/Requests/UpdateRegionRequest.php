<?php

namespace App\Http\Requests;

use App\Models\City;
use App\Models\District;
use App\Models\Region;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRegionRequest extends FormRequest
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
        $rules = Region::$rules;
        $id = $this->route('region');
        foreach (config('app.available_locales') as $l) {
            $rules['name_' . $l] = (config('app.default_locale') == $l ? 'required' : 'sometimes') . '|update_unique:regions,name_' . $l . ',id,' . $id;
        }
        return $rules;

    }
}
