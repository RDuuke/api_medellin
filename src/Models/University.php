<?php

namespace Api\Models;


class University extends Model
{
    protected $table = "universidades";

    protected $primaryKey = "codigo";

    protected $fillable = [
        "codigo", "nombre", "tipo", "sector", "caracter_academico",
        "departamento_domicilio", "municipio_domicilio", "municipio_domicilio",
        "direccion_domicilio", "direccion_google_maps", "telefono",
        "estado", "principal_seccional", "pagina_web",
        "acreditacion", "fecha_acreditacion", "resolucion_de_la_acreditacion",
        "vigencia_de_la_acreditacion", "logo_universidad"
    ];

    public function getSectorAttribute($value)
    {
        return $value == "OFICIAL" ? "PUBLICA" : $value;
    }
}