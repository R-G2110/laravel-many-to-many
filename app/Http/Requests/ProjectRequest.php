<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'start_date' =>'required',
            'delivery_date' =>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Devi inserire il nome del progetto',
            'name.min' => 'Il nome del progetto deve avere almeno 3 caratteri',
            'start_date.required' => "Devi inserire la data d'inizio del progetto",
            'delivery_date.required' => "Devi inserire la data di scadenza del progetto"
        ];
    }
}
