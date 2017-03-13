<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ExpRequest extends Request
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
        //on met les element nécessaire pour valider le formulaire
            'name' => 'required:posts|max:50',
            'adress' => 'max:50',
            'about' => 'max:50',
            // 'ville' => 'required',
            'name_owner' => 'max:50',
            'option_1' => 'max:255',
            
            // 'photo' => 'required'
        ];
    }
}
