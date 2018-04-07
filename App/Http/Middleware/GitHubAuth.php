<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Helper\Auth as AuthHelper;

class GitHubAuth {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next) {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (AuthHelper::session("access_token")) {
            define("ACESS_TOKEN", AuthHelper::session("access_token"));
            return $next($request);
        }
        if (AuthHelper::get('code')) {
            $this->login($request);
        }

        $this->getCode($request);

        return $next($request);
    }

    protected function login($request) {
        if (!AuthHelper::get('state') || $_SESSION['state'] != AuthHelper::get('state')) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            die();
        }

        $token = AuthHelper::apiRequest(config("services.github.tokenUrl"), array(
                    'client_id' => env("GITHUB_CLIENT_ID"),
                    'client_secret' => env("GITHUB_CLIENT_SECRET"),
                    'redirect_uri' => $request->url(),
                    'state' => $_SESSION['state'],
                    'code' => AuthHelper::get('code')
        ));

        $_SESSION['access_token'] = $token->access_token;

    }

    protected function getCode($request) {
        $_SESSION['state'] = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);

        $params = array(
            'client_id' => env("GITHUB_CLIENT_ID"),
            'redirect_uri' => $request->url(),
            'scope' => 'user',
            'state' => $_SESSION['state']
        );

        header('Location: ' . config("services.github.authorizeUrl") . '?' . http_build_query($params));
        exit;
    }

}
