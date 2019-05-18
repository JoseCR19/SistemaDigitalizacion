<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $connection='sqlsrv3';
    protected $table='Horario';
    protected $primaryKey='IdHorario';
    public $timestamps=false;
    protected $filleable=[
        'Tipo_Horario',
        'Descripcion',
    ];
    protected $guarded=[];
}
