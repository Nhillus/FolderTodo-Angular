<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;

class Folder extends Model
{
    //
    Protected $fillable  = ['nombre'];

    public function getAllFolders() {
        $folder = Folder::all();
        return $folder; 
    }

    public function agregarFolder($nombre) {
        $folder = new Folder;
        $folder->nombre = $nombre;
        $folder->save();
        if (!$folder) {
            return response()->json(["success"=>false, "message" =>'Registro de Folder fallida'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Registro de Folder exitoso', 
                                 "Folder" => $folder],201);
    }

    public function modificarFolder($id,$nombre) {
        $folder = Folder::findOrFail($id);
        $folderModificada = $folder->nombre; //luego esta linea se refactoriza
        $folder->nombre = $nombre;
        $folder->save();
        if (!$folderModificada) {
            return response()->json(["success"=>false, "message" =>'No se pudo enbcontrar la folder o no se pudo modificar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito la folder y modificada', 
                                 "Folder_Previa_A_La_Modificacion" => $folderModificada,
                                 "Folder_Actual" => $folder],200);
    }

    public function eliminarFolder($id) {
        $folder = Folder::findOrFail($id);
        $folderEliminada = $folder->nombre; //luego esta linea se refactoriza
        $folder->destroy($id);
        if (!$folder) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar la folder o no se pudo eliminar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito la folder y Eliminada', 
                                 "Folder_Eliminada" => $folderEliminada,],200);
    }

    public function todos(){
        return $this->hasMany(Todo::class);
    }
    
}
