<?php

namespace App\Http\Requests;

use App\Http\Helper\SimpleCurl;

class Request {

    public function getUserInfo($username) {
        $url = config("services.github.baseUrl") . sprintf(config("services.github.endPoints.userInfo"), $username);
        return $this->callCurl($url);
    }

    public function getUserRepos($username) {
        $url = config("services.github.baseUrl") . sprintf(config("services.github.endPoints.userRepos"), $username);
        return $this->callCurl($url);
    }

    protected function callCurl($url) {
        $curl = new SimpleCurl();
        $agents = [
            "Accept: application/vnd.github.v3+json",
            "User-Agent: " . env("GITHUB_NAME")
        ];
        $response = $curl->init()->setHeader(array_merge($_SESSION, $agents))->response($url);
        if (strpos($response, "Please make sure your request has a User-Agent header") != false) {
            throw new \Exception("Git Hub Header not informed");
        }
        return $response;
    }

}
