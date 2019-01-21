<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //'file' => 'max:10240|required|mimes:csv,xlsx',
            'formats' => 'required',
        ];
    }


    public function messages()
    {
        return [
			'file.required' => 'An csv file is required.',
			'file.mimes' => 'Only csv file is supported.',
			'formats.required' => 'A format to convert is required.',
		];
		
	}
}
