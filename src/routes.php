<?php

$app->group("/api/v1", function () {
    $this->group("/university", function () {
        $this->get("", "UniversityController:all");
        $this->get("/{id}", "UniversityController:find");
    });

    $this->group("/programs", function (){
        $this->get("/{codigo}", "ProgramsController:programsForUniversity");
    });
    $this->get("/search/{area}[/{sector}[/{university}]]", "ProgramsController:programForAreaSectorAndUniversity");

    $this->get("/areas", "ProgramsController:areas");
})->add(new \Api\Middlewares\UserApiMiddleware());

$app->group("/api/v1", function (){
   $this->get("/news", "NewsController:all");
});