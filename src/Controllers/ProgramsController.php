<?php

namespace Api\Controllers;


use Api\Models\Programs;
use Slim\Http\Request;
use Slim\Http\Response;

class ProgramsController extends Controller
{

    public function areas(Request $request, Response $response)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");

        $areas = Programs::distinct()->get(["area_de_conococimiento"]);
        return $responseJson->withJson([
            "status" => 1,
            "data" => $areas,
            "message" => "All areas"
        ], 200);
    }

    public function programsForUniversity(Request $request, Response $response, $args)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");
        try {
            $programs = Programs::where("codigo_institucion", $args["codigo"])->get();

            return $responseJson->withJson([
               "status" => 1,
               "data" => $programs,
               "message" => "Programs for the codigo: ". $args["codigo"]
            ], 200);
        } catch (\Exception $e) {
            return $responseJson->withJson([
               "status" => 4,
               "data" => [],
               "message" => "No result for the codigo: " . $args["codigo"]
            ]);
        }
    }

    public function programForAreaSectorAndUniversity(Request $request, Response $response, $args)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");

        $area = ! empty($args["area"]) ? $args["area"] : "";

        $area = ! empty($args["sector"]) ? $args["sector"] : "";

        $area = ! empty($args["sector"]) ? $args["sector"] : "";
        try {
            if (count($args) == 3) {
                $programs = Programs::where("area_de_conococimiento", $args["area"])
                            ->where("");
            } else if (count($args) == 2) {

            } else {

            }
        } catch (\Exception $e) {

        }
    }

}