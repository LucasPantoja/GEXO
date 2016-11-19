<?php

namespace gexo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'enunciation' => 'required | min:3',
            'level' => 'required | numeric'
        ];
    }
}
