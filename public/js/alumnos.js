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
        tr += `<tr>
            <td>`+data2.id_alumno+`</td>
            <td>`+data2.nombre+` `+data2.apellido+`</td>
            <td>`+data2.usuario+`</td>
            <td>`+data2.correo+`</td>
            <td><button type="button" class="btn btn-info" onclick="detalle(`+data2.id_alumno+`,0)">Detalle ORM</button>
                <button type="button" class="btn btn-info" onclick="detalle(`+data2.id_alumno+`,1)">Detalle SP</button>
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
async function detalle(id,sp) {
    const res = await fetch('http://127.0.0.1:8000/api/detalle/'+id+'?sp='+sp, {
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
    $("#divpass, #divapellido, #btnguardar").show();
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