<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InfoResponseTest extends TestCase {

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
                ->visit("/api/users/teste/repos")
                ->seeJson([
                    "description" => null,
                    "html_url" => "https://github.com/teste/teste",
                    "id" => 28494633,
                    "name" => "teste"
                        ]
        );
    }

}
