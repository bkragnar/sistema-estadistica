/* dropdown */
$(function() {
    $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
        event.preventDefault();
        event.stopPropagation();

        //method 1: remove show from sibilings and their children under your first parent

        /*if (!$(this).next().hasClass('show')) {
                
                    $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
                }  */


        //method 2: remove show from all siblings of all your parents
        $(this).parents('.dropdown-submenu').siblings().find('.show').removeClass("show");

        $(this).siblings().toggleClass("show");


        //collapse all after nav is closed
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

    });
});
//------------------------------------------------------------
//------------cambiar color botones alertify------------------

alertify.defaults.transition = "slide"; //desplasamiento de alerta para eliminar registro
alertify.defaults.theme.ok = "btn btn-primary";
alertify.defaults.theme.cancel = "btn btn-danger";

//------------------------------------------------------------
//------------------------------------------------------------


//------------------------------------------------------------
//----------------------MANTENEDORES--------------------------
//------------------------------------------------------------

//---------- Mantenedor Provincia ---------------------
function AgregarDatosProvincia(datos_provincia) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_provincia,
        success: function(r) {
            if (r == 1) {
                $('#frm-nueva-provincia')[0].reset(); //limpia el formulario
                $("#carga_provincia").load("web/mant_provincia.php");
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarProvincia(id_provincia) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_provincia=" + id_provincia + "&seccion=provincia",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_provincia').val(datos['id_provincia']);
            $('#codigo_provincia_up').val(datos['codigo_provincia']);
            $('#nombre_provincia_up').val(datos['nombre_provincia']);
        }
    });
}

function EditarProvincia(datos_provincia_up) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: datos_provincia_up,
        success: function(r) {
            if (r == 1) {
                $("#carga_provincia").load("web/mant_provincia.php");
                alertify.success("Registro editado con exito");
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoProvincia(id_provincia) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarProvincia(id_provincia); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarProvincia(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=provincia",
        success: function(r) {
            if (r == 1) {
                $("#carga_provincia").load("web/mant_provincia.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//---------- Mantenedor Comuna ---------------------
function AgregarDatosComuna(datos_comuna) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_comuna,
        success: function(r) {
            if (r == 1) {
                $('#frm-nueva-comuna')[0].reset(); //limpia el formulario
                $("#carga_comuna").load("web/mant_comuna.php");
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarComuna(id_comuna) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_comuna=" + id_comuna + "&seccion=comuna",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_comuna').val(datos['id_comuna']);
            $('#codigo_comuna_up').val(datos['codigo_comuna']);
            $('#nombre_comuna_up').val(datos['nombre_comuna']);
            $('#codigo_provincia_comuna_up').val(datos['codigo_provincia']);
        }
    });
}

function EditarComuna(datos_comuna_up) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: datos_comuna_up,
        success: function(r) {
            if (r == 1) {
                $("#carga_comuna").load("web/mant_comuna.php");
                alertify.success("Registro editado con exito");
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoComuna(id_comuna) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarComuna(id_comuna); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarComuna(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=comuna",
        success: function(r) {
            if (r == 1) {
                $("#carga_comuna").load("web/mant_comuna.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}

function MasivoDatosComuna() {
    var masivo_comuna = new FormData($("#frm-carga-comuna")[0]);

    $.ajax({
        type: "POST",
        url: "static/transaccion/sube.php",
        data: masivo_comuna,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#form-masivo-comuna').hide();
            $('#spinner-comuna').show();
        },
        success: function(r) {
            alert(r);
            if (r == 1) {
                $('#archivo_comuna').val(null); //limpia el formulario por id
                $("#carga_comuna").load("web/mant_comuna.php");
                alertify.success("Registros agregados y/o actualizados con exito");
                $('#form-masivo-comuna').show();
                $('#spinner-comuna').hide();
                $('#masivo_comuna').modal('hide'); //cierra el modal carga masiva
            } else if (r == 2) {
                $('#archivo_comuna').val(null); //limpia el formulario por id
                $("#carga_comuna").load("web/mant_comuna.php");
                alertify.success("No fue posible agregar y/o actualizar todos los registros");
                $('#form-masivo-comuna').show();
                $('#spinner-comuna').hide();
            } else {
                $('#form-masivo-comuna').show();
                $('#spinner-comuna').hide();
                alertify.error("No es posible incorporar los registros");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//---------- Mantenedor Tipo Establecimientos ----------------
function AgregarDatosTipoEstable(datos_tipo_estable) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_tipo_estable,
        success: function(r) {
            if (r == 1) {
                $('#frm-nuevo-tipo-estable')[0].reset(); //limpia el formulario
                $("#carga_tipoestable").load("web/mant_tipoestable.php");
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarTipoEstable(id_tipo_estable) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_tipo_estable=" + id_tipo_estable + "&seccion=tipo_estable",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_tipo_estable').val(datos['id_tipo_estable']);
            $('#codigo_tipo_estable_up').val(datos['codigo_tipo']);
            $('#nombre_tipo_estable_up').val(datos['nombre_tipo']);
        }
    });
}

function EditarTipoEstable(datos_tipo_estable_up) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: datos_tipo_estable_up,
        success: function(r) {
            if (r == 1) {
                $("#carga_tipoestable").load("web/mant_tipoestable.php");
                alertify.success("Registro editado con exito");
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoTipoEstable(id_tipo_estable) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarTipoEstable(id_tipo_estable); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarTipoEstable(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=tipo_estable",
        success: function(r) {
            if (r == 1) {
                $("#carga_tipoestable").load("web/mant_tipoestable.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//---------- Mantenedor Establecimientos ---------------------
function AgregarDatosEstable(datos_estable) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_estable,
        success: function(r) {
            if (r == 1) {
                $('#frm-nuevo-estable')[0].reset(); //limpia el formulario
                $("#carga_estable").load("web/mant_estable.php");
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarEstable(id_estable) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_estable=" + id_estable + "&seccion=establecimiento",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_estable').val(datos['id_estable']);
            $('#codigo_estable_up').val(datos['codigo_estable']);
            $('#nombre_estable_up').val(datos['nombre_estable']);
            $('#cod_comuna_estable_up').val(datos['codigo_comuna']);
            $('#cod_provincia_estable_up').val(datos['codigo_provincia']);
            $('#tipo_estable_up').val(datos['tipo_estable']);
        }
    });
}

function EditarEstable(datos_estable_up) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: datos_estable_up,
        success: function(r) {
            if (r == 1) {
                $("#carga_estable").load("web/mant_estable.php");
                alertify.success("Registro editado con exito");
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoEstable(id_estable) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarEstable(id_estable); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarEstable(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=establecimiento",
        success: function(r) {
            if (r == 1) {
                $("#carga_estable").load("web/mant_estable.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}

function MasivoDatosEstable() {
    var masivo_estable = new FormData($("#frm-carga-estable")[0]);
    $.ajax({
        type: "POST",
        url: "static/transaccion/sube.php",
        data: masivo_estable,
        cache: false,
        contentType: false,
        processData: false,
        success: function(r) {
            alert(r);
            if (r == "valido") {
                $('#frm-carga-estable')[0].reset(); //limpia el formulario
                $("#carga_estable").load("web/mant_estable.php");
                alertify.success("Registros agregados con exito");
            } else {
                alertify.error("No es posible guardar los registros");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//---------- Mantenedor Tipo Lista de Espera ---------------------
function AgregarDatosTipoLe(datos_tipo_le) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_tipo_le,
        success: function(r) {
            if (r == 1) {
                $('#frm-nuevo-tipo-le')[0].reset(); //limpia el formulario
                $("#carga_tipo_le").load("web/mant_tipo_le.php");
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarTipoLe(id_tipo_le) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_tipo_le=" + id_tipo_le + "&seccion=tipo-le",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_estable').val(datos['id_tipo_le']);
            $('#codigo_tipo_le_up').val(datos['codigo_tipo_le']);
            $('#nombre_tipo_le_up').val(datos['nombre_tipo_le']);
        }
    });
}

function EditarTipoLe(datos_tipo_le_up) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: datos_tipo_le_up,
        success: function(r) {
            if (r == 1) {
                $("#carga_tipo_le").load("web/mant_tipo_le.php");
                alertify.success("Registro editado con exito");
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoTipoLe(id_tipo_le) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarTipoLe(id_tipo_le); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarTipoLe(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=tipo-le",
        success: function(r) {
            if (r == 1) {
                $("#carga_tipo_le").load("web/mant_tipo_le.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}

function MasivoDatosTipoLe() {
    var masivo_estable = new FormData($("#frm-carga-tipo-le")[0]);
    $.ajax({
        type: "POST",
        url: "static/transaccion/sube.php",
        data: masivo_estable,
        cache: false,
        contentType: false,
        processData: false,
        success: function(r) {
            if (r == "valido") {
                $('#frm-carga-tipo-le')[0].reset(); //limpia el formulario
                $("#carga_tipo_le").load("web/mant_tipo_le.php");
                alertify.success("Registros agregados con exito");
            } else {
                alertify.error("No es posible guardar los registros");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//-------------- Mantenedor linea base -----------------------
function AgregarDatosLineaBase(datos_linea_base) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_linea_base,
        success: function(r) {
            if (r == 1) {
                $('#frm-nuevo-lines-base')[0].reset(); //limpia el formulario
                $("#carga_linea-base").load("web/mant_linea_base.php");
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarLineaBase(id_linea_base) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_lb=" + id_linea_base + "&seccion=linea-base",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_linea_base').val(datos['id_lb']);
            $('#estable_linea_base_up').val(datos['codigo_estable_lb']);
            $('#cantidad_linea_base_up').val(datos['cantidad_lb']);
            $('#anio_linea_base_up').val(datos['anio_lb']);
        }
    });
}

function EditarLineaBase(editar_linea_base) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: editar_linea_base,
        success: function(r) {
            if (r == 1) {
                $("#carga_linea-base").load("web/mant_linea_base.php");
                alertify.success("Registro editado con exito");
                $('#editar_linea-base').modal('hide'); //cierra el modal carga masiva
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoLineaBase(id_linea_base) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarLineaBase(id_linea_base); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarLineaBase(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=linea-base",
        success: function(r) {
            if (r == 1) {
                $("#carga_linea-base").load("web/mant_linea_base.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}

function MasivoDatosLineaBase() {
    var masivo_estable = new FormData($("#frm-carga-linea-base")[0]);
    $.ajax({
        type: "POST",
        url: "static/transaccion/sube.php",
        data: masivo_estable,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#form-masivo-lb').hide();
            $('#spinner-lb').show();
        },
        success: function(r) {
            if (r == 1) {
                $("#arch_lb").val(null); //limpia el formulario por id
                $("#carga_linea-base").load("web/mant_linea_base.php");
                alertify.success("Registros agregados y/o actualizados con exito");
                $('#form-masivo-lb').show();
                $('#spinner-lb').hide();
                $('#masivo_linea-base').modal('hide'); //cierra el modal carga masiva
            } else if (r == 2) {
                $("#arch_lb").val(null); //limpia el formulario por id
                $("#carga_linea-base").load("web/mant_linea_base.php");
                alertify.warning("No fue posible agregar y/o actualizar todos los registros");
                $('#form-masivo-lb').show();
                $('#spinner-lb').hide();
            } else {
                $('#form-masivo-lb').show();
                $('#spinner-lb').hide();
                alertify.error("No es posible incorporar los registros");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//-------------- Mantenedor porcentaje LB -----------------------
function AgregarDatosPorcentajeLB(datos_porcentaje_lb) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_porcentaje_lb,
        success: function(r) {
            if (r == 1) {
                $('#frm-nuevo-porcentaje-lb')[0].reset(); //limpia el formulario
                $('#carga_porcentaje_lb').load("web/mant_porcentaje_lb.php");
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarPorcentajeLB(id_porcentaje_lb) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_porc=" + id_porcentaje_lb + "&seccion=porcentaje-lb",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_porc_lb').val(datos['id_porc']);
            $('#tipo_estable_porcentaje_lb_up').val(datos['tipo_estable_porc']);
            $('#primer_porcentaje_lb_up').val(datos['primer_porc']);
            $('#segundo_porcentaje_lb_up').val(datos['segundo_porc']);
            $('#tercer_porcentaje_lb_up').val(datos['tercer_porc']);
            $('#cuarto_porcentaje_lb_up').val(datos['cuarto_porc']);
            $('#anio_porcentaje_lb_up').val(datos['anio_porc']);
        }
    });
}

function EditarPorcentajeLB(editar_porcentaje_lb) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: editar_porcentaje_lb,
        success: function(r) {
            if (r == 1) {
                $('#frm-editar-porcentaje-lb')[0].reset(); //limpia el formulario
                $('#carga_porcentaje_lb').load("web/mant_porcentaje_lb.php");
                alertify.success("Registro editado con exito");
                $('#editar_porcentaje_lb').modal('hide'); //cierra el modal carga masiva
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoPorcentajeLB(id_porcentaje_lb) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarPorcentajeLB(id_porcentaje_lb); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarPorcentajeLB(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=porcentaje-lb",
        success: function(r) {
            if (r == 1) {
                $('#carga_porcentaje_lb').load("web/mant_porcentaje_lb.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}

function MasivoDatosPorcentajeLB() {
    var masivo_estable = new FormData($("#frm-carga-porcentaje-lb")[0]);
    $.ajax({
        type: "POST",
        url: "static/transaccion/sube.php",
        data: masivo_estable,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#form-masivo-porcentaje-lb').hide();
            $('#spinner-porcentaje-lb').show();
        },
        success: function(r) {
            if (r == 1) {
                $("#arch_porcentaje_lb").val(null); //limpia el formulario por id
                $('#carga_porcentaje_lb').load("web/mant_porcentaje_lb.php");
                alertify.success("Registros agregados y/o actualizados con exito");
                $('#form-masivo-porcentaje-lb').show();
                $('#spinner-porcentaje-lb').hide();
                $('#masivo_porcentaje_lb').modal('hide'); //cierra el modal carga masiva
            } else if (r == 2) {
                $("#arch_porcentaje_lb").val(null); //limpia el formulario por id
                $('#carga_porcentaje_lb').load("web/mant_porcentaje_lb.php");
                alertify.warning("No fue posible agregar y/o actualizar todos los registros");
                $('#form-masivo-porcentaje-lb').show();
                $('#spinner-porcentaje-lb').hide();
            } else {
                $('#form-masivo-porcentaje-lb').show();
                $('#spinner-porcentaje-lb').hide();
                alertify.error("No es posible incorporar los registros");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//-------------- Mantenedor egreso le -----------------------
function AgregarDatosEgresoLE(datos_egreso_le) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_egreso_le,
        success: function(r) {
            if (r == 1) {
                $('#frm-nuevo-egreso-le')[0].reset(); //limpia el formulario
                $('#carga_egreso_le').load('web/mant_egreso_le.php');
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarEgresoLE(id_egreso_le) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_egreso=" + id_egreso_le + "&seccion=egreso-le",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_egreso_le').val(datos['id_eg']);
            $('#estable_egreso_le_up').val(datos['estable_eg']);
            $('#cantidad_egreso_le_up').val(datos['cantidad_eg']);
            $('#mes_egreso_le_up').val(datos['mes_eg']);
            $('#anio_egreso_le_up').val(datos['anio_eg']);
            $('#tipo_le_egreso_le_up').val(datos['tipo_le_eg']);
        }
    });
}

function EditarEgresoLE(editar_egreso_le) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: editar_egreso_le,
        success: function(r) {
            if (r == 1) {
                $('#frm-editar-egreso-le')[0].reset(); //limpia el formulario
                $('#carga_egreso_le').load('web/mant_egreso_le.php');
                alertify.success("Registro editado con exito");
                $('#editar_egreso_le').modal('hide'); //cierra el modal carga masiva
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoEgresoLE(id_egreso_le) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarEgresoLE(id_egreso_le); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarEgresoLE(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=egreso-le",
        success: function(r) {
            if (r == 1) {
                $('#carga_egreso_le').load('web/mant_egreso_le.php');
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}

function MasivoDatosEgresoLE() {
    var masivo_egreso_le = new FormData($("#frm-carga-egreso-le")[0]);
    $.ajax({
        type: "POST",
        url: "static/transaccion/sube.php",
        data: masivo_egreso_le,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#form-masivo-egreso-le').hide();
            $('#spinner-egreso-le').show();
        },
        success: function(r) {
            alert(r);
            if (r == 1) {
                $("#arch_egreso_le").val(null); //limpia el formulario por id
                $('#carga_egreso_le').load('web/mant_egreso_le.php');
                alertify.success("Registros agregados y/o actualizados con exito");
                $('#form-masivo-egreso-le').show();
                $('#spinner-egreso-le').hide();
                $('#masivo_egreso_le').modal('hide'); //cierra el modal carga masiva
            } else if (r == 2) {
                $("#arch_egreso_le").val(null); //limpia el formulario por id
                $('#carga_egreso_le').load('web/mant_egreso_le.php');
                alertify.warning("No fue posible agregar y/o actualizar todos los registros");
                $('#form-masivo-egreso-le').show();
                $('#spinner-egreso-le').hide();
            } else {
                $('#form-masivo-egreso-le').show();
                $('#spinner-egreso-le').hide();
                alertify.error("No es posible incorporar los registros");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//----------------- Mantenedor tipo ges -----------------------
function AgregarDatosTipoGes(datos_tipoges) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_tipoges,
        success: function(r) {
            if (r == 1) {
                $('#frm-nuevo-tipoges')[0].reset(); //limpia el formulario
                $("#carga_tipoges").load("web/mant_tipoges.php");
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarTipoGes(id_tipoges) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_tipo_ges=" + id_tipoges + "&seccion=tipoges",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_tipoges').val(datos['id_tipoges']);
            $('#codigo_tipoges_up').val(datos['codigo_tipoges']);
            $('#nombre_tipoges_up').val(datos['nombre_tipoges']);
        }
    });
}

function EditarTipoGes(editar_tipoges) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: editar_tipoges,
        success: function(r) {
            if (r == 1) {
                $('#frm-editar-tipoges')[0].reset(); //limpia el formulario
                $("#carga_tipoges").load("web/mant_tipoges.php");
                alertify.success("Registro editado con exito");
                $('#editar_tipoges').modal('hide'); //cierra el modal carga masiva
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoTipoGes(id_tipoges) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarTipoGes(id_tipoges); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarTipoGes(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=tipoges",
        success: function(r) {
            if (r == 1) {
                $("#carga_tipoges").load("web/mant_tipoges.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//---------------- Mantenedor casos ges -----------------------
function AgregarDatosCasosGes(datos_casos_ges) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_casos_ges,
        success: function(r) {
            if (r == 1) {
                $('#frm-nuevo-casos-ges')[0].reset(); //limpia el formulario
                $("#carga_casos_ges").load("web/mant_casos_ges.php");
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarCasosGes(id_casos_ges) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_casos_ges=" + id_casos_ges + "&seccion=casos-ges",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_casos_ges').val(datos['id_casos_ges']);
            $('#estable_casos_ges_up').val(datos['estable_casos_ges']);
            $('#tipo_casos_ges_up').val(datos['tipo_casos_ges']);
            $('#mes_casos_ges_up').val(datos['mes_casos_ges']);
            $('#anio_casos_ges_up').val(datos['anio_casos_ges']);
            $('#cantidad_casos_ges_up').val(datos['cantidad_casos_ges']);
        }
    });
}

function EditarCasosGes(editar_casos_ges) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: editar_casos_ges,
        success: function(r) {
            if (r == 1) {
                $('#frm-editar-casos-ges')[0].reset(); //limpia el formulario
                $("#carga_casos_ges").load("web/mant_casos_ges.php");
                alertify.success("Registro editado con exito");
                $('#editar_casos_ges').modal('hide'); //cierra el modal carga masiva
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoCasosGes(id_casos_ges) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarCasosGes(id_casos_ges); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarCasosGes(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=casos-ges",
        success: function(r) {
            if (r == 1) {
                $("#carga_casos_ges").load("web/mant_casos_ges.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}

function MasivoDatosCasosGes() {
    var masivo_casos_ges = new FormData($("#frm-carga-casos-ges")[0]);
    $.ajax({
        type: "POST",
        url: "static/transaccion/sube.php",
        data: masivo_casos_ges,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#form-masivo-casos-ges').hide();
            $('#spinner-casos-ges').show();
        },
        success: function(r) {
            alert(r);
            if (r == 1) {
                $("#arch_casos_ges").val(null); //limpia el formulario por id
                $("#carga_casos_ges").load("web/mant_casos_ges.php");
                alertify.success("Registros agregados y/o actualizados con exito");
                $('#form-masivo-casos-ges').show();
                $('#spinner-casos-ges').hide();
                $('#masivo_casos_ges').modal('hide'); //cierra el modal carga masiva
            } else if (r == 2) {
                $("#arch_casos_ges").val(null); //limpia el formulario por id
                $("#carga_casos_ges").load("web/mant_casos_ges.php");
                alertify.warning("No fue posible agregar y/o actualizar todos los registros");
                $('#form-masivo-casos-ges').show();
                $('#spinner-casos-ges').hide();
            } else {
                $('#form-masivo-casos-ges').show();
                $('#spinner-casos-ges').hide();
                alertify.error("No es posible incorporar los registros");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//-------------- Mantenedor red siges -----------------------
function AgregarDatosRedSiges(datos_red_siges) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_red_siges,
        success: function(r) {
            if (r == 1) {
                $('#frm-nuevo-red-siges')[0].reset(); //limpia el formulario
                $("#carga_red_siges").load("web/mant_red_sigges.php");
                alertify.success("Registro agregado con exito");
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarRedSiges(id_red_siges) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_red_siges=" + id_red_siges + "&seccion=red-siges",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_red_siges').val(datos['id_red_siges']);
            $('#estable_red_siges_up').val(datos['estable_red_siges']);
            $('#nombre_red_siges_up').val(datos['nombre_red_siges']);
            $('#apellido_red_siges_up').val(datos['apellido_red_siges']);
            $('#mail_red_siges_up').val(datos['mail_red_siges']);
            $('#rutaminsal_red_siges_up').val(datos['ruta_red_siges']);
            $('#telefono_red_siges_up').val(datos['telefono_red_siges']);
            $('#comuna_red_siges_up').val(datos['comuna_red_siges']);
        }
    });
}

function EditarRedSiges(editar_red_siges) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: editar_red_siges,
        success: function(r) {
            if (r == 1) {
                $('#frm-editar-red-siges')[0].reset(); //limpia el formulario
                $("#carga_red_siges").load("web/mant_red_sigges.php");
                alertify.success("Registro editado con exito");
                $('#editar_red_siges').modal('hide'); //cierra el modal carga masiva
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoRedSiges(id_red_siges) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarRedSiges(id_red_siges); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarRedSiges(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=red-siges",
        success: function(r) {
            if (r == 1) {
                $("#carga_red_siges").load("web/mant_red_sigges.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}

function MasivoDatosRedSiges() {
    var masivo_red_siges = new FormData($("#frm-carga-red-siges")[0]);
    $.ajax({
        type: "POST",
        url: "static/transaccion/sube.php",
        data: masivo_red_siges,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#form-masivo-red-siges').hide();
            $('#spinner-red-siges').show();
        },
        success: function(r) {
            if (r == 1) {
                $("#arch_red_siges").val(null); //limpia el formulario por id
                $("#carga_red_siges").load("web/mant_red_sigges.php");
                alertify.success("Registros agregados y/o actualizados con exito");
                $('#form-masivo-red-siges').show();
                $('#spinner-red-siges').hide();
                $('#masivo_red_siges').modal('hide'); //cierra el modal carga masiva
            } else if (r == 2) {
                $("#arch_red_siges").val(null); //limpia el formulario por id
                $("#carga_red_siges").load("web/mant_red_sigges.php");
                alertify.warning("No fue posible agregar y/o actualizar todos los registros");
                $('#form-masivo-red-siges').show();
                $('#spinner-red-siges').hide();
            } else {
                $('#form-masivo-red-siges').show();
                $('#spinner-red-siges').hide();
                alertify.error("No es posible incorporar los registros");
            }
        }
    });
}
//------------------------------------------------------------
//------------------------------------------------------------

//-------------- Mantenedor documentos ges ------------------------
function AgregarDocGec() {
    var archivo_doc_ges = new FormData($("#frm-carga-doc-ges")[0]);
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: archivo_doc_ges,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#form-masivo-doc-ges').hide();
            $('#spinner-doc-ges').show();
        },
        success: function(r) {
            if (r == 1) {
                $("#arch_doc_ges").val(null); //limpia el formulario por id
                $("#carga_doc_ges").load("web/mant_documentos_ges.php");
                alertify.success("Documento agregado con exito");
                $('#form-masivo-doc-ges').show();
                $('#spinner-doc-ges').hide();
            } else if (r == 2) {
                $("#arch_doc_ges").val(null); //limpia el formulario por id
                alertify.warning("Existe un documento con el mismo nombre");
                $('#form-masivo-doc-ges').show();
                $('#spinner-doc-ges').hide();
            } else {
                $('#form-masivo-doc-ges').show();
                $('#spinner-doc-ges').hide();
                alertify.error("No es posible incorporar el documento");
            }
        }
    });
}

function PreguntarSioNoDocGes(id_doc_ges) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarDocGes(id_doc_ges); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarDocGes(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=doc-ges",
        success: function(r) {
            if (r == 1) {
                $("#carga_doc_ges").load("web/mant_documentos_ges.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}

//------------------------------------------------------------
//------------------------------------------------------------

//----------------- Mantenedor slider ------------------------
function AgregarSlider() {
    var datos_slider = new FormData($("#frm-nuevo-slider")[0]);
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_slider,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#form-masivo-slider').hide();
            $('#spinner-slider').show();
        },
        success: function(r) {
            if (r == 1) {
                $("#arch_slider").val(null); //limpia el formulario por id
                $("#carga_slider").load("web/mant_slider.php");
                alertify.success("Datos agregado con exito");
                $('#form-masivo-slider').show();
                $('#spinner-slider').hide();
            } else if (r == 2) {
                $("#arch_slider").val(null); //limpia el formulario por id
                alertify.warning("Existe una imagen con el mismo nombre");
                $('#form-masivo-slider').show();
                $('#spinner-slider').hide();
            } else {
                $('#form-masivo-slider').show();
                $('#spinner-slider').hide();
                alertify.error("No es posible guardar los registros");
            }
        }
    });
}

function AgrFormEditarSlider(id_slider) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_slider=" + id_slider + "&seccion=slider",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_slider').val(datos['id_slider']);
            $('#titulo_slider_up').val(datos['titulo_slider']);
            $('#descripcion_slider_up').val(datos['descripcion_slider']);
        }
    });
}

function EditarSlider(editar_slider) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: editar_slider,
        success: function(r) {
            if (r == 1) {
                $('#frm-editar-slider')[0].reset(); //limpia el formulario
                $("#carga_slider").load("web/mant_slider.php");
                alertify.success("Registro editado con exito");
                $('#editar_slider').modal('hide'); //cierra el modal carga masiva
            } else {
                alertify.error("No es posible actualizar el registro");
            }
        }
    });
}


function PreguntarSioNoSlider(id_slider) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarSlider(id_slider); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarSlider(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=slider",
        success: function(r) {
            if (r == 1) {
                $("#carga_slider").load("web/mant_slider.php");
                alertify.success("Registro eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el registro");
            }
        }
    });
}

//------------------------------------------------------------
//------------------------------------------------------------

//--------------------------------------------------------------
//        carga mant_linea_base
//--------------------------------------------------------------
function mant_linea_base() {
    $("#carga_linea-base").load("web/mant_linea_base.php");
}
//--------------------------------------------------------------
//        carga mant_porcentaje_lb
//--------------------------------------------------------------
function mant_porcentaje_lb() {
    $('#carga_porcentaje_lb').load("web/mant_porcentaje_lb.php");
}
//--------------------------------------------------------------
//        carga mant_egreso_le
//--------------------------------------------------------------
function mant_egreso_le() {
    $('#carga_egreso_le').load('web/mant_egreso_le.php');
}
//------------------------------------------------------------
//------------------------------------------------------------

//--------------------------------------------------------------
//        carga tabs pagina no-ges
//--------------------------------------------------------------
function carga_no_ges() {

    $('#contenido-no-ges').load('web/cne.php');

    $('#cne').click(function() {
        $('#contenido-no-ges').empty();
        $('#contenido-no-ges').load('web/cne.php');
    });

    $('#cneo').click(function() {
        $('#contenido-no-ges').empty();
        $('#contenido-no-ges').load('web/cneo.php');
    });

    $('#proced').click(function() {
        $('#contenido-no-ges').empty();
        $('#contenido-no-ges').load('web/procedimiento.php');
    });

    $('#iq').click(function() {
        $('#contenido-no-ges').empty();
        $('#contenido-no-ges').load('web/iq.php');
    });

    $('a.nav-link').click(function() {
        $('a.nav-link').removeClass("active");
        $(this).addClass("active");
    });
}

//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------------------------------------------------------
//        carga pagina mant_tipoges_card
//--------------------------------------------------------------
function carga_casos_ges() {
    $("#carga_casos_ges").load("web/mant_casos_ges.php");

    $('#spinner-casos-ges').hide();

    $("#agregar-nuevo-casos-ges").click(function() {
        datos_casos_ges = $("#frm-nuevo-casos-ges").serialize();
        AgregarDatosCasosGes(datos_casos_ges);
    });

    $("#actualizar-casos-ges").click(function() {
        datos_casos_ges_up = $("#frm-editar-casos-ges").serialize();
        EditarCasosGes(datos_casos_ges_up);
    });

    $('#cargar-masivo-casos-ges').click(function() {
        MasivoDatosCasosGes();
    });
}
//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------------------------------------------------------
//        carga pagina mant_red_sigges
//--------------------------------------------------------------
function carga_red_siges() {
    $("#carga_red_siges").load("web/mant_red_sigges.php");

    $('#spinner-red-siges').hide();

    recargarLista_comunaRedSiges($('#estable_red_siges').val())
    $('#estable_red_siges').change(function() {
        recargarLista_comunaRedSiges($('#estable_red_siges').val())
    });

    recargarLista_comunaRedSigesUP($('#estable_red_siges_up').val())
    $('#estable_red_siges_up').change(function() {
        recargarLista_comunaRedSigesUP($('#estable_red_siges_up').val())
    });

    $("#agregar-nuevo-red-siges").click(function() {
        datos_red_siges = $("#frm-nuevo-red-siges").serialize();
        AgregarDatosRedSiges(datos_red_siges);
    });

    $("#actualizar-red-siges").click(function() {
        datos_red_siges_up = $("#frm-editar-red-siges").serialize();
        EditarRedSiges(datos_red_siges_up);
    });

    $('#cargar-masivo-red-siges').click(function() {
        MasivoDatosRedSiges();
    });
}

function recargarLista_comunaRedSiges(estable) {
    $.ajax({
        type: "POST",
        url: "web/select.php",
        data: "estable=" + estable + "&seleccion=comuna-rs",
        success: function(r) {
            $('#input-comuna').html(r);
        }
    });
}

function recargarLista_comunaRedSigesUP(estable) {
    $.ajax({
        type: "POST",
        url: "web/select.php",
        data: "estable=" + estable + "&seleccion=comuna-rs-up",
        success: function(r) {
            $('#input-comuna-up').html(r);
        }
    });
}
//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------------------------------------------------------
//        carga pagina mant_tipoges_card
//--------------------------------------------------------------
function carga_tipoges() {

    $("#carga_tipoges").load("web/mant_tipoges.php");

    $('#spinner-tipoges').hide();

    $("#agregar-nuevo-tipoges").click(function() {
        datos_tipoges = $("#frm-nuevo-tipoges").serialize();
        AgregarDatosTipoGes(datos_tipoges);
    });

    $("#actualizar-tipoges").click(function() {
        datos_tipoges_up = $("#frm-editar-tipoges").serialize();
        EditarTipoGes(datos_tipoges_up);
    });
    /*
    $('#cargar-masivo-tipoges').click(function () {
        MasivoDatosTipoGes();
    });
    */
}

//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------------------------------------------------------
//        carga pagina mant_slider_card
//--------------------------------------------------------------
function carga_slider() {

    $("#carga_slider").load("web/mant_slider.php");

    $('#spinner-slider').hide();

    $('#agregar-nuevo-slider').click(function() {
        AgregarSlider();
    });

    $('#actualizar-slider').click(function() {
        datos_slider_up = $("#frm-editar-slider").serialize();
        EditarSlider(datos_slider_up);
    });

}

//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------------------------------------------------------
//        carga pagina mant_documentos_ges_card
//--------------------------------------------------------------
function carga_docges() {

    $("#carga_doc_ges").load("web/mant_documentos_ges.php");

    $('#spinner-doc-ges').hide();

    $('#cargar-masivo-doc-ges').click(function() {
        AgregarDocGec();
    });
}

//--------------------------------------------------------------
//--------------------------------------------------------------


//--------------------------------------------------------------
//        carga tabs pagina conocenos
//--------------------------------------------------------------
function carga_quienes_somos() {

    $('#contenido-conocenos').load('web/organigrama.php');

    $('#organigrama').click(function() {
        $('#contenido-conocenos').empty();
        $('#contenido-conocenos').load('web/organigrama.php');
    });

    $('#mision-vision').click(function() {
        $('#contenido-conocenos').empty();
        $('#contenido-conocenos').load('web/mision_vision.php');
    });

    $('#somos').click(function() {
        $('#contenido-conocenos').empty();
        $('#contenido-conocenos').load('web/quienes_somos.php');
    });

    $('a.nav-link').click(function() {
        $('a.nav-link').removeClass("active");
        $(this).addClass("active");
    });
}

//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------------------------------------------------------
//        carga tabs pagina informe ges
//--------------------------------------------------------------
function carga_informes_ges() {

    $('#contenido-informe-ges').load('web/resumen_ges.php');

    $('#resumen').click(function() {
        $('#contenido-informe-ges').empty();
        $('#contenido-informe-ges').load('web/resumen_ges.php');
    });

    $('#monitores-ges').click(function() {
        $('#contenido-informe-ges').empty();
        $('#contenido-informe-ges').load('web/monitores_ges.php');
    });

    $('#documentos-ges').click(function() {
        $('#contenido-informe-ges').empty();
        $('#contenido-informe-ges').load('web/descarga_doc_ges.php');
    });

    $('a.nav-link').click(function() {
        $('a.nav-link').removeClass("active");
        $(this).addClass("active");
    });
}

//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------------------------------------------------------
//        funciones recargar lista meses
//--------------------------------------------------------------
function recargarLista_meses_rg(anio_res_ges) {
    $.ajax({
        type: "POST",
        url: "web/select.php",
        data: "anio=" + anio_res_ges + "&seleccion=meses-rg", //resumen_ges
        success: function(r) {
            $('#meses-grafico').html(r);
        }
    });
}

//--------------------------------------------------------------
//        funciones recargar graficos comparativo vencidas
//--------------------------------------------------------------
function etiquetaMes() {
    document.querySelector('#etiqueta-mv').innerText = $('#meses-vencidas').val();
    mes_resumenges = $('#meses-vencidas').val();
    anio_resumenges = $('#datal').val();
    $.ajax({
        type: "POST",
        url: "web/graficos_gesUno.php",
        data: "mes=" + mes_resumenges + "&anio=" + anio_resumenges,
        success: function(r) {
            $('#graficos-vencidas').html(r);
        }
    });
}

//--------------------------------------------------------------
//        funciones recargar graficos anuales ges
//--------------------------------------------------------------
function recargar_graficos_ges(anio_ges) {
    $.ajax({
        type: "POST",
        url: "web/grafico_gesDos.php",
        data: "anio=" + anio_ges,
        success: function(r) {
            $('#graficos_anuales_ges').html(r);
        }
    });
}

//--------------------------------------------------------------
//        funciones recargar lista SELECT
//--------------------------------------------------------------
function recargarLista_comuna() {
    $.ajax({
        type: "POST",
        url: "web/select.php",
        data: "seleccion=comuna",
        success: function(r) {
            $('#select-comuna').html(r);
        }
    });
}

//--------------------------------------------------------------
//        funciones tabs no-ges
//--------------------------------------------------------------
function cargar_grafico(mtz1, mtz2) {
    $.ajax({
        type: "POST",
        url: "web/grafico.php",
        data: { 'arreglo1': mtz1, 'arreglo2': mtz2 },
        success: function(r) {
            $('#grafico').html(r);
        }
    });
}
//--------------------------------------------------------------
//        funciones tabs no-ges
//--------------------------------------------------------------
function ConsultaCNE(datosCNE) {
    $.ajax({
        type: "POST",
        url: "web/cne_datos.php",
        data: datosCNE,
        success: function(r) {
            $('#carga-cne-datos').html(r);
        }
    });
}
//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------- llamado a las paginas desde el menu ----------
$(document).ready(function() {
    $("#contenido-index").empty();
    $("#contenido-index").load("web/slider.php");

    $('#menu-inicio').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/slider.php");
    });

    $('#menu-mant-provincia').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_provincia_card.php");
    });

    $('#menu-mant-comuna').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_comuna_card.php");
    });

    $('#menu-mant-tipo-estable').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_tipoestable_card.php");
    });

    $('#menu-mant-estable').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_estable_card.php");
    });

    $('#menu-mant-tipo-le').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_tipo_le_card.php");
    });

    $('#menu-rep-no-ges').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/no_ges.php");
    });

    $('#menu-rep-ges').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/ges.php");
    });

    $('#menu-mant-linea-base').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_linea_base_card.php");
    });

    $('#menu-mant-porcentaje-lb').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_porcentaje_lb_card.php");
    });

    $('#menu-mant-egreso-le').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_egreso_le_card.php");
    })

    $('#menu-conocenos').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/conocenos.php");
    })

    $('#menu-mant-tipoges').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_tipoges_card.php");
    })

    $('#menu-mant-casos-ges').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_casos_ges_card.php");
    })

    $('#menu-mant-red-siges').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_red_sigges_card.php");
    })

    $('#menu-mant-doc-ges').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_documentos_ges_card.php");
    })

    $('#menu-mant-slider').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_slider_card.php");
    })
});
//--------------------------------------------------------------
//--------------------------------------------------------------