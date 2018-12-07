<?php

namespace Api\Models;


class News extends Model
{
    protected $table = "novedades";

    protected $hidden = ["updated_at"];


    function getCreatedAtAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }
}