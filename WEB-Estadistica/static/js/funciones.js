/* dropdown */
$(function () {
    $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function (event) {
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
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
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
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
        function () { EliminarProvincia(id_provincia); },
        function () {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarProvincia(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=provincia",
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
        function () { EliminarComuna(id_comuna); },
        function () {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarComuna(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=comuna",
        success: function (r) {
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
        success: function (r) {
            if (r == "valido") {
                $('#frm-carga-comuna')[0].reset(); //limpia el formulario
                $("#carga_comuna").load("web/mant_comuna.php");
                alertify.success("Registros agregados con exito");
            } else {
                $('#frm-carga-comuna')[0].reset();
                alertify.error("No es posible guardar los registros");
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
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
        function () { EliminarTipoEstable(id_tipo_estable); },
        function () {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarTipoEstable(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=tipo_estable",
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
        function () { EliminarEstable(id_estable); },
        function () {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarEstable(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=establecimiento",
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
        function () { EliminarTipoLe(id_tipo_le); },
        function () {
            alertify.error('Se ha cancelado la eliminación');
        }).set('labels', { ok: 'Si', cancel: 'No' });
}

function EliminarTipoLe(id) {
    $.ajax({
        type: "POST",
        url: "static/transaccion/eliminar.php",
        data: "id=" + id + "&seccion=tipo-le",
        success: function (r) {
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
        success: function (r) {
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



//--------------- llamado a las paginas desde el menu ----------
$(document).ready(function () {
    $('#menu-mant-provincia').click(function () {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_provincia_card.php");
    });

    $('#menu-mant-comuna').click(function () {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_comuna_card.php");
    });

    $('#menu-mant-tipo-estable').click(function () {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_tipoestable_card.php");
    });

    $('#menu-mant-estable').click(function () {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_estable_card.php");
    });

    $('#menu-mant-tipo-le').click(function () {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/mant_tipo_le_card.php");
    });

    $('#menu-rep-no-ges').click(function () {
        $("#contenido-index").empty();
        $("#contenido-index").load("web/no_ges.php");
    });
    
});
//--------------------------------------------------------------
//--------------------------------------------------------------
