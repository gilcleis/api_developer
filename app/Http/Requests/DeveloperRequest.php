<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeveloperRequest extends FormRequest
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
       
        $rules =  [                     
            'nome' => 'required' ,  
            'sexo'    => 'required|in:M,F', 
            'datanascimento'    => 'required',  
            'hobby' => 'nullable'                    
        ];       
        return $rules;

    }
}

