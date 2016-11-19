<?php

namespace gexo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlternativeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'answer' => 'required',
            'text'   => 'required'
        ];
    }
}
