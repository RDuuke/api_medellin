<?php

namespace Api\Controllers;


use Api\Models\News;
use Slim\Http\Request;
use Slim\Http\Response;

class NewsController extends Controller
{
    function all(Request $request, Response $response)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");

        $news = News::all();

        return $responseJson->withJson([
           "status" => 1,
           "data" => $news,
           "message" => "All news"
        ], 200);
    }
}