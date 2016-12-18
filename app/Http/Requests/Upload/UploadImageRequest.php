<?php

namespace ImageUploader\Http\Requests\Upload;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
        ];
    }

    public function response(array $errors)
    {
        return response()->json(compact('errors'), 422);
    }
}
