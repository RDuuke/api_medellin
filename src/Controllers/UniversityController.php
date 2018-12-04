<?php

namespace Api\Controllers;

use Api\Models\Areas;
use Api\Models\University;
use Api\Models\UsersApi;
use Illuminate\Database\Capsule\Manager;
use Slim\Http\Request;
use Slim\Http\Response;

class UniversityController extends Controller

{
    protected $sector = ["p" => "PRIVADA", "o" => "OFICIAL"];
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

        $universities = Manager::table("universidades")
            ->join("ies_medellin", "universidades.codigo", "=", "ies_medellin.codigo_institucion")
            ->select(["universidades.sector", "universidades.nombre", "universidades.codigo", "universidades.logo_universidad"])
            ->groupBy(["universidades.codigo"])
            ->get();

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
            ->join("basico_de_conocimiento", "basico_de_conocimiento.id", "=", "ies_medellin.basico_de_conocimiento")
            ->select(["universidades.sector", "ies_medellin.id", "ies_medellin.nombre", "basico_de_conocimiento.nombre AS basico", "universidades.logo_universidad"])
            ->where("ies_medellin.codigo_institucion", $args['codigo'])
            ->get();

        return $responseJson->withJson([
            "status" => 1,
            "data" => $universities,
            "message" => "All programs for of University with codigo: ".$args['codigo']
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

    public function getForArea(Request $request, Response $response, $args)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");

        $universities = Manager::table("universidades")
            ->join("ies_medellin", "universidades.codigo", "=", "ies_medellin.codigo_institucion")
            ->join("basico_de_conocimiento", "basico_de_conocimiento.id", "=", "ies_medellin.basico_de_conocimiento")
            ->join("area_de_conocimiento", "area_de_conocimiento.id", "=", "basico_de_conocimiento.area_conocimiento")
            ->select(["universidades.codigo", "universidades.nombre"])
            ->where("area_de_conocimiento.id", $args["area"])
            ->groupBy(["universidades.codigo"])
            ->get();


        return $responseJson->withJson([
            "status" => 1,
            "data" => $universities,
            "message" => "Universities for area: " . Areas::find($args["area"])->nombre
        ], 200);

    }

    public function getForSector(Request $request, Response $response, $args)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");

        $universities = Manager::table("universidades")
            ->select(["universidades.codigo", "universidades.nombre"])
            ->where("universidades.sector", $this->sector[$args["sector"]])
            ->groupBy(["universidades.codigo"])
            ->get();


        return $responseJson->withJson([
            "status" => 1,
            "data" => $universities,
            "message" => "Universities for sector: " . $this->sector[$args["sector"]]
        ], 200);

    }

    public function getForAreaAndSector(Request $request, Response $response, $args)
    {
        $responseJson = $response->withHeader("Content-type", "application/json");

        $universities = Manager::table("universidades")
            ->join("ies_medellin", "universidades.codigo", "=", "ies_medellin.codigo_institucion")
            ->join("basico_de_conocimiento", "basico_de_conocimiento.id", "=", "ies_medellin.basico_de_conocimiento")
            ->join("area_de_conocimiento", "area_de_conocimiento.id", "=", "basico_de_conocimiento.area_conocimiento")
            ->select(["universidades.codigo", "universidades.nombre"])
            ->where("area_de_conocimiento.id", $args["area"])
            ->where("universidades.sector", $this->sector[$args["sector"]])
            ->groupBy(["universidades.codigo"])
            ->get();


        return $responseJson->withJson([
            "status" => 1,
            "data" => $universities,
            "message" => "Universities for area " . Areas::find($args['area']) . " and sector ".$this->sector[$args['sector']]
        ], 200);

    }


}