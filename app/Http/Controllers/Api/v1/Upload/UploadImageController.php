<?php

namespace ImageUploader\Http\Controllers\Api\v1\Upload;

use ImageUploader\Http\Controllers\Controller;
use ImageUploader\Http\Requests\Upload\UploadImageRequest;

class UploadImageController extends Controller
{
    use Uploadable;

    public function __construct()
    {
        $this->destination = 'uploads/images';
        $this->fieldname = 'image';
    }

    public function uploadImage(UploadImageRequest $request)
    {
        return $this->upload($request);
    }
}
