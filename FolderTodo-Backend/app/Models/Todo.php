<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Folder;

class Todo extends Model
{
    Protected $fillable = ["nombre", "estado"] ;
    Protected $cast = ['estado' => 'boolean'];

    public function agregarTodo($nombre) {
        $todo = new Todo;
        $todo->nombre = $nombre;
        $todo->estado = "false";
        $todo->save();
        if (!$todo) {
            return response()->json(["success"=>false, "message" =>'Registro de todo fallida'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Registro de todo exitoso', 
                                 "todo" => $todo],201);
    }
    public function selecionarTodo($id) {
        $todo = Todo::findOrFail($id);
        if (!$todo) {
            return response()->json(["success"=>false, "message" =>'No se pudo enbcontrar la todo'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito la todo', 
                                 "Todos" => $todo],200);
    }
    /*public function verTodo() {
        return todo();
    }*/ //esta es para ver una en especifico refactorizar
    public function eliminarTodo($id) {
        $todo = Todo::findOrFail($id);
        $todoEliminada = $todo->nombre; //luego esta linea se refactoriza
        $todo->destroy($id);
        if (!$todo) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar la actividad o no se pudo eliminar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito la actividad y Eliminada', 
                                 "Actividad_Eliminada" => $todoEliminada,],200);

    }

    public function modificarTodo($id,$nombre) {
        $todo = Todo::findOrFail($id);
        $todoModificada = $todo->nombre; //luego esta linea se refactoriza
        $todo->nombre = $nombre;
        $todo->save();
        if (!$todoModificada) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar la todo o no se pudo modificar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito la todo y modificada', 
                                 "Todo_Previa_A_La_Modificacion" => $todoModificada,
                                 "Todo_Actual" => $todo],200);

    }
    public function modificarEstado($id,$estadoAModificar) {
        $todo = Todo::findOrFail($id);
        $todoEstadoPrevio = $todo->estado;
        if ($todoEstadoPrevio == "false") {
           $todo->estado = "true";
           $todo->save(); 
        }
        else {
            $todo->estado = "false";
            $todo->save(); 
        }
        if ($todoEstadoPrevio == $estadoAModificar)
        {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar la todo o no se pudo modificar el estado consultar con dev'],500);
        } 
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito la todo y modificada su estado', 
                                 "Todo_Previa_A_La_Modificacion" => $todoEstadoPrevio,
                                 "Todo_Actual" => $todo],200);
    }

    public function agregarTodoAFolder($idF,$idT) {
        $todo = Todo::findOrFail($idT);
        $todoModificada = $todo->folder_id;
        $todo->folder_id = $idF;
        $todo->save();
        if (!$todo) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar la todo o no se pudo modificar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito la todo y modificada', 
                                 "Todo_folder_id_Previa_A_La_Modificacion" => $todoModificada,
                                 "Todo_Actual" => $todo],200);
    }

    public function getAllTodos() {
        $todos = Todo::all();
        return $todos; 
    }

    public function folder() {
        return $this->belongsTo(Folder::class);
    }

    public function getAllTodosWithoutGroup() {
        $todos = Todo::all()->where('folder_id',NULL);
        return $todos;
    }


}
