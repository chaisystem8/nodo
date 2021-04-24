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

        <br><h1>Isaias Soto - Examen</h1><br>
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
<script src="{{ asset('js/alumnos.js')}}" ></script>
