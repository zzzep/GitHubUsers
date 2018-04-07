<?php

namespace App\Http\Helper;

/**
 * Description of Auth
 *
 * @author Giuseppe Dezute Fechio
 */
class Auth {

    public static function get($key, $default = NULL) {
        return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
    }

    public static function session($key, $default = NULL) {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
    }

    public static function apiRequest($url, $post = FALSE, $headers = array()) {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if ($post){
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        $headers[] = 'Accept: application/json';
        if (Self::session('access_token')){
            $headers[] = 'Authorization: Bearer ' . session('access_token');
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        return json_decode($response);
    }

}
