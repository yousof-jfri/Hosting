<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'poster' => 'required',
            'video' => 'required',
            'country' => 'required',
            'teaser' => 'required',
            'actors' => 'nullable',
            'writers' => 'nullable',
            'justification' => 'required',
            'director' => 'required',
            'genre' => 'required',
            'release' => 'required',
            'price' => 'required',
            'discountFromUser' => 'required',
            'discountFromProgram' => 'required',
        ];
    }
}
