<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
        $clientID = $this->route('client');

        $rules = [
            'name' => [
                'required',
                'min:3',
                Rule::unique('clients')->ignore($clientID)
            ],
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
