<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return
            [
                'id'=>[
                    Rule::requiredIf(function () {
                    return !$this->route()->getName() == 'author.create';
                    }),
                'numeric',
                'exists:authors,id'
                ],
                'first_name'  => [
                    Rule::requiredIf(
                    function ()
                    {
                        return $this->route()->getName() == 'author.create';
                    }),
                    'string',
                    'min:3',
                    'max:64',
                    ],
                'second_name' =>[
                    'sometimes',
                    'nullable',
                    'string',
                    'max:64',
                    ],
                'last_name'   =>
                    [Rule::requiredIf(
                    function ()
                    {
                        return $this->route()->getName() == 'author.create';
                    }),
                    'string',
                    'min:3',
                    'max:64'
                    ],
                'birth_date'  => [
                    'sometimes',
                    'nullable',
                    'date',
                    ],
                'death_date'  => [
                    'sometimes',
                    'nullable',
                    'date'
                    ],
            ];
    }

}
