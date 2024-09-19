<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalRequest extends FormRequest
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
        $rules = [
            'client_id' => [
                'exists:clients,id'
            ],
            'car_id' => [
                'exists:cars,id'
            ],
            'start_date_period' => [
                'required'
            ],
            'expected_end_date_period' => [
                'required'
            ],
            'actual_end_date_period' => [
                'required'
            ],
            'daily_rate' => [
                'required'
            ],
            'initial_km' => [
                'required'
            ],
            'final_km' => [
                'required'
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
