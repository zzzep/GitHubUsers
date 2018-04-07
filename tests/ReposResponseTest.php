<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReposResponseTest extends TestCase {

    use WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testResponseJson() {
        $this->visit("/api/users/teste")->seeJson();
    }

    public function testFormationJson() {
        $_SESSION = [];
        $this->withSession(["code" => "123", "state" => "456"])
                ->visit("/api/users/teste")
                ->seeJson([
                    "avatar_url" => "https://avatars0.githubusercontent.com/u/91613?v=4",
                    "html_url" => "https://github.com/teste",
                    "id" => 91613,
                    "login" => "teste",
                    "name" => null
                ]
        );
    }

}
