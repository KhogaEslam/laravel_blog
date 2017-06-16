<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
//        $rules = [];
//
        return [
            //'name' => 'required|unique:categories|min:2|max:50|string',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();
        if (isset($input['[en][name]']))
        {
            $input['[en][name]'] = filter_var($input['[en][name]'] , FILTER_SANITIZE_STRING);
        }
        if (isset($input['[ar][name]']))
        {
            $input['[ar][name]'] = filter_var($input['[ar][name]'] , FILTER_SANITIZE_STRING);
        }
        $this->replace($input);
    }
}
