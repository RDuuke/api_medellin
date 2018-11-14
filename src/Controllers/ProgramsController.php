<?php

namespace Api\Controllers;


use Api\Models\Programs;
use Illuminate\Database\Capsule\Manager;
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

    public function detailsForProgram(Request $request, Response $response, $args)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");
        $program = Manager::table("ies_medellin")
            ->join("universidades", "universidades.codigo", "=", "ies_medellin.codigo_institucion")
            ->join("basico_de_conocimiento", "basico_de_conocimiento.id", "=", "ies_medellin.basico_de_conocimiento")
            ->join("area_de_conocimiento", "area_de_conocimiento.id", "=", "basico_de_conocimiento.area_conocimiento")
            ->select(["universidades.sector", "ies_medellin.*",
                "universidades.logo_universidad", "universidades.direccion",
                "universidades.direccion_google_maps AS google_maps",
                "basico_de_conocimiento.nombre AS basico",
                "area_de_conocimiento.nombre AS area",
                "universidades.caracter_academico AS caracter"])
            ->where("ies_medellin.id", $args['id'])
            ->get();
        return $responseJson->withJson([
            "status" => 1,
            "data" => $program,
            "message" => "Details of program with id: " . $args['id']
        ]);
    }

    public function programForAreaSectorAndUniversity(Request $request, Response $response, $args)
    {

    }

}