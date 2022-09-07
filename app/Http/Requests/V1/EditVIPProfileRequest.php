<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class EditVIPProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name"=> 'required',
            "last_name"=> 'required',
            "birthday"=> 'required',
            "national_code"=> 'required',
            "email"=> 'required',
            "company"=> 'required',
            "image"=> 'nullable',
            "company_registration_number"=> 'required',
            "company_type"=> 'required',
            "state"=>'required',
            "city"=> 'required',
            "company_exact_address"=> 'required',
            "postal_code"=> 'required',
            "card_number"=> 'required',
            "username"=> 'required',
        ];
    }
}
