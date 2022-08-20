<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Only Authorise user can do this poeration
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'requierd|max:255|unique:products',
            'discription'=>'requred',
            'price'=>'requred |max:10',
            'stock'=>'requred|max:6',
            'discount'=>'requred|max:2'
        ];
    }
}
