<?php

namespace gexo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'quantity' => 'required|numeric',
            'field_id' => 'required|numeric'
        ];
    }
}
