<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogStore extends FormRequest
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
    public function rules(): array
    {
        return [
            'title'=>'string|max:100|required|min:4',
            'content'=>'string|max:255|required|min:5',
            'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories'=>'required|min:1|array',
            'categories.*'=>'exists:categories,id'
        ];
    }
}
