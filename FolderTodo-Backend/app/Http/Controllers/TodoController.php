<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    //
    public function index() {
        $todo = new Todo;
        $allTodos = $todo->getAllTodos();
        return ['todos'=> $allTodos];
    }
    public function store(Request $request) {
            $todo = new Todo;
            $response=$todo->agregarTodo($request->nombre);
            return $response;
    }
    public function update (Request $request) {
        $todo = new Todo;
        $response = $todo->modificarTodo($request->id,$request->nombre);
        return $response;
    }
    public function destroy ($id) {
        $todo = new Todo;
        $response = $todo->eliminarTodo($id);
        return $response;
    }
    public function UpdateStatus(Request $request) {
        $todo = new Todo;
        $response = $todo->modificarEstado($request->id,$request->estado);
        return $response;
    }
    public function addTodoToFolder(Request $request) {
        $todo = new Todo;
        $response = $todo->agregarTodoAFolder($request->idF,$request->idT);
        return $response;
    }
    public function getWithoutGroup() {
        $todo = new Todo;
        $todosWithoutGroup = $todo->getAllTodosWithoutGroup();
        return ['todosWithoutGroup'=> $todosWithoutGroup];
    }
}
