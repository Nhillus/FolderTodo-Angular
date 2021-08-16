import { Component, OnInit } from '@angular/core';
import { Folder,FolderTodoService,Todo} from 'src/app/folder-todo.service'; 
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { FormBuilder } from '@angular/forms';






@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  title = 'Foldertodo-frontend';
  items = this.folderTodoService.getTodos();
  checkoutForm = this.formBuilder.group({
    nombre: '',
    estado: '',
  
  });
  
  seleccionartodo:{
    id:'',
    nombre:'',
  };


  



  todos:any=[];

 

  



  
  errorMessage:[];
  
  
  


  constructor (private folderTodoService:FolderTodoService, private formBuilder: FormBuilder,) {
      this.errorMessage= [];
      this.seleccionartodo={id:'',nombre:''};










  }

  ngOnInit() {
    this.getTodos();
  }

  getTodos() {
    this.folderTodoService
            .getTodos().subscribe((data:any=[])=>{
              console.log(data);
              this.todos = data.todos;
            })  
        }


  addTodo(): void{
      this.folderTodoService.AgregarTodos(this.checkoutForm.value).subscribe((response:any)=>{
      alert(JSON.stringify(response)) 
      this.getTodos();
    });
   
  }
  seleccionado(todo:any=[]){
    //console.log(todo);
    this.seleccionartodo=todo;
    
  }

  editTodo(todo:any, nuevonombre:any){
      this.seleccionartodo.nombre=nuevonombre;
      this.folderTodoService.editarTodos(todo).subscribe((response:any)=>{
      alert(JSON.stringify(response))
      this.getTodos(); 
     
    });
   
  }

  elimiTodo(id:any){      
    console.log(id);
    this.folderTodoService.eliminarTodos(id).subscribe((response:any)=>{
      alert(JSON.stringify(response))
      this.getTodos(); 
     
    });
  }






         }   