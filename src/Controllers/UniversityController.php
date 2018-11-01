<?php

namespace Api\Controllers;

use Api\Models\University;
use Api\Models\UsersApi;
use Illuminate\Database\Capsule\Manager;
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

        $universities = University::all(["codigo", "nombre", "sector", "logo_universidad"]);
        return $responseJson->withJson([
            "status" => 1,
            "data" => $universities,
            "message" => "All universities"
            ],
            200
        );
    }
    public function programsForUniversity(Request $request, Response $response, $args)
    {

        $responseJson = $response->withHeader("Content-type", "application/json");

        $universities = Manager::table("universidades")
            ->join("ies_medellin", "universidades.codigo", "=", "ies_medellin.codigo_institucion")
            ->select(["universidades.codigo", "universidades.sector", "ies_medellin.id", "ies_medellin.nombre", "ies_medellin.basico_de_conocimiento"])
            ->where("ies_medellin.codigo_institucion", $args['codigo'])
            ->get();

        return $responseJson->withJson([
            "status" => 1,
            "data" => $universities,
            "message" => "All programs for of University"
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