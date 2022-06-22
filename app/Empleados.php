<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Areas;
use App\EmpleadoRol;

class Empleados extends Model
{
    protected $table = "empleados";
    protected $fillable = ["nombre", "id", "area_id", "email", "descripcion", "sexo", "boletin"];
    protected $primaryKey = "id"; 
    
    public function getNombreArea(){
        $area = Areas::find($this->area_id);        
        return $area->nombre;
    }

    public function getRolesId(){
        $roles = EmpleadoRol::where("empleado_id", $this->id)->get();        
        return $roles;
    }

}
