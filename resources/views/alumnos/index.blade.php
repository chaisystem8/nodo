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
   <body>
       <div class="container">

       <h1>Chaisystem</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">       
            <div class="container-fluid">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" onclick="nuevoAlumno()">Nuevo Usuario</button>         
                <form id="forms"class="d-flex" onsubmit="return search()">
                <input id="buscar" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success" type="button" onclick="search()" >Buscar</button>
                </form>          
            </div>
        </nav>

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
                        <div class="form-group col-md-12">
                           <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"/>
                           <input type="hidden" name="id" id="id_alumno" value=""/>
                           <label for="nombre">Nombre</label>
                           <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                        </div>
                        <div id="divapellido" class="form-group col-md-12">
                           <label for="apellido">Apellido</label>
                           <input type="text" class="form-control" id="apellido" placeholder="Apellido">
                        </div>
                        <div class="form-group col-md-12">
                           <label for="usuario">Usuario</label>
                           <input type="text" class="form-control" id="usuario" placeholder="Usuario">
                        </div>
                        <div class="form-group col-md-12">
                           <label for="email">Correo</label>
                           <input type="email" class="form-control" id="correo" placeholder="Correo">
                        </div>
                        <div class="form-group col-md-12" id="divpass">
                           <label for="password">Password</label>
                           <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div id="divdetalle">
                            <div class="form-group col-md-12">
                                <label>Grado y grupo</label>
                                <div class="input-group">                                    
                                    <input type="text" id="grado"  class="form-control">
                                    <input type="text" id="grupo" class="form-control">
                                  </div>                            
                             </div>
                             <div class="form-group col-md-12">
                                <label>Periodo</label>
                                <input type="text" class="form-control" id="periodo">
                             </div>
                             <div class="form-group col-md-12">
                                <label>Materias</label>
                                <input type="text" class="form-control" id="materias">
                             </div>
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

   let grado =  document.getElementById('grado');  
   let grupo =  document.getElementById('grupo');  
   let periodo =  document.getElementById('periodo');  
   let materias =  document.getElementById('materias');   


   
   $(function() {
       lista()    
   });
   
    ////////////////////CRUD FETCH  ///////////////////////
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
        $("#tbody").empty()
        let tr = '';
        data.forEach(data2 => {
            console.log(data2.nombre)
            tr += `<tr>
                <td>`+data2.id_alumno+`</td>
                <td>`+data2.nombre+` `+data2.apellido+`</td>
                <td>`+data2.usuario+`</td>
                <td>`+data2.correo+`</td>
                <td><button type="button" class="btn btn-info" onclick="detalle(`+data2.id_alumno+`)">Detalle</button>
                    <button type="button" class="btn btn-primary" onclick="editar(`+data2.id_alumno+`)">Editar</button>         
                    <button type="button" class="btn btn-danger" onclick="eliminar(`+data2.id_alumno+`)">Eliminar</button></td>
                </tr>`
        });
        $("#tbody").append(tr);        
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
        $("#divpass, #divapellido, #btnguardar").show();
        $("#divdetalle").hide();            
        id_alumno.value = data.id_alumno
        nombre.value = data.nombre
        correo.value = data.correo 
        apellido.value = data.apellido
        usuario.value = data.usuario
        password.value = ''
        $("#modal").modal('show');
    }
    async function eliminar(id) {
        const res = await fetch('http://127.0.0.1:8000/api/eliminar/'+id, {
            method:'DELETE',
            mode: 'cors',
            headers:{
                'X-CSRF-TOKEN': _token.value,
                'Content-Type': 'application/json'
            },   
        });
        const data = await res.json()
        console.log(data)
        lista()
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
   ////////////////////CRUD FETCH FIN ///////////////////////


    /////// SORT BOOTSTRAP TABLE //////////
        function sortTable(table, col, reverse) {
            var tb = table.tBodies[0], // use `<tbody>` to ignore `<thead>` and `<tfoot>` rows
                tr = Array.prototype.slice.call(tb.rows, 0), // put rows into array
                i;
            reverse = -((+reverse) || -1);
            tr = tr.sort(function (a, b) { // sort rows
                return reverse // `-1 *` if want opposite order
                    * (a.cells[col].textContent.trim() // using `.textContent.trim()` for test
                        .localeCompare(b.cells[col].textContent.trim())
                    );
            });
            for(i = 0; i < tr.length; ++i) tb.appendChild(tr[i]); // append each row in order
        }

        function makeSortable(table) {
            var th = table.tHead, i;
            th && (th = th.rows[0]) && (th = th.cells);
            if (th) i = th.length;
            else return; // if no `<thead>` then do nothing
            while (--i >= 0) (function (i) {
                var dir = 1;
                th[i].addEventListener('click', function () {sortTable(table, i, (dir = 1 - dir))});
            }(i));
        }

        function makeAllSortable(parent) {
            parent = parent || document.body;
            var t = parent.getElementsByTagName('table'), i = t.length;
            while (--i >= 0) makeSortable(t[i]);
        }

        window.onload = function () {makeAllSortable();};
    /////// SORT BOOTSTRAP TABLE FIN//////////


    function clearInput(){              
       id_alumno.value = nombre.value = correo.value = apellido.value = usuario.value = password.value = ""
    }
    function nuevoAlumno(){
        clearInput()
        $("#divpass").show()
        $("#divdetalle").hide();
    }
   
    $("#forms").on("keypress", function (event) {
        var keyPressed = event.keyCode || event.which;
        if (keyPressed === 13) {
            search()
            event.preventDefault();
            return false;
        }
    });

    async function search(){       
        var cadena = $("#buscar").val();
        if(cadena == ''){
            lista();
            return 0
        }
        
        const res = await fetch('http://127.0.0.1:8000/api/buscar/'+cadena, {
            method:'GET',
            mode: 'cors',
            headers:{
                'X-CSRF-TOKEN': _token.value,
                'Content-Type': 'application/json'
            },   
        });
         const data = await res.json()                       
        $("#tbody").empty()
        let tr = '';
        data.forEach(data2 => {
            console.log(data2.nombre)
            tr += `<tr>
                <td>`+data2.id_alumno+`</td>
                <td>`+data2.nombre+` `+data2.apellido+`</td>
                <td>`+data2.usuario+`</td>
                <td>`+data2.correo+`</td>
                <td><button type="button" class="btn btn-info" onclick="detalle(`+data2.id_alumno+`)">Detalle</button>
                    <button type="button" class="btn btn-primary" onclick="editar(`+data2.id_alumno+`)">Editar</button>         
                    <button type="button" class="btn btn-danger" onclick="eliminar(`+data2.id_alumno+`)">Eliminar</button></td>
                </tr>`
        });
        $("#tbody").append(tr); 

    }
    async function detalle(id) {
        const res = await fetch('http://127.0.0.1:8000/api/detalle/'+id, {
            method:'GET',
            mode: 'cors',
            headers:{
                'X-CSRF-TOKEN': _token.value,
                'Content-Type': 'application/json'
            },   
        });
        clearInput()
        const data = await res.json()  
        console.log(data)              
        id_alumno.value = data.id_alumno
        nombre.value = data.nombre
        correo.value = data.correo         
        usuario.value = data.usuario

        grado.value = data.grado = (data.grado === undefined) ? 'Sin grado' : data.grado
        grupo.value = data.grupo = (data.grupo === undefined) ? 'Sin grupo' : data.grupo
        periodo.value = data.periodo = (data.periodo === undefined) ? 'Sin periodo' : data.periodo
        materias.value = data.materias = (data.materias === undefined) ? 'Sin materias' : data.materias

    

        
        $("#divpass, #divapellido, #btnguardar").hide();
        $("#divdetalle").show();
        $("#modal").modal('show');

    }
   
</script>