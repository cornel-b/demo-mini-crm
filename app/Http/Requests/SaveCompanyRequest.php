<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCompanyRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required'
            ],
            'logo' => [
                'mimes:jpeg,bmp,png',
                'dimensions:min_width=100,min_width=100',
            ],
        ];
    }
}
