<?php

namespace Api\Models;


class Programs extends Model
{
    protected $table = "ies_medellin";
    public $timestamps = false;

    protected $fillable = [
        "codigo_institucion", "codigo_snies", "area_de_conococimiento",
        "basico_de_conocimiento", "nombre_del_programa", "nivel_academico",
        "nivel_formacion", "metodologia", "numero_periodos_de_duracion",
        "periodos_de_duracion", "titulo_otorgado", "departamento_oferta_programa",
        "municipio_oferta_programa", "costo_matricula", "tiempo_admisiones_estudiantes",
        "direccion_google"
    ];
}