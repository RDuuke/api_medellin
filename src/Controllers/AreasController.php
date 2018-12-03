<?php

namespace Api\Controllers;


use Api\Models\Areas;
use Slim\Http\Request;
use Slim\Http\Response;

class AreasController extends Controller
{
    public function all(Request $request, Response $response)
    {
        $areas = Areas::all();
        $responseJson = $response->withHeader("Content-type", "application/json");
        return $responseJson->withJson([
            "status" => 1,
            "data" => $areas,
            "message" => "All areas"
        ], 200);
    }
}