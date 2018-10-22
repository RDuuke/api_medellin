<?php


namespace Api\Middlewares;


use Api\Models\UsersApi;
use Slim\Http\Request;
use Slim\Http\Response;

class UserApiMiddleware
{

    public function __invoke(Request $request, Response $response, callable $next)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");
        if (! empty(array_shift($request->getHeader("PHP_AUTH_PW"))) && !empty(array_shift($request->getHeader("PHP_AUTH_USER")))) {

            $user_api =  UsersApi::where("user", array_shift($request->getHeader("PHP_AUTH_USER")))
                ->where("password", (md5(array_shift($request->getHeader("PHP_AUTH_PW")))))
                ->get();

            if ($user_api->count() == 1) {
               $response = $next($request, $response);
               return $response;
            }
        }
        return $responseJson->withJson([
            "status" => 0,
            "data" => [],
            "message" => "Unauthorized access"
        ]);
    }
}