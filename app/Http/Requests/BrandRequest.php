<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
        $brandID = $this->route('brand');

        $rules = [
            'name' => [
                'required',
                'min:3',
                Rule::unique('brands')->ignore($brandID)
            ],
            'image' => [
                'required',
                'file',
                'mimes:png'
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
