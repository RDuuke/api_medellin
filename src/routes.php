<?php

$app->group("/api/v1", function () {
    $this->get("/universities", "UniversityController:AllUniversity");
    $this->get("/university/{codigo}/programs", "UniversityController:programsForUniversity");
    $this->group("/programs", function (){
        $this->get("/{id}", "ProgramsController:getDetails");
        $this->get("", "ProgramsController:all");
        $this->get("/academic-level/{level}", "ProgramsController:getForLevelAcademic");
    });
    $this->post("/user", "UserAppController:storeUser")->add(new \Api\Middlewares\UserApiMiddleware());
    $this->get("/areas", "AreasController:all");
    $this->get("/search/university/area/{area}", "UniversityController:getForArea");
    $this->get("/search/universities/sector/{sector}", "UniversityController:getForSector");
    $this->get("/search/universities/area/{area}/sector/{sector}", "UniversityController:getForAreaAndSector");
    $this->get("/search/programs/area/{area}", "ProgramsController:getForArea");
    $this->get("/search/programs/area/{area}/sector/{sector}", "ProgramsController:getForAreaAndSector");
    $this->get("/search/programs/area/{area}/university/{codigo}", "ProgramsController:getForAreaAndUniversity");
    $this->get("/search/programs/sector/{sector}", "ProgramsController:getForSector");
    $this->get("/news", "NewsController:all");
});
