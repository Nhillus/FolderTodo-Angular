import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import { Observable } from 'rxjs';
import { Config } from 'protractor';


export interface Todo {
  id: Number;
  nombre: String;
  estado: Number;
  id_folder:Number;
}

export interface Folder {
  id: Number;
  nombre: String;
}


const API_URL: string = 'http://localhost:8000/api';

@Injectable({
  providedIn: 'root',
  

})







export class FolderTodoService {
 
  constructor(private http: HttpClient) { 
  }
  
  


  getTodos() {
    return this.http.get(API_URL+'/todos');
  }


  AgregarTodos(todo:any) {
    return this.http.post(API_URL+'/agregartodo', todo);
  }

  editarTodos(todo:any){
    return this.http.put(API_URL+'/modificartodo', todo);
    
  }

  eliminarTodos(id:any){
    return  this.http.delete(API_URL+'/eliminartodo'+'/'+id);

  }

}
