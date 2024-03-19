<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function attributes(): array
    {
        return [
            'title' => 'title majburiy',
            'phone_number' => 'title majburiy',
            'short_content' => 'title majburiy',
            'content' => 'titlemajburiy',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
         return [
            'title' => 'required|max:255',
            'tags' => 'nullable|max:255',
            'phone_number' => 'required',
            'short_content' => 'required',
            'content' => 'required',
            'photo' => 'nullable|image|max:2048'
        ];
    }
}
