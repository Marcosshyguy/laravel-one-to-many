<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'type_id' => 'nullable',
            'title' => 'required|min:5',
            'description' => 'bail|required|min:5|max:300',
            'production_date' => 'nullable',
            'languages_used' => 'required',
            'new_image' => 'nullable|image|max:50000'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Manca nome progetto',
            'title.min' => 'Nome progetto troppo corto',
            'description.required' => 'Manca descrizione',
            'description.min' => 'Descrizione troppo corta',
            'description.max' => 'Descrizione troppo lunga',
            'languages_used' => 'Linguaggi da inserire',
            'new_image.image' => "Il file inserito non è supportato",
            'new_image.max' => 'Il file è troppo grande'
        ];
    }
}
