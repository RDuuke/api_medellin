<?php

namespace Api\Controllers;


use Api\Models\Programs;
use Illuminate\Database\Capsule\Manager;
use Slim\Http\Request;
use Slim\Http\Response;

class ProgramsController extends Controller
{
    protected $academic_level = [ 1 => "POSGRADO", 2 => "PREGRADO", 3 => "Tecnológica"];


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
        $program = self::getData(1, $args['id']);

        return $responseJson->withJson([
            "status" => 1,
            "data" => $program,
            "message" => "Details of program with id: " . $args['id']
        ]);
    }

    public function all(Request $request, Response $response)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");
        $programs = self::getData(0);
        return $responseJson->withJson([
            "status" => 1,
            "data" => $programs,
            "message" => "All programs"
        ]);
    }

    public function levelAcademic(Request $request, Response $response, $args)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");
        $programs = Manager::table("universidades")
            ->join("ies_medellin", "universidades.codigo", "=", "ies_medellin.codigo_institucion")
            ->join("basico_de_conocimiento", "basico_de_conocimiento.id", "=", "ies_medellin.basico_de_conocimiento")
            ->select(["universidades.sector", "ies_medellin.id", "ies_medellin.nombre", "basico_de_conocimiento.nombre AS basico", "universidades.logo_universidad"])
            ->where("ies_medellin.nivel_academico", $this->academic_level[$args['level']])
            ->orWhere("nivel_formacion", $this->academic_level[$args['level']])
            ->get();
        //$programs = self::getData(2, $args['level'], $this->academic_level[$args['level']]);
        return $responseJson->withJson([
            "status" => 1,
            "data" => $programs,
            "message" => "Programs for the academic level: " . $this->academic_level[$args['level']]
        ]);

    }
    public function programForAreaAndUniversity(Request $request, Response $response, $args)
    {

    }

    protected function getData($type, $value = "", $last_type ="")
    {
        $programs = Manager::table("ies_medellin")
            ->join("universidades", "universidades.codigo", "=", "ies_medellin.codigo_institucion")
            ->join("basico_de_conocimiento", "basico_de_conocimiento.id", "=", "ies_medellin.basico_de_conocimiento")
            ->join("area_de_conocimiento", "area_de_conocimiento.id", "=", "basico_de_conocimiento.area_conocimiento")
            ->select(["universidades.sector", "ies_medellin.*",
                "universidades.logo_universidad", "universidades.direccion",
                "universidades.direccion_google_maps AS google_maps",
                "universidades.nombre AS nombre_universidad",
                "basico_de_conocimiento.nombre AS basico",
                "area_de_conocimiento.nombre AS area",
                "universidades.caracter_academico AS caracter"])
            ->get();
        switch ($type) {
            case 1 :
                $programs = $programs->where("id", $value);
                break;
            case 2 :
                if ($value != 3){
                    $programs = $programs->where("nivel_academico", $last_type);
                } else {
                    $programs = $programs->where("nivel_formacion", $last_type);
                }
                break;
            default :
                break;
        }

        return $programs;
    }

}