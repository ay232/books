<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends BaseApiRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->route()->getName() == 'book.create'){
            $rule = "";
        }else{
            $rule = ", {$this->id}";
        }
        return [
            'id'=>[
                Rule::requiredIf(function () {
                    return !$this->route()->getName() == 'book.create';
                }),
                'numeric',
                'exists:books,id'
            ],
            'name'  => [
                Rule::requiredIf(
                    function ()
                    {
                        return $this->route()->getName() == 'author.create';
                    }),
                'string',
                'unique:books,name'.$rule,
                'min:3',
                'max:64',
            ],
            'description'  => [
                'sometimes',
                'string',
                'max:4096',
            ],
            'published_at'  => [
                'sometimes',
                'nullable',
                'date',
            ],
        ];
    }
}
