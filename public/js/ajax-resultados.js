window.onload = function () {
    $.ajax({
        url: '/calificaciones',
        type: 'GET',
        dataType: 'json',
        /* beforeSend: function() {
            console.log('enviada');
        },
        complete: function() {
            console.log('completada');
        }, */
        success: function (response) {
            var resp = response;
            var data = resp.data;
            var listado = $("[name=listadocalificaciones]");
            listado.empty();
            if (data.length < 1 || resp.success == false) {
                listado.append(
                    '<tr><td colspan="16" >No se encontraron calificaciones</td></tr>');
            } else {

                for (var i = 0; i < data.length; i++) {

                    var item = data[i];

                    /* const authHeader = item['cal_puntaje']
                    const split = authHeader.split('/')
                    const pregc = split[0]

                    if(pregc > 6){
                        const color =
                    } */

                    if(item['cur_nombre'] == null){
                        var curso = " ";
                    }else{
                        var curso = item['cur_nombre'];
                    }
                    if(item['sed_nombre'] == null){
                        var sede = " ";
                    }else{
                        var sede = item['sed_nombre'];
                    }
                    if(item['enc_nombre'] == null){
                        var encargado = " ";
                    }else{
                        var encargado = item['enc_nombre'];
                    }
                    if(item['empr_nit'] == null){
                        var nit_empresa = " ";
                        var nombre_empresa = " ";
                    }else{
                        var nit_empresa = item['empr_nit'];
                        var nombre_empresa = item['empr_nombre'];
                    }

                    listado.append(
                        '<tr>' +
                        '<td>' + item['cal_id'] + '</td>' +
                        '<td>' + item['emp_cedula'] + '</td>' +
                        '<td>' + item['emp_nombre'] + ' ' + item['emp_apellidos'] + '</td>' +
                        '<td>' + item['emp_cargo'] + '</td>' +

                        '<td>' + curso + '</td>' +
                        '<td>' + sede + '</td>' +
                        '<td>' + encargado + '</td>' +
                        '<td>' + nit_empresa + '</td>' +
                        '<td>' + nombre_empresa + '</td>' +
                        '<td>' +
                        '<div class="progress">' +
                        '<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="9">' + item['cal_puntaje'] + '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' + item['cal_calificacion'] + '%</td>' +
                        '<td>' + item['created_at'] + '</td>' +
                        '<td>' +
                        '<a class="btn btn-primary" onclick="buscar_datos(' + item['cal_id'] + ');" data-toggle="modal" data-target="#editModal"> <i class="bx bxs-edit-alt bx-xs" style="font-size: 20px!important;"></i></a>' +
                        '<a class="btn btn-success" onclick="ver_mas(' + item['cal_id'] + ')" data-toggle="modal" data-target="#verModal"> <i class="bx bx-show bx-xs" style="font-size: 20px!important;"></i></a>' +
                        '<a class="btn btn-danger" href="/resultados/pdf/' + item['cal_id'] + '"><i class="bx bxs-file-pdf"></i></a>'+
                        '</td>' +
                        '</tr>'
                    );
                }
            }
        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });
}

/* TABLA */
function cargarDatos() {

    var fecha_inicio = $("#div_form").find("[name=fecha_inicio]").val();
    var fecha_final = $("#div_form").find("[name=fecha_fin]").val();

    data = {
        'fecha_inicio': fecha_inicio,
        'fecha_final': fecha_final
    }


    $.ajax({
        url: '/g/calificaciones',
        type: 'GET',
        dataType: 'json',
        data: data,
        /* beforeSend: function () {
            console.log('enviada');
        },
        complete: function () {
            console.log('completada');
        }, */
        success: function (response) {
            var resp = response;
            var data = resp.data;
            var listado = $("[name=listadocalificaciones]");
            listado.empty();
            if (data.length < 1 || resp.success == false) {
                listado.append(
                    '<tr><td colspan="16" >No se encontraron calificaciones</td></tr>');
            } else {

                for (var i = 0; i < data.length; i++) {

                    var item = data[i];

                    if(item['cur_nombre'] == null){
                        var curso = " ";
                    }else{
                        var curso = item['cur_nombre'];
                    }
                    if(item['sed_nombre'] == null){
                        var sede = " ";
                    }else{
                        var sede = item['sed_nombre'];
                    }
                    if(item['enc_nombre'] == null){
                        var encargado = " ";
                    }else{
                        var encargado = item['enc_nombre'];
                    }
                    if(item['empr_nit'] == null){
                        var nit_empresa = " ";
                        var nombre_empresa = " ";
                    }else{
                        var nit_empresa = item['empr_nit'];
                        var nombre_empresa = item['empr_nombre'];
                    }

                    listado.append(
                        '<tr>' +
                        '<td>' + item['cal_id'] + '</td>' +
                        '<td>' + item['emp_cedula'] + '</td>' +
                        '<td>' + item['emp_nombre'] + ' ' + item['emp_apellidos'] + '</td>' +
                        '<td>' + item['emp_cargo'] + '</td>' +

                        '<td>' + curso + '</td>' +
                        '<td>' + sede + '</td>' +
                        '<td>' + encargado + '</td>' +
                        '<td>' + nit_empresa + '</td>' +
                        '<td>' + nombre_empresa + '</td>' +
                        '<td>' +
                        '<div class="progress">' +
                        '<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="9">' + item['cal_puntaje'] + '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' + item['cal_calificacion'] + '%</td>' +
                        '<td>' + item['created_at'] + '</td>' +
                        '<td>' +
                        '<a class="btn btn-primary" onclick="buscar_datos(' + item['cal_id'] + ');" data-toggle="modal" data-target="#editModal"> <i class="bx bxs-edit-alt bx-xs" style="font-size: 20px!important;"></i></a>' +
                        '<a class="btn btn-success" onclick="ver_mas(' + item['cal_id'] + ')" data-toggle="modal" data-target="#verModal"> <i class="bx bx-show bx-xs" style="font-size: 20px!important;"></i></a>' +
                        '<a class="btn btn-danger" href="/resultados/pdf/' + item['cal_id'] + '"><i class="bx bxs-file-pdf"></i></a>'+
                        '</td>' +
                        '</tr>'
                    );
                }
            }
        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });
}

function busqueda_avanzada() {
    var emp_cedula = $("#form_busqueda_avanzada").find("[name=emp_cedula]").val();
    var cur_id = $("#form_busqueda_avanzada").find("[name=cur_id]").val();
    var enc_id = $("#form_busqueda_avanzada").find("[name=enc_id]").val();

    var data = {
        'emp_cedula': emp_cedula,
        'cur_id': cur_id,
        'enc_id': enc_id
    }

    $.ajax({
        url: '/ba/calificaciones',
        type: 'GET',
        dataType: 'json',
        data: data,
        /* beforeSend: function() {
            console.log('enviada');
        },
        complete: function() {
            console.log('completada');
        }, */
        success: function (response) {
            var resp = response;
            var data = resp.data;
            var listado = $("[name=listadocalificaciones]");
            listado.empty();
            if (data.length < 1 || resp.success == false) {
                listado.append(
                    '<tr><td colspan="16" >No se encontraron calificaciones</td></tr>');
            } else {

                for (var i = 0; i < data.length; i++) {

                    var item = data[i];

                    if(item['cur_nombre'] == null){
                        var curso = " ";
                    }else{
                        var curso = item['cur_nombre'];
                    }
                    if(item['sed_nombre'] == null){
                        var sede = " ";
                    }else{
                        var sede = item['sed_nombre'];
                    }
                    if(item['enc_nombre'] == null){
                        var encargado = " ";
                    }else{
                        var encargado = item['enc_nombre'];
                    }
                    if(item['empr_nit'] == null){
                        var nit_empresa = " ";
                        var nombre_empresa = " ";
                    }else{
                        var nit_empresa = item['empr_nit'];
                        var nombre_empresa = item['empr_nombre'];
                    }

                    listado.append(
                        '<tr>' +
                        '<td>' + item['cal_id'] + '</td>' +
                        '<td>' + item['emp_cedula'] + '</td>' +
                        '<td>' + item['emp_nombre'] + ' ' + item['emp_apellidos'] + '</td>' +
                        '<td>' + item['emp_cargo'] + '</td>' +

                        '<td>' + curso + '</td>' +
                        '<td>' + sede + '</td>' +
                        '<td>' + encargado + '</td>' +
                        '<td>' + nit_empresa + '</td>' +
                        '<td>' + nombre_empresa + '</td>' +
                        '<td>' +
                        '<div class="progress">' +
                        '<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="9">' + item['cal_puntaje'] + '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' + item['cal_calificacion'] + '%</td>' +
                        '<td>' + item['created_at'] + '</td>' +
                        '<td>' +
                        '<a class="btn btn-primary" onclick="buscar_datos(' + item['cal_id'] + ');" data-toggle="modal" data-target="#editModal"> <i class="bx bxs-edit-alt bx-xs" style="font-size: 20px!important;"></i></a>' +
                        '<a class="btn btn-success" onclick="ver_mas(' + item['cal_id'] + ')" data-toggle="modal" data-target="#verModal"> <i class="bx bx-show bx-xs" style="font-size: 20px!important;"></i></a>' +
                        '<a class="btn btn-danger" href="/resultados/pdf/' + item['cal_id'] + '"><i class="bx bxs-file-pdf"></i></a>'+
                        '</td>' +
                        '</tr>'
                    );
                }
            }
        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });

}

function buscar_datos(cal_id) {

    var data = {
        'cal_id': cal_id,
    }

    let $select_curso = document.getElementById('cur_id');
    let $select_encargado = document.getElementById('enc_id');

    $.ajax({
        method: "GET",
        url: "/calificacion/get",
        dataType: 'json',
        data: data,
        /* beforeSend: function () {
            console.log('enviada');
        },
        complete: function () {
            console.log('completada');
        }, */
        success: function (response) {
            const datos = response.datos;
            const cursos = response.cursos;
            const encargados = response.encargados;

            document.getElementById('cal_id').value = datos[0].cal_id;
            document.getElementById('cal_codigo').value = datos[0].cal_codigo;
            document.getElementById('emp_nombre').value = datos[0].emp_nombre+' '+datos[0].emp_apellidos;
            document.getElementById('created_at').value = datos[0].created_at;
            if (datos[0].cal_calificacion != null) {
                document.getElementById('cal_calificacion').value = datos[0].cal_calificacion;
            }

            if (datos[0].cur_id == null) {

                let template = '<option class="form-control" selected disabled>-- Seleccione --</option>';
                cursos.forEach(cursos => {
                    template += `<option class="form-control" value="${cursos.cur_id}">${cursos.cur_nombre}</option>`;
                })
                $select_curso.innerHTML = template;

            } else {

                let template = `<option class="form-control" value="${datos[0].cur_id}">${datos[0].cur_nombre}</option>`;
                cursos.forEach(cursos => {
                    template += `<option class="form-control" value="${cursos.cur_id}">${cursos.cur_nombre}</option>`;
                })
                $select_curso.innerHTML = template;

            }

            if (datos[0].enc_id == null) {

                let template = '<option class="form-control" selected disabled>-- Seleccione --</option>'
                encargados.forEach(encargados => {
                    template += `<option class="form-control" value="${encargados.enc_id}">${encargados.enc_nombre}</option>`;
                })
                $select_encargado.innerHTML = template;

            } else {

                let template = `<option class="form-control" value="${datos[0].enc_id}">${datos[0].enc_nombre}</option>`;
                encargados.forEach(encargados => {
                    template += `<option class="form-control" value="${encargados.enc_id}">${encargados.enc_nombre}</option>`;
                })
                $select_encargado.innerHTML = template;

            }


        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });
}

function ver_mas(cal_id) {

    data = {
        'cal_id': cal_id,
    }


    $.ajax({
        url: '/resultados/vermas',
        type: 'GET',
        dataType: 'json',
        data: data,
        /* beforeSend: function () {
            console.log('enviada');
        },
        complete: function () {
            console.log('completada');
        }, */
        success: function (response) {
            var resp = response;
            var info_empleado = $("[name=info_empleado]");

            if(resp.cur_nombre == null){
                var curso = " ";
            }else{
                var curso = resp.cur_nombre;
            }
            if(resp.enc_nombre == null){
                var encargado = " ";
            }else{
                var encargado = resp.enc_nombre;
            }


            info_empleado.empty();
            info_empleado.append(
                '<tr>' +
                '<th scope="row">Cedula</th>' +
                '<td>' + resp.emp_cedula + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th scope="row">Nombre</th>' +
                '<td>' + resp.emp_nombre + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th scope="row">Operacion</th>' +
                '<td>' + resp.emp_cargo + '</td>' +
                '</tr>'
            );

            var info_calificacion = $("[name=info_calificacion]");
            info_calificacion.empty();
            info_calificacion.append(
                /* '<tr>' +
                '<th scope="row">Codigo</th>' +
                '<td colspan="3">' + resp.cal_codigo + '</td>' +
                '</tr>' + */
                '<tr>' +
                '<th scope="row">Curso</th>' +
                '<td>' + curso + '</td>' +
                '<th scope="row">Encargado</th>' +
                '<td>' + encargado + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th scope="row">Calificacion</th>' +
                '<td colspan="1">' + resp.cal_calificacion + '%</td>' +
                '<th scope="row">Puntaje</th>' +
                '<td colspan="1">' + resp.cal_puntaje + '</td>' +
                '</tr>'
            );

        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });
}
