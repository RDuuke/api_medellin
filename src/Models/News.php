<?php

namespace Api\Models;


class News extends Model
{
    protected $table = "novedades";

    protected $hidden = ["created_at", "updated_at"];

}