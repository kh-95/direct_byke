<?php

namespace App\Http\Requests\Client\Home;

use Illuminate\Foundation\Http\FormRequest;

class FiterRequest extends FormRequest
{
   
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
           'region_id' => 'nullable|exists:regions,id',
           'city_id' => 'nullable|exists:cities,id',
           'district_id'=> 'nullable|exists:districts,id',
           'price_from' => 'nullable|numeric',
           'price_to' => 'nullable|numeric',
           'lat' => 'required|numeric',
           'long'=> 'required|numeric',
           'bike_type'=>'nullable|exists:bike_types,id'
        ];
    }
 
}
