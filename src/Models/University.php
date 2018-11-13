<?php

namespace Api\Models;


class University extends Model
{
    protected $table = "universidades";

    protected $primaryKey = "codigo";

    protected $fillable = [
        "codigo", "nombre", "tipo", "sector", "caracter_academico",
        "departamento", "municipio",
        "direccion", "direccion_google_maps", "telefono",
        "estado", "web",
        "logo_universidad"
    ];

    public function getSectorAttribute($value)
    {
        return $value == "OFICIAL" ? "PUBLICA" : $value;
    }

    public function programForUniversity()
    {
        return $this->hasMany(Programs::class, "codigo_institucion", "codigo")->select(["id", "nombre", "basico_de_conocimiento"]);
    }
}