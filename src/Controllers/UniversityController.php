<?php

namespace Api\Controllers;

use Api\Models\University;
use Api\Models\UsersApi;
use MongoDB\Driver\Manager;
use Slim\Http\Request;
use Slim\Http\Response;

class UniversityController
{
    public function filterAllUniversity(Request $request, Response $response)
    {

        $responseJson = $response->withHeader("Content-type", "application/json");

        $universities = University::all(["codigo", "nombre"]);
        return $responseJson->withJson([
            "status" => 1,
            "data" => $universities,
            "message" => "All universities"
            ],
            200
        );
    }
    public function AllUniversity(Request $request, Response $response)
    {

        $responseJson = $response->withHeader("Content-type", "application/json");

        $universities = University::all(["Código Institución AS codigo", "nombre", "sector", "logo_universidad"]);
        return $responseJson->withJson([
            "status" => 1,
            "data" => $universities,
            "message" => "All universities"
            ],
            200
        );
    }

    public function find(Request $request, Response $response, $args)
    {


        $responseJson = $response->withHeader("Content-type", "application/json");
        try {
            $university = University::findOrFail($args['id']);
            return $responseJson->withJson([
               "status" => 1,
               "data" => $university,
               "message" => "Data for the codigo: " . $args['id']
            ], 200);

        } catch (\Exception $e) {
            return $responseJson->withJson([
                "status" => 4,
                "data" => [],
                "message" => "No result for the codigo: " . $args['id']
            ],
                400
            );
        }
    }


}