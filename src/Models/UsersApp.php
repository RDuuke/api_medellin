<?php

namespace Api\Models;


class UsersApp extends Model
{
    protected $table = "users_app";

    protected $fillable = ['unique_id', 'nombre', 'apellido', 'email'];

}