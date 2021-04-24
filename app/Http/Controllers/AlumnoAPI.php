<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoAPI extends Controller
{
    public function guardar(Request $request)
    {
        $alumno = new Alumno();
        
        $alumno->nombre = $request->input('nombre');
        $alumno->correo = $request->input('correo');
        $alumno->apellido = $request->input('apellido');
        $alumno->usuario = $request->input('usuario');        
        $alumno->password = bcrypt($request->input('password'));
        $alumno->save();
        return json_encode(["msg" => "alumno agregado"]);
    }

    public function actualizar(Request $request)
    {
        $alumno = Alumno::where('id_alumno', $request->id_alumno)->first();
        $alumno->nombre = $request->input('nombre');
        $alumno->correo = $request->input('correo');
        $alumno->apellido = $request->input('apellido');
        $alumno->usuario = $request->input('usuario'); 
        if(!empty($request->input('password'))) {
            $alumno->password = bcrypt($request->input('password'));
        }                
        $alumno->save();
        return json_encode(["msg" => "alumno actualizado"]);
    }

    function alumnos($id=null){
        //return $id?Alumno::find($id):Alumno::all();
        //for custom id
        return $id?Alumno::where('id_alumno', $id)->first():Alumno::all();
        
    }

    function eliminar($id){
        
        $alumno = Alumno::find($id);
        $result = $alumno->delete();

        if($result){
            return ["Result" => "Alumno Borrado"];
        }else{
            return ["Result" => "Error al borrar"];
        }
        
    }

    function buscar($cadena){
        if($cadena === ''){
            return Alumno::all();
        }else{
            return Alumno::where("nombre","like", "%".$cadena."%")
                        ->orwhere("correo","like", "%".$cadena."%")
                        ->get();
        }
        
    }
}
