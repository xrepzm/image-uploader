<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;

class ExampleTest extends TestCase
{
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel');
    }

    public function testImageUpload()
    {
        $stub = __DIR__ . '/test.jpeg';
        $name = time() . '.jpeg';
        $path = sys_get_temp_dir() . '/' . $name;

        copy($stub, $path);

        $file = new UploadedFile($path, $name, filesize($path), 'image/jpeg', null, true);

        $file_path = 'storage/uploads/images/' . $name;

        $this->json('POST', '/api/upload-image', ['image' => $file])
             ->assertResponseOk()
             ->seeJson([
                 'errors' => false,
                 'data' => [
                     'path' => $file_path,
                 ],
             ])
             ->assertFileIsReadable(public_path($file_path));

        @unlink(public_path($file_path));
    }
}
