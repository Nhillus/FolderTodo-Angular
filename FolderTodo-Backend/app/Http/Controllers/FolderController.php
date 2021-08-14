<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    //
    public function index() {
        $folder = new Folder;
        $allFolder = $folder->getAllFolders();
        return ['Folders'=> $allFolder];
    }
    public function store(Request $request) {
        $folder = new Folder;
        $response=$folder->agregarFolder($request->nombre);
        return $response;
    }
    public function update(Request $request) {
        $folder = new Folder;
        $response = $folder->modificarFolder($request->id,$request->nombre);
        return $response;
    }
    public function destroy($id) {
        $folder = new Folder;
        $response = $folder->eliminarFolder($id);
        return $response;
    }
    public function load($id) {
        $folder = Folder::findOrFail($id);
        //$todoInFolder = $folder->todos()->where('folder_id',$request->id)->get();
        $todosInFolder = $folder->todos()->get();
        return ['todosInFolders'=> $todosInFolder];
        //return $request;
    }

}
