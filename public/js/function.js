$(document).ready(function () {
    $('#tablaEmpleados').DataTable();

});

$(document).on("click", ".open-AddBookDialog", function () {
    idEmpleado = $(this).data('id');
});

var idEmpleado;
/**Funcion validaciones campos */
function validaciones(nombre, correo, sexo, area, descripcion, roles) {

    let flarValidacion = false;
    let mensaje = "";

    if (nombre == "") {
        mensaje += "Nombre completo<br>";
        flarValidacion = true;
    }

    if (correo == "") {
        mensaje += "Correo electrónico<br>";
    }

    if (descripcion == "") {
        mensaje += "Descripción<br>";
    }

    if (!sexo) {
        mensaje += "Sexo<br>";
    }

    if (area == "") {
        mensaje += "área<br>";
    }

    if (!roles) {
        mensaje += "Roles<br>";
    }

    // validación estructura campo nombre
    var expLetras = "^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]+$";
    if (nombre.match(expLetras) == null && flarValidacion == false) {
        Swal.fire('Error', "El campo 'Nombre completo' no debe contener números ni caracteres especiales", 'error');
        return false;
    }

    // validación estructura campo correo
    if (!/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(correo) && correo != "") {
        Swal.fire('Error', "Correo electrónico no válido", 'error');
        return false;
    }
    if (mensaje != "") {
        Swal.fire('Campos obligatorios: ', mensaje, 'error');
        return false;
    }
    return true;
}

/** Funcion para agregar el empleado */
function add() {

    let nombre = $("#nombre").val();
    let correo = $("#correo").val();
    let sexo = $("#sexo").val();
    let area = $("#area").val();
    let descripcion = $("#descripcion").val();
    let boletin = 0;
    let boletinInput = $('input[name="boletin"]:checked');

    if(boletinInput.length > 0){
        boletin = 1;
    }

    let sexoObli = document.querySelector('input[name="sexo"]:checked');
    let rolesObli = document.querySelector('input[name="roles"]:checked')

    let roles = [];
    $("input[type=checkbox][name=roles]:checked").each(function () {
        roles.push(this.value);
    });

    var flag = this.validaciones(nombre, correo, sexoObli, area, descripcion, rolesObli);

    // validar campos obligatorios.
    if (flag == true) {

        // se envian los datos
        $.ajax({
            url: 'api/guardarEmpleado',
            data: {
                'nombre': nombre,
                'correo': correo,
                'sexo': sexo,
                'area': area,
                'descripcion': descripcion,
                'roles': JSON.stringify(roles),
                'boletin': boletin,
            },
            type: 'post',
            success: function (response) {

                Swal.fire('Satisfactorio', 'Empleado guardado correctamente.', 'success').then((result) => {
                    if (result.isConfirmed) {
                        // debe de recargar NO OLVIDAR
                    }
                });
            },
            error: function (x) {
                Swal.fire('Error', x.responseJSON.msj, 'error');
            }
        });
    }

}

/**Función para abrir el modal con la información del empleado */
function openModalEdit(id) {

    // se envian los datos
    $.ajax({
        url: 'api/openModalEdit/' + id,
        type: 'get',
        success: function (response) {
            
            idEmpleado = response.empleado.id;

            $("#nombreEdit").val(response.empleado.nombre);
            $("#correoEdit").val(response.empleado.email);
            $("#areaEdit").val(response.empleado.area_id);
            $("#descripcionEdit").val(response.empleado.descripcion);
            if(response.empleado.sexo == "M"){
                $('#sexoEditM').attr('checked', 'checked');
            }else{
                $('#sexoEditF').attr('checked', 'checked');
            }

            $("input[type=checkbox][name=rolesEdit]").each(function () {
                let found = response.rolesEmpleado.find(element => element.rol_id == this.value);
                if(found){
                    $(this).prop("checked", true);

                }
            });

            $('#editEmployeeModal').modal('show');
        },
        error: function (x) {
            idEmpleado = null;
            //nos dara el error si es que hay alguno
            alert('error: ' + JSON.stringify(x));
        }
    });

}

/**Función para editar el empleado seleccionado */
function editEmpleado() {

    let nombre = $("#nombreEdit").val();
    let correo = $("#correoEdit").val();
    let sexo = document.querySelector('input[name="sexoEdit"]:checked').value;
    let area = $("#areaEdit").val();
    let descripcion = $("#descripcionEdit").val();
    let boletin = $("#boletinEdit").val();
    console.log(document.querySelector('input[name="sexoEdit"]:checked'));
    let sexoObli = document.querySelector('input[name="sexoEdit"]:checked');
    
    let rolesObli = document.querySelector('input[name="rolesEdit"]:checked')

    let roles = [];
    $("input[type=checkbox][name=rolesEdit]:checked").each(function () {
        roles.push(this.value);
    });

    var flag = this.validaciones(nombre, correo, sexoObli, area, descripcion, rolesObli);

    // validar campos obligatorios.
    if (flag == true) {

        // se envian los datos
        $.ajax({
            url: 'api/editEmpleado/'+idEmpleado,
            data: {
                'nombre': nombre,
                'correo': correo,
                'sexo': sexo,
                'area': area,
                'descripcion': descripcion,
                'roles': JSON.stringify(roles),
                'boletin': boletin,
            },
            type: 'put',
            success: function (response) {

                Swal.fire('Satisfactorio', 'Empleado actualizado correctamente.', 'success').then((result) => {
                    if (result.isConfirmed) {
                        // debe de recargar NO OLVIDAR
                    }
                });
            },
            error: function (x) {
                Swal.fire('Error', x.responseJSON.msj, 'error');
            }
        });
    }
}