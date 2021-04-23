<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Nodo - Alumnos</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
   </head>
   <body class="antialiased">
      <div class="container">
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" onclick="clearInput()">Nuevo Usuario</button>
         <!-- Modal -->
         <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Usuario</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"/>
                           <input type="hidden" name="id" id="id_alumno" value=""/>
                           <label for="nombre">Nombre</label>
                           <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="apellido">Apellido</label>
                           <input type="text" class="form-control" id="apellido" placeholder="Apellido">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="usuario">Usuario</label>
                           <input type="text" class="form-control" id="usuario" placeholder="Usuario">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Correo</label>
                           <input type="email" class="form-control" id="correo" placeholder="Correo">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="password">Password</label>
                           <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                     <button id="btnguardar" type="button" onclick="guardarAlumno()" class="btn btn-primary">Guardar</button>                     
                  </div>
               </div>
            </div>
         </div>
         <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid">
               <table class="table">
                  <thead>
                     <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ususario</th>
                        <th scope="col">Correo</th>
                        <th>Acciones</th>
                     </tr>
                  </thead>
                  <tbody id="tbody">
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
   let id_alumno =  document.getElementById('id_alumno'); 
   let nombre =  document.getElementById('nombre');    
   let correo =  document.getElementById('correo');
   let apellido =  document.getElementById('apellido');
   let usuario =  document.getElementById('usuario');
   let password =  document.getElementById('password');
   let _token =  document.getElementById('token');
   
   $(function() {
       lista()    
   });
   
   async function lista(){      
       const res = await fetch('http://127.0.0.1:8000/api/alumnos', {
           method:'GET',
           mode: 'cors',
           headers:{
               'X-CSRF-TOKEN': _token.value,
               'Content-Type': 'application/json'
           },   
       });      
       const data = await res.json()                       
       $("tbody").empty()
       let tr = '';
       data.forEach(data2 => {
           console.log(data2.nombre)
           tr += `<tr>
               <th>`+data2.id_alumno+`</th>
               <td>`+data2.nombre+` `+data2.apellido+`</td>
               <td>`+data2.usuario+`</td>
               <td>`+data2.correo+`</td>
               <td><button type="button" class="btn btn-info" onclick="detalle(`+data2.id_alumno+`)">Detalle</button>
                   <button type="button" class="btn btn-primary" onclick="editar(`+data2.id_alumno+`)">Editar</button>         
                   <button type="button" class="btn btn-danger" onclick="eliminar(`+data2.id_alumno+`)">Eliminar</button></td>
               </tr>`
       });
       $("tbody").append(tr);        
   }
   
   async function editar(id){
       const res = await fetch('http://127.0.0.1:8000/api/alumnos/'+id, {
           method:'GET',
           mode: 'cors',
           headers:{
               'X-CSRF-TOKEN': _token.value,
               'Content-Type': 'application/json'
           },   
       });
       const data = await res.json()            
       id_alumno.value = data.id_alumno
       nombre.value = data.nombre
       correo.value = data.correo 
       apellido.value = data.apellido
       usuario.value = data.usuario
       $("#modal").modal('show');
   }
    
   async function guardarAlumno(){   
       let obj = { id_alumno:id_alumno.value, nombre:nombre.value, correo:correo.value, apellido:apellido.value, usuario:usuario.value, password:password.value };
       let url = (id_alumno.value > 0) ? 'http://127.0.0.1:8000/api/actualizar' : 'http://127.0.0.1:8000/api/guardar'; 
       let method = (id_alumno.value > 0) ? 'PUT' : 'POST';  

       const res = await fetch(url, {
            method:method,
            mode: 'cors',
            headers:{
                  'X-CSRF-TOKEN': _token.value,
                  'Content-Type': 'application/json'
           },
           body:JSON.stringify(obj)      
           });
      
           const data = await res.json()            
           lista()
           $("#modal").modal('hide')
          }
   
   function clearInput(){              
       id_alumno.value = nombre.value = correo.value = apellido.value = usuario.value = password.value = ""
   }
   
</script>