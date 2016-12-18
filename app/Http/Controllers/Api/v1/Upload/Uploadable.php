<?php

namespace ImageUploader\Http\Controllers\Api\v1\Upload;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

trait Uploadable
{
    protected $file;

    protected $destination = 'upload/files';

    protected $fieldname = 'file';

    protected $disk = 'public';

    public function upload(Request $request) {
        if ($request->hasFile($this->fieldname)) {
            $this->file = $request->{$this->fieldname};

            if ( !$path = $this->store($this->file)) {
                return response()->json([
                    'errors' => [
                        ['store' => 'Store was not completed!'],
                    ],
                    'status_code' => 422,
                ], 422);
            }

            return response()->json([
                'errors' => false,
                'data' => compact('path'),
            ]);
        }
    }

    protected function store(UploadedFile $image)
    {
        $filename = time() . '.' . $image->extension();
        $path = $image->storeAs($this->destination, $filename, $this->disk);

        return !$image->isValid() ?: 'storage/' . $path;
    }
}
