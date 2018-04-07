<?php

namespace App\Http\Helper;

use App\Http\Model\Responses\Info;
use App\Http\Model\Responses\Repos;

/**
 * Description of Mapper
 *
 * @author Giuseppe Fechio
 */
class Mapper {

    public static function jsonToInfoModel($json) {
        $data = json_decode($json);
        $model = new Info();
        $model->id = $data->id;
        $model->login = $data->login;
        $model->name = $data->name;
        $model->avatar_url = $data->avatar_url;
        $model->html_url = $data->html_url;
        return $model;
    }

    public static function jsonToReposModel($json) {
        $data = json_decode($json);
        $response = [];
        foreach ($data as $value) {
            $model = new Repos();
            $model->id = $value->id;
            $model->name = $value->name;
            $model->description = $value->description;
            $model->html_url = $value->html_url;
        }
        $response[] = $model;
        return $response;
    }

}
