<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoRol extends Model
{
    protected $table = "empleado_rol";
    protected $fillable = ["rol_id", "empleado_id", "id"];
    
}
