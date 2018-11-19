<?php

namespace Api\Controllers;


use Api\Models\UsersApp;
use Slim\Http\Request;
use Slim\Http\Response;

class UserAppController extends Controller
{

    function storeUser(Request $request, Response $response)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");
        $info = $request->getParams();
        $info['unique_id'] = uniqid('', true);
        try{
            $userApp = UsersApp::where("email", $request->getParam('email'))->get();
            if ($userApp->count() == 0) {
                UsersApp::create($info);
                return $responseJson->withJson([
                   "status" => 1,
                   "data" => [],
                   "message" => "User created correctly"
                ],
                    200
                );
            }
            return $responseJson->withJson([
                "status" => 2,
                "data" => ["email" => $request->getParam('email')],
                "message" => "The email is already registered " . $request->getParam('email')
            ],
                200
            );
        } catch (\Exception $e) {
            return $responseJson->withJson([
                "status" => 0,
                "data" => [],
                "message" => "Error in the database"
            ],
                500
            );
        };

    }

}