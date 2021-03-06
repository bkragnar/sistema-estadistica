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
                filtros_le();
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
                filtros_le();
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
                filtros_le();
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
            if (r == 1) {
                $("#arch_egreso_le").val(null); //limpia el formulario por id
                filtros_le();
                alertify.success("Registros agregados y/o actualizados con exito");
                $('#form-masivo-egreso-le').show();
                $('#spinner-egreso-le').hide();
                $('#masivo_egreso_le').modal('hide'); //cierra el modal carga masiva
            } else if (r == 2) {
                $("#arch_egreso_le").val(null); //limpia el formulario por id
                filtros_le();
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

//-------------- Mantenedor usuario -----------------------
function AgregarDatosUsuario(datos_usuario) {
    datos_usuario.push({ name: 'var_mail', value: 'nuevo' });
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: datos_usuario,
        success: function(r) {
            if (r == 1) {
                alertify.success("Registro agregado con exito");
                //enviar el email
                $.post('static/transaccion/email.php', datos_usuario,
                    function(res) {
                        if (res == 1) {
                            alertify.success("El Email fue enviado al Usuario");
                            $('#frm-nuevo-usuario')[0].reset(); //limpia el formulario
                            $("#carga_usuario").load("web/mant_usuarios.php");
                        } else {
                            alertify.error("El Email no fue enviado");
                            $('#frm-nuevo-usuario')[0].reset(); //limpia el formulario
                            $("#carga_usuario").load("web/mant_usuarios.php");
                        }
                    });
            } else {
                alertify.error("No es posible guardar el registro");
            }
        }
    });
}

function AgrFormEditarUsuario(id_usuario) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/fun_json.php",
        data: "id_usuario=" + id_usuario + "&seccion=usuario",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#id_usuario').val(datos['id_usuario']);
            $('#nombre_usuario_up').val(datos['nombre_usuario']);
            $('#apellido_usuario_up').val(datos['apellido_usuario']);
            $('#email_usuario_up').val(datos['correo_usuario']);
            $('#usu_usuario_up').val(datos['usu_usuario']);
            $('#privilegio_usuario_up').val(datos['privilegio_usuario']);
            $('#estable_usuario_up').val(datos['estable_usuario']);
            var mitoggle = document.getElementsByClassName("toggle")[1];
            if (datos['estado_usuario'] == 1) {
                if (mitoggle.className != "toggle btn btn-success") {
                    mitoggle.className = "toggle btn btn-success";
                }
            } else {
                if (mitoggle.className == "toggle btn btn-success") {
                    mitoggle.className = "toggle btn btn-danger off";
                }
            }
        }
    });
}

function EditarUsuario(editar_usuario) {
    editar_usuario.push({ name: 'var_mail', value: 'edicion' });
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: editar_usuario,
        success: function(r) {
            if (r == 1) {
                alertify.success("Registro editado con exito");
                $('#editar_usuario').modal('hide'); //cierra el modal carga masiva
                //enviar el email
                $.post('static/transaccion/email.php', editar_usuario,
                    function(res) {
                        if (res == 1) {
                            alertify.success("El Email fue enviado al Usuario");
                            $('#frm-editar-usuario')[0].reset(); //limpia el formulario
                            $("#carga_usuario").load("web/mant_usuarios.php");
                        } else {
                            alertify.error("El Email no fue enviado");
                            $('#frm-editar-usuario')[0].reset(); //limpia el formulario
                            $("#carga_usuario").load("web/mant_usuarios.php");
                        }
                    });
            } else {
                alertify.error("No es posible editar el registro");
            }
        }
    });
}

function PreguntarSioNoUsuario(id_usuario) {
    alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar este registro?',
        function() { EliminarUsuario(id_usuario); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarUsuario(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=usuario",
        success: function(r) {
            if (r == 1) {
                $("#carga_usuario").load("web/mant_usuarios.php");
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
function filtros_lb() {
    var valor_anio = $('#anio_lb_filtro').val();
    var valor_tipo = $('#tipo_lb_filtro').val();
    $.post('web/mant_linea_base.php', { 'anio_filtro': valor_anio, 'tipole_filtro': valor_tipo },
        function(res) {
            $('#carga_linea-base').html(res);
        });
}

function mant_linea_base() {
    //$("#carga_linea-base").load("web/mant_linea_base.php");
    filtros_lb();
    $('#anio_lb_filtro').on("change", function() {
        filtros_lb();
    });
    $('#tipo_lb_filtro').on("change", function() {
        filtros_lb();
    });

    $('#spinner-lb').hide();

    $('#agregar-linea-base').click(function() {
        datos_linea_base = $('#frm-nuevo-lines-base').serialize();
        AgregarDatosLineaBase(datos_linea_base);
    });

    $('#editar-linea-base').click(function() {
        editar_linea_base = $('#frm-editar-lines-base').serialize();
        EditarLineaBase(editar_linea_base);
    });

    $('#cargar-masivo-linea-base').click(function() {
        MasivoDatosLineaBase();
    });
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
function filtros_le() {
    var valor_anio = $('#anio_le_filtro').val();
    var valor_tipo = $('#tipo_le_filtro').val();
    $.post('web/mant_egreso_le.php', { 'anio_filtro': valor_anio, 'tipole_filtro': valor_tipo },
        function(res) {
            $('#carga_egreso_le').html(res);
        });
}

function mant_egreso_le() {
    filtros_le();

    $('#anio_le_filtro').on("change", function() {
        filtros_le();
    });
    $('#tipo_le_filtro').on("change", function() {
        filtros_le();
    });

    $('#spinner-egreso-le').hide();

    $('#agregar-egreso-le').click(function() {
        datos_egreso_le = $('#frm-nuevo-egreso-le').serialize();
        AgregarDatosEgresoLE(datos_egreso_le);
    });

    $('#editar-egreso-le').click(function() {
        editar_egreso_le = $('#frm-editar-egreso-le').serialize();
        EditarEgresoLE(editar_egreso_le);
    });

    $('#cargar-masivo-egreso-le').click(function() {
        MasivoDatosEgresoLE();
    });

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
function filtros_ges() {
    var valor_anio = $('#anio_ges_filtro').val();
    var valor_tipo = $('#tipo_ges_filtro').val();
    $.post('web/mant_casos_ges.php', { 'anio_filtro': valor_anio, 'tipoges_filtro': valor_tipo },
        function(res) {
            $('#carga_casos_ges').html(res);
        });
}

function carga_casos_ges() {
    filtros_ges();

    $('#anio_ges_filtro').on("change", function() {
        filtros_ges();
    });
    $('#tipo_ges_filtro').on("change", function() {
        filtros_ges();
    });

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
//        carga mantenedor usuario
//--------------------------------------------------------------
function cargar_usuario() {
    $("#carga_usuario").load("web/mant_usuarios.php");

    $('#agregar-nuevo-usuario').click(function() {
        nuevo_usuario = $('#frm-nuevo-usuario').serializeArray();
        AgregarDatosUsuario(nuevo_usuario);
    });

    $('#editar-usuario').click(function() {
        editar_usuario = $('#frm-editar-usuario').serializeArray();
        EditarUsuario(editar_usuario);
    });

    $('#email_usuario').keyup(function() {
        var email = $(this).val();
        var dividir = email.split('@');
        $('#usu_usuario').val(dividir[0]);
    });
    $('#email_usuario_up').keyup(function() {
        var email = $(this).val();
        var dividir = email.split('@');
        $('#usu_usuario_up').val(dividir[0]);
    });

}

function generar(modal) {
    var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
    var contraseña = "";
    for (i = 0; i < 6; i++) {
        contraseña += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
    }
    if (modal == "nuevo") {
        $('#pass_usuario').val(contraseña);
    } else {
        $('#pass_usuario_up').val(contraseña);
    }
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
function recargarLista_comuna(dato) {
    if (dato == 1) {
        $.ajax({
            type: "POST",
            url: "web/select.php",
            data: "seleccion=comuna",
            success: function(r) {
                $('#select-comuna').html(r);
            }
        });
    } else if (dato == 2) {
        $.ajax({
            type: "POST",
            url: "web/select.php",
            data: "seleccion=comuna",
            success: function(r) {
                $('#select-comuna-cno').html(r);
            }
        });
    } else if (dato == 4) {
        $.ajax({
            type: "POST",
            url: "web/select.php",
            data: "seleccion=comuna",
            success: function(r) {
                $('#select-comuna-iq').html(r);
            }
        });
    }
}

//--------------------------------------------------------------
//        graficos no-ges
//--------------------------------------------------------------
function cargar_grafico(mtz1, mtz2, prestacion) {
    if (prestacion == 1) {
        $.ajax({
            type: "POST",
            url: "web/grafico.php",
            data: { 'arreglo1': mtz1, 'arreglo2': mtz2 },
            success: function(r) {
                $('#grafico').html(r);
            }
        });
    } else if (prestacion == 2) {
        $.ajax({
            type: "POST",
            url: "web/grafico.php",
            data: { 'arreglo1': mtz1, 'arreglo2': mtz2 },
            success: function(r) {
                $('#grafico-cno').html(r);
            }
        });
    } else if (prestacion == 4) {
        $.ajax({
            type: "POST",
            url: "web/grafico.php",
            data: { 'arreglo1': mtz1, 'arreglo2': mtz2 },
            success: function(r) {
                $('#grafico-iq').html(r);
            }
        });
    }
}
//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------------------------------------------------------
//      mantenedor directorio noges
//--------------------------------------------------------------
function agregar_dir_noges(directorio) {
    ruta = document.getElementById('referencia_ruta').textContent;
    directorio.push({ name: 'referencia_ruta_noges', value: ruta });
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: directorio,
        success: function(r) {
            if (r == 1) {
                $('#frm-nuevo-directorio_noges')[0].reset();
                mostrar_directorio();
                //$('#agregar_directorio_noges').hide();
                //$("#menu-directorio-noges").trigger("click");
                alertify.success("Carpeta creada con exito");
            } else {
                alertify.error("No fue posible crear la carpeta o ya existe");
            }
        }
    });
}

function editar_dir_noges(directorio) {
    ruta = document.getElementById('editar_referencia_ruta').textContent;
    directorio.push({ name: 'editar_referencia_ruta_noges', value: ruta });
    $.ajax({
        type: "POST",
        url: "static/transaccion/editar.php",
        data: directorio,
        success: function(r) {
            if (r == 1) {
                $('#frm-editar-directorio_noges')[0].reset();
                mostrar_directorio();
                alertify.success("Nombre cambiado con exito");
            } else {
                alertify.error("No fue posible cambiar el nombre de la carpeta o ya existe");
            }
        }
    });
}

function PreguntarSioNoDirNoges() {
    alertify.confirm('<i class="fas fa-exclamation-triangle fa-lg text-warning"></i><span class="ml-2">Eliminar Directorio</span>', '¿Está seguro de eliminar este directorio? <br><br> Si confima la eliminación, se borrarán <b><u>todos los archivos</u></b> contenidos en el directorio seleccionado',
        function() { EliminarDirNoges(); },
        function() {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarDirNoges() {
    var eliminar_ruta = document.getElementById('eliminar_referencia_ruta').textContent;
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "ruta=" + eliminar_ruta + "&seccion=directorio_noges",
        success: function(r) {
            if (r == 1) {
                $('#frm-eliminar-directorio_noges')[0].reset();
                mostrar_directorio();
                alertify.success("Directorio eliminado con exito");
            } else {
                alertify.error("No es posible eliminar el directorio");
            }
        }
    });
}
/*
function AgregarArchivoNoges() {
    var archivo_noges = new FormData($("#frm-nuevo-archivo-noges")[0]);
    var ruta = document.getElementById('referencia_ruta_archivo').textContent;
    archivo_noges.append('referencia_ruta_archivo', ruta);
    $.ajax({
        type: "POST",
        url: "static/transaccion/agregar.php",
        data: archivo_noges,
        cache: false,
        contentType: false,
        processData: false,
                beforeSend: function() {
                    $('#frm-nuevo-archivo-noges').hide();
                    $('#info-carga-archivo-noges').show();
                },
        success: function(r) {
            alert(r);
            if (r == 1) {
                $('#frm-nuevo-archivo-noges')[0].reset();
                mostrar_directorio();
                alertify.success("Archivo cargado con exito");
                document.getElementById('referencia_ruta_archivo').textContent = "";
                carga_archivo_directorio_noges("");
                guardaRutaArchivo("");
                $('#info-carga-archivo-noges').hide();
                $('#frm-nuevo-archivo-noges').show();
            } else if (r == 2) {
                $('#frm-nuevo-archivo-noges')[0].reset();
                mostrar_directorio();
                alertify.warning("El archivo ya existe en este directorio");
            } else if (r == 3) {
                alertify.warning("Debe seleccionar un archivo");
            } else {
                alertify.error("No fue posible cargar el archivo");
            }
        }
    });
}
*/

function EliminarArchivoNoges(elim_archivo) {
    var eliminar_ruta = document.getElementById('elimina_referencia_ruta_archivo').textContent;
    elim_archivo.push({ name: 'ruta_archivo_noges', value: eliminar_ruta });
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: elim_archivo,
        success: function(r) {
            if (r == 1) {
                $('#frm-eliminar-archivo-noges')[0].reset();
                mostrar_directorio();
                alertify.success("Archivo eliminado con exito");
                document.getElementById('elimina_referencia_ruta_archivo').textContent = "";
                carga_eliminar_archivo_directorio_noges("");
                EliminarguardaRutaArchivo("");
            } else {
                alertify.error("No es posible eliminar el Archivo");
            }
        }
    });
}
//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------------------------------------------------------
//       directorio noges
//--------------------------------------------------------------
function directorio_noges() {
    $('[data-toggle="tooltip"]').tooltip(); //para que funcione los tooltip mensajes flotantes
    $('#info-carga-archivo-noges').hide();
    mostrar_directorio();

    ruta = "";
    carga_directorio_noges(ruta);
    carga_eliminar_directorio_noges(ruta);
    carga_editar_directorio_noges(ruta);

    carga_archivo_directorio_noges(ruta);
    carga_eliminar_archivo_directorio_noges(ruta);

    $('#agregar-nuevo-directorio-noges').click(function() {
        dir_noges = $('#frm-nuevo-directorio_noges').serializeArray();
        agregar_dir_noges(dir_noges);
    });
    $('#editar-nuevo-directorio-noges').click(function() {
        dir_noges = $('#frm-editar-directorio_noges').serializeArray();
        editar_dir_noges(dir_noges);
    });
    $('#eliminar-directorio-noges').click(function() {
        PreguntarSioNoDirNoges();
    });
    /* aca comienza lo referente al archivo */
    $('#agregar-archivo-noges').click(function() {
        //AgregarArchivoNoges();
        //uploadFile();
    });

    $('#eliminar-archivo-directorio-noges').click(function() {
        del_archivo = $('#frm-eliminar-archivo-noges').serializeArray();
        EliminarArchivoNoges(del_archivo);
    });

    $('#directorio_no_ges').on("change", function() {
        mostrar_directorio();
    });

    //vuelve el directorio en 1 nivel (select agregar carpeta nuevo)
    $('#volver_ruta_noges').click(function() {
        girar_volver("volver_ruta_noges");
        ruta = $('#referencia_ruta').text();
        final = ruta.lastIndexOf("/");
        if (ruta != "") {
            nueva_ruta = ruta.substr(0, final);
            document.getElementById('referencia_ruta').textContent = nueva_ruta;
            carga_directorio_noges(nueva_ruta);
        }
    });

    //vuelve el directorio en 1 nivel (select editar carpeta)
    $('#editar_volver_ruta_noges').click(function() {
        girar_volver("editar_volver_ruta_noges");
        ruta = $('#editar_referencia_ruta').text();
        final = ruta.lastIndexOf("/");
        if (ruta != "") {
            nueva_ruta = ruta.substr(0, final);
            document.getElementById('editar_referencia_ruta').textContent = nueva_ruta;
            carga_editar_directorio_noges(nueva_ruta);
        }
    });

    //vuelve el directorio en 1 nivel (select eliminar carpeta)
    $('#eliminar_volver_ruta_noges').click(function() {
        girar_volver("eliminar_volver_ruta_noges");
        ruta = $('#eliminar_referencia_ruta').text();
        final = ruta.lastIndexOf("/");
        if (ruta != "") {
            nueva_ruta = ruta.substr(0, final);
            document.getElementById('eliminar_referencia_ruta').textContent = nueva_ruta;
            carga_eliminar_directorio_noges(nueva_ruta);
        }
    });

    //vuelve el directorio en 1 nivel (select agregar archivo)
    $('#volver_ruta_noges_archivo').click(function() {
        girar_volver("volver_ruta_noges_archivo");
        ruta = $('#referencia_ruta_archivo').text();
        final = ruta.lastIndexOf("/");
        if (ruta != "") {
            nueva_ruta = ruta.substr(0, final);
            document.getElementById('referencia_ruta_archivo').textContent = nueva_ruta;
            $('#ref_ruta_arch').val(nueva_ruta); //ruta del input hide del cargar archivo
            carga_archivo_directorio_noges(nueva_ruta);
        }
    });

    //vuelve el directorio en 1 nivel (select eliminar archivo)
    $('#volver_elimina_referencia_ruta_noges').click(function() {
        girar_volver("volver_elimina_referencia_ruta_noges");
        ruta = $('#elimina_referencia_ruta_archivo').text();
        final = ruta.lastIndexOf("/");
        if (ruta != "") {
            nueva_ruta = ruta.substr(0, final);
            document.getElementById('elimina_referencia_ruta_archivo').textContent = nueva_ruta;
            carga_eliminar_archivo_directorio_noges(nueva_ruta);
            carga_archivos_eliminar_noges(nueva_ruta);
        }
    });
}

//muestra el directorio
function mostrar_directorio() {
    var carpeta_dir = "/" + $('#directorio_no_ges').val();
    $.post('web/mant_directorio_noges.php', { 'carpeta_dir': carpeta_dir },
        function(res) {
            $('#carga_directorio_noges').html(res);
        });
}
//hace girar en 360º la flecha de volver
function girar_volver(id) {
    var gv = $('#' + id);
    $({ rotation: 0 }).animate({ rotation: -360 }, {
        duration: 400,
        easing: 'linear',
        step: function() {
            gv.css({
                transform: 'rotate(' + this.rotation + 'deg)'
            });
            //console.log(this.rotation);
        }
    });
}

//recarga el select del directorio "el agregar carpeta"
function guardaRuta(valor) {
    if (valor != "") {
        document.getElementById('referencia_ruta').textContent += "/" + valor;
    }
    carga_directorio_noges($('#referencia_ruta').text());
}
//recarga el select del eliminar directorio "el agregar carpeta"
function editar_guardaRuta(valor) {
    if (valor != "") {
        document.getElementById('editar_referencia_ruta').textContent += "/" + valor;
    }
    carga_editar_directorio_noges($('#editar_referencia_ruta').text());
}
//recarga el select del eliminar directorio "el agregar carpeta"
function eliminar_guardaRuta(valor) {
    if (valor != "") {
        document.getElementById('eliminar_referencia_ruta').textContent += "/" + valor;
    }
    carga_eliminar_directorio_noges($('#eliminar_referencia_ruta').text());
}

//recarga el select del directorio "el agregar archivo"
function guardaRutaArchivo(valor) {
    if (valor != "") {
        document.getElementById('referencia_ruta_archivo').textContent += "/" + valor;
        $('#ref_ruta_arch').val(document.getElementById('referencia_ruta_archivo').textContent); //ruta del input hide del cargar archivo
    }
    carga_archivo_directorio_noges($('#referencia_ruta_archivo').text());
}
//recarga el select con el directorio para eliminar archivo
function EliminarguardaRutaArchivo(valor) {
    if (valor != "") {
        document.getElementById('elimina_referencia_ruta_archivo').textContent += "/" + valor;
    }
    carga_eliminar_archivo_directorio_noges($('#elimina_referencia_ruta_archivo').text());
    carga_archivos_eliminar_noges($('#elimina_referencia_ruta_archivo').text());
}

//carga el select del directorio para agregar nueva carpeta
function carga_directorio_noges(ruta) {
    dir = "../static/directorio_noges" + ruta;
    $.ajax({
        type: "POST",
        url: "web/select.php",
        data: "ruta=" + dir + "&seleccion=directorio_noges",
        success: function(r) {
            $('#select-directorio-noges').html(r);
        }
    });
}
//carga el select del directorio para editar carpeta
function carga_editar_directorio_noges(ruta) {
    dir = "../static/directorio_noges" + ruta;
    $.ajax({
        type: "POST",
        url: "web/select.php",
        data: "ruta=" + dir + "&seleccion=editar_directorio_noges",
        success: function(r) {
            $('#select-editar-directorio-noges').html(r);
        }
    });
}
//carga el select del directorio para eliminar carpeta
function carga_eliminar_directorio_noges(ruta) {
    dir = "../static/directorio_noges" + ruta;
    $.ajax({
        type: "POST",
        url: "web/select.php",
        data: "ruta=" + dir + "&seleccion=eliminar_directorio_noges",
        success: function(r) {
            $('#select-eliminar-directorio-noges').html(r);
        }
    });
}

//carga el select del directorio para cargar archivo
function carga_archivo_directorio_noges(ruta) {
    dir = "../static/directorio_noges" + ruta;
    $.ajax({
        type: "POST",
        url: "web/select.php",
        data: "ruta=" + dir + "&seleccion=archivo-directorio_noges",
        success: function(r) {
            $('#select-archivo-directorio-noges').html(r);
        }
    });
}
//carga el select del directorio para eliminar archivo
function carga_eliminar_archivo_directorio_noges(ruta) {
    dir = "../static/directorio_noges" + ruta;
    $.ajax({
        type: "POST",
        url: "web/select.php",
        data: "ruta=" + dir + "&seleccion=eliminar-archivo-directorio-noges",
        success: function(r) {
            $('#select-elimina-ruta-dir').html(r);
        }
    });
}
//carga el select con archivos para eliminar
function carga_archivos_eliminar_noges(ruta) {
    dir = "../static/directorio_noges" + ruta;
    $.ajax({
        type: "POST",
        url: "web/select.php",
        data: "ruta=" + dir + "&seleccion=eliminar-archivo-noges",
        success: function(r) {
            $('#select-elimina-archivo').html(r);
        }
    });
}
//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------------------------------------------------------
//        carga cne_datos
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

//--------------------------------------------------------------
//        carga iq_datos
//--------------------------------------------------------------
function ConsultaIQ(datosIQ) {
    $.ajax({
        type: "POST",
        url: "web/iq_datos.php",
        data: datosIQ,
        success: function(r) {
            $('#carga-iq-datos').html(r);
        }
    });
}
//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------- funcion revela y oculta ----------------------
function revela() {
    document.getElementById('pasw').style.color = 'dodgerblue';
    $('#eye-pass').removeClass('fas fa-eye-slash fa-sm');
    $('#eye-pass').addClass('fas fa-eye fa-sm primary');
    document.getElementById("clave-user").type = "text";
}

function oculta() {
    $('#eye-pass').removeClass('fas fa-eye fa-sm');
    $('#eye-pass').addClass('fas fa-eye-slash fa-sm');
    document.getElementById('pasw').style.color = 'black';
    document.getElementById("clave-user").type = "password";
}

//--------------------------------------------------------------
//--------------------------------------------------------------

//--------------- funcion valida datos logeo ----------------------
$(function() {
    //ejecutamos la funcion al hacer unsubmite
    $("#form_login").on("submit", function(e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_login"));
        formData.append("dato", "valor");
        d = new Date();

        //enviamos los parametros
        $.ajax({
            url: "static/transaccion/validacion_login.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            beforeSend: function() {
                //en el caso de que este show, lo ocultamos
                jQuery("#mensaje_validacion_login_refresh").hide("slow");
                //ocultamos inputs
                jQuery("#form_check").hide("slow");
                //ocultamos submit
                jQuery("#btn_submit").html("<img src='static/img_fija/loader.gif' width='20px'>");
                //$("#img_captcha").hide("slow");
                jQuery("#post_captcha").val("");
            },
            success: function(response) {
                //reseteamos el captcha
                $("#img_captcha").attr("src", "static/transaccion/captcha.php");
                jQuery("#form_check").show("slow");
                //ocultamos el mensaje de precarga
                jQuery("#mensaje_validacion_login").hide("slow");
                //mostramos submit
                jQuery("#btn_submit").html("Iniciar sesión");
                //return php
                jQuery("#mensaje_validacion_login_refresh").show("slow");
                jQuery("#mensaje_validacion_login_refresh").html(response);
            }
        })
    });
});
//--------------------------------------------------------------
//--------------------------------------------------------------
function cambio_clave() {
    document.getElementById('menu_mi_perfil').click();
}
//--------------- llamado a las paginas desde el menu ----------
$(document).ready(function() {
    $('#btn_submit').html("Iniciar Sesion");
    $('[data-toggle="tooltip"]').tooltip();
    //--------------- captcha ----------
    jQuery("#captcha").show();
    jQuery("#captcha").html("<img id='img_captcha' style='width:150px;'>");
    jQuery("#img_captcha").attr("src", "static/transaccion/captcha.php");
    //--------------------------------------------------------------
    //--------------------------------------------------------------
    //   cambia el color de etiqueta i del icono del login mientras el input este en focus
    $(':input').focusin(function() {
        var wrapper = $(this).parent().find('span');
        $('span').css({ 'color': 'none' });
        wrapper.css({ 'color': 'dodgerblue' });
    });
    $(':input').blur(function() {
        var wrapper = $(this).parent().find('span');
        $('span').css({ 'color': 'none' });
        wrapper.css({ 'color': '#2B2A2A' });
    });
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------

    //-------------------------fijar el menu en la parte superior-------------------------
    var menu = document.getElementById('menu_principal');
    var altura = menu.offsetTop; //determina la altura desde top al menu
    window.addEventListener('scroll', function() {
        "use strict";
        if (window.pageYOffset > altura) {
            menu.classList.add('menu_fijo');
        } else {
            menu.classList.remove('menu_fijo');
        }
    });
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------

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

    $('#menu-mant-usuarios').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_usuarios_card.php");
    })

    $('#menu_mi_perfil').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/perfil_usuario.php");
    })

    $('#menu-directorio-noges').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_directorio_noges_card.php");
    })

    $('#menu-directorio-archivo-noges').click(function() {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/directorio_noges_filtro.php");
    })

    $('#cerrar-sesion').click(function() {
        location.href = 'static/transaccion/exit.php';
    })
});
//--------------------------------------------------------------
//--------------------------------------------------------------