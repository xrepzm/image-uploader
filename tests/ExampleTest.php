<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;

class ExampleTest extends TestCase
{
    // use DatabaseMigrations;

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
             ->seeJsonStructure([
                 'errors',
                 'data' => [
                     'path' => [],
                 ],
             ])
             ->assertFileIsReadable(public_path($file_path));

        $this->seeInDatabase('images', [
            'filename' => $name,
            'path' => 'storage/uploads/images',
        ]);

        @unlink(public_path($file_path));
    }
}
