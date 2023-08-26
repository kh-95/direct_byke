<?php

namespace App\Helpers\Traits;

use App\Exceptions\ValidationResponseException;
use Illuminate\Contracts\Validation\Validator;

trait ValidationMessages
{
    public function messages(): array
    {
        return array_merge(
            $this->customMessages(),
            $this->commonMessages(),
        );
    }
    public function customMessages(): array
    {
        return [];
    }
    public function commonMessages(): array
    {
        return [
            'phone.regex' => __('The phone must be a valid Saudi phone number.'),
            'phone.unique' => __('The phone has already been taken.'),
            'code.size' => __('The code must be 4 characters.'),
            'phone.required' => __('The phone field is required.'),
            'email.required' => __('The email field is required.'),
            'email.email' => __('The email must be a valid email address.'),
            'email.max' => __('The email may not be greater than :max characters.'),
            'email.exists' => __('The selected email is invalid.'),
            'email.unique' => __('The email has already been taken.'),
            'password.required' => __('The password field is required.'),
            'password.min' => __('The password must be at least :min characters.'),
            'password.confirmed' => __('The password confirmation does not match.'),
            'name.required' => __('The name field is required.'),
            'name.max' => __('The name may not be greater than :max characters.'),
            'avatar.mimes' => __('The avatar must be a file of type: :values.'),
            'avatar.max' => __('The avatar may not be greater than :max kilobytes.'),
            'second_phone.unique' => __('second phone number is already taken'),
            'second_phone.regex' => __('The second phone must be a valid Saudi phone number.'),
            'birthday.date' => __('The birthday is not a valid date.'),
            'birthday.date_format' => __('The birthday must match the format Y-m-d.'),
            'uuid.uuid' => __('The uuid must be a valid UUID.'),
            'uuid.exists' => __('The selected uuid is invalid.'),
            'uuid.required' => __('The uuid field is required.'),
            'quantity.required' => __('The quantity field is required.'),
            'quantity.integer' => __('The quantity must be an integer.'),
            'quantity.min' => __('The quantity must be at least :min.'),

        ];
    }
    protected function failedValidation(Validator $validator) : never
    {
        throw new ValidationResponseException($validator);
    }
}
