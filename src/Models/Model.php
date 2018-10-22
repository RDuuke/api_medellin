<?php
namespace Api\Models;

use Illuminate\Database\Eloquent\Model as M;


abstract class Model extends M{
    public $timestamps = false;
}