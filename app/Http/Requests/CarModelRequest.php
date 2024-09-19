<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $carModelID = $this->route('car_model');

        $rules = [
            'brand_id' => [
                'exists:brands,id'
            ],
            'name' => [
                'required',
                'min:3',
                Rule::unique('car_models')->ignore($carModelID)
            ],
            'image' => [
                'required',
                'file',
                'mimes:png,jpeg,jpg'
            ],
            'number_ports' => [
                'required',
                'integer',
                'digits_between:1,5'
            ],
            'places' => [
                'required',
                'integer',
                'digits_between:1,20'
            ],
            'air_bag' => [
                'required',
                'boolean'
            ],
            'abs' => [
                'required',
                'boolean'
            ]
        ];

        //partially rules
        if($this->isMethod('patch')) {
            $dynamicRules = [];

            foreach($rules as $input => $baseRules) {
                if($this->has($input)) {
                    $dynamicRules[$input] = $baseRules;
                }
            }

            return $dynamicRules;
        }

        return $rules;
    }
}
