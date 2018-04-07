<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Model\Responses\Error;

class InvalidUrlTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
    public function testRandomUrl(){
        $random = str_random(40);
        $response = (array)new Error([
            'validsUrl' => [
                '/api/users/GITHUB_USERNAME',
                '/api/users/GITHUB_USERNAME/repos'
            ]
        ], 400);
        
        $this->visit("/$random")
                ->seeJson($response);
    }
}
