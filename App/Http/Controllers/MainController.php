<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Helper\Mapper;
use App\Http\Model\Responses\Error;

class MainController extends Controller {

    public function getUserInfo($username) {
        try {

            $gitHubInfo = (new Request())->getUserInfo($username);

            $response = Mapper::jsonToInfoModel($gitHubInfo);

            return response()->json($response);
        } catch (\Exception $e) {
            $response = (new Error($e->getMessage()));
            return response()->json($response);
        }
    }

    public function getUserRepos($username) {
        try {

            $gitHubInfo = (new Request())->getUserRepos($username);

            $response = Mapper::jsonToReposModel($gitHubInfo);

            return response()->json($response);
        } catch (\Exception $e) {
            $response = (new Error($e->getMessage()));
            return response()->json($response);
        }
    }

    public function responseError($url) {
        $message = array(
            'validsUrl' => array(
                '/api/users/GITHUB_USERNAME',
                '/api/users/GITHUB_USERNAME/repos'
            )
        );
        $response = new Error($message, 400);
        return response()->json($response);
    }

}
