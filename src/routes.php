<?php

$app->group("/api/v1", function () {
    $this->group("/filter/university", function () {
        $this->get("", "UniversityController:filterAllUniversity");
        $this->get("/{id}", "UniversityController:find");

    });
    $this->get("/university", "UniversityController:AllUniversity");
    $this->get("/university/{codigo}/programs", "UniversityController:programsForUniversity");
    $this->group("/programs", function (){
        $this->get("/{codigo}", "ProgramsController:programsForUniversity");
    });
    $this->get("/search/{area}[/{sector}[/{university}]]", "ProgramsController:programForAreaSectorAndUniversity");

    $this->get("/areas", "ProgramsController:areas");
});

$app->group("/api/v1", function (){
   $this->get("/news", "NewsController:all");
});