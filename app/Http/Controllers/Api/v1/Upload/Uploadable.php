<?php

namespace ImageUploader\Http\Controllers\Api\v1\Upload;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use ImageUploader\Models\Image;

trait Uploadable
{
    protected $file;

    protected $destination = 'upload/files';

    protected $fieldname = 'file';

    protected $disk = 'public';

    public function upload(Request $request) {
        if ($request->hasFile($this->fieldname)) {
            $this->file = $request->{$this->fieldname};
            $time = time();

            if ( ! $path = $this->store($this->file, $time)) {
                return response()->json([
                    'errors' => [
                        ['store' => 'Store was not completed!'],
                    ],
                    'status_code' => 422,
                ], 422);
            }

            $image = Image::create([
                'filename' => $time . '.' . $this->file->extension(),
                'path' => 'storage/' . $this->destination,
            ]);

            return response()->json([
                'errors' => false,
                'data' => compact('path', 'image'),
            ]);
        }
    }

    protected function store(UploadedFile $image, $time)
    {
        if ($image->isValid()) {
            $filename = $time . '.' . $image->extension();
            return 'storage/' . $image->storeAs($this->destination, $filename, $this->disk);
        }

        return false;
    }
}
