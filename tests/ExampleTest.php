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
}
