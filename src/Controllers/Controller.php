<?php

namespace Api\Controllers;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class Controller
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container =  $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        return $response;
    }
}