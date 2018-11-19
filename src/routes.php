<?php

$app->group("/api/v1", function () {
    $this->group("/filter/university", function () {
        $this->get("", "UniversityController:filterAllUniversity");
        $this->get("/{id}", "UniversityController:find");

    });
    $this->get("/university", "UniversityController:AllUniversity");
    $this->get("/university/{codigo}/programs", "UniversityController:programsForUniversity");
    $this->group("/programs", function (){
        $this->get("/{id}", "ProgramsController:detailsForProgram");
    });
    $this->post("/user", "UserAppController:storeUser")->add(new \Api\Middlewares\UserApiMiddleware());
    //$this->get("/search/{area}[/{sector}[/{university}]]", "ProgramsController:programForAreaSectorAndUniversity");
    //$this->get("/search[/{area}/{sector}]", "ProgramsController:programForAreaSectorAndUniversity");

    $this->get("/areas", "ProgramsController:areas");
    #TODO filtros
    // endpoint/search
    // endpoint/search/1
    // endpoint/search//1
    // endpoint/search/2/1
});

$app->group("/api/v1", function (){
   $this->get("/news", "NewsController:all");
});