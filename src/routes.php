<?php

$app->group("/api/v1", function () {
    $this->group("/filter/university", function () {
        $this->get("", "UniversityController:filterAllUniversity");
        $this->get("/{id}", "UniversityController:find");
    });
    $this->get("/university", "UniversityController:AllUniversity");
    $this->get("/university/{codigo}/programs", "UniversityController:programsForUniversity");
    $this->group("/programs", function (){
        $this->get("/{id}", "ProgramsController:getDetails");
        $this->get("", "ProgramsController:all");
        $this->get("/academic-level/{level}", "ProgramsController:getForLevelAcademic");
    });

    $this->post("/user", "UserAppController:storeUser")->add(new \Api\Middlewares\UserApiMiddleware());
    $this->get("/areas", "AreasController:all");
    $this->get("/search/university/area/{area}", "UniversityController:getForArea");
    $this->get("/search/university/sector/{sector}", "UniversityController:getForSector");
    $this->get("/search/university/area/{area}/sector/{sector}", "UniversityController:getForAreaAndSector");
    $this->get("/search/program/area/{area}", "ProgramsController:getForArea");
    $this->get("/search/program/area/{area}/sector/{sector}", "ProgramsController:getForAreaAndSector");
    $this->get("/search/program/area/{area}/university/{codigo}", "ProgramsController:getForAreaAndUniversity");
    $this->get("/search/program/sector/{sector}", "ProgramsController:getForSector");
});

$app->group("/api/v1", function (){
   $this->get("/news", "NewsController:all");
});