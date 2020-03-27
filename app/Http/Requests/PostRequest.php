<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PostRequest extends FormRequest
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
            'title' => $this->post ? 'required|min:3|' : 'unique:posts',
            'description' => 'required|min:10',
            'user_id' => 'required|exists:users,id',
            'image' => 'sometimes|image|mimes:png,jpg|max:2048',

        ];
    }

    public function messages()
    {
        return [
                'title.min' => 'Invalid! title has minimum of 3 chars',
                'description.min' => 'Invalid! description has minimum of 10 chars',
                'title.required' => 'Please enter the title field'
            ];
    }


}
