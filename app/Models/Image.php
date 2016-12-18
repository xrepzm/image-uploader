<?php

namespace ImageUploader\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'filename',
        'path',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
