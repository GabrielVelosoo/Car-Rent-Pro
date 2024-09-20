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
                'required',
                'date'
            ],
            'expected_end_date_period' => [
                'required',
                'date'
            ],
            'actual_end_date_period' => [
                'required',
                'date'
            ],
            'daily_rate' => [
                'required',
                'numeric'
            ],
            'initial_km' => [
                'required',
                'integer'
            ],
            'final_km' => [
                'required',
                'integer'
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
