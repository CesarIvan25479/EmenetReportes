const mostrarPendientes = (clave) => {
    $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave=" + clave);
}
const mostrarRealizadas = (clave) => {
    $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave=" + clave);
}
const mostrarCanceladas = (clave) => {
    $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave=" + clave);
}
const buscarLocalidad = () => {
    let codigo = document.getElementById("cPostal").value;
    if (codigo.length == 5) {
        $.ajax({
            type: 'POST',
            url: '../controller/localidades.php',
            dataType: 'json',
            data: "codigo=" + codigo,
            success: (data) => {
                if (data.estado == "error") {
                    console.error("No se pudieron obtener los datos del API CP")
                } else {
                    console.log(data)
                }
            }
        })
    }
}
const buscarDatosIns = (cliente) => {
    $('#ainputTelf2').css('display', 'none');
    $("#AcambiarIcono").html(`<i class="fas fa-plus"></i>`);
    $('#atelefono2').val("");
    $.ajax({
        type: "POST",
        url: "../controller/instalaciones/datosCliente.php",
        dataType: "json",
        data: "cliente=" + cliente,
        success: (data) => {
            if (data.estado == "error") {
                console.log(data);
            } else {
                console.log(data);
                $("#acliente").val(data.info.nombreCliente.toUpperCase());
                if (data.info.telefono.length == 20) {
                    $('#ainputTelf2').css('display', 'flex');
                    $("#AcambiarIcono").html(`<i class="fas fa-minus"></i>`);
                    $("#atelefono2").val(data.info.telefono.substr(10,20));
                }
                $("#atelefono").val(data.info.telefono.substr(0, 10));
                $("#apoblacion").val(data.info.idPob);
                $("#acoordenadas").val(data.info.coordenadas);
                $("#adireccion").val(data.info.direccion.toUpperCase());
                $("#acaracteristicas").val(data.info.caracteristicasDomicilio.toUpperCase());
                $("#areferencias").val(data.info.referencias.toUpperCase());
                $("#aclasificacion").val(data.info.descripcion);
                $("#adisponibilidad").val(data.info.disponibilidad.toUpperCase());
                $("#aobservaciones").val(data.info.observaciones.toUpperCase());
                $("#tituloModalAct").text(data.info.nombreCliente.toUpperCase());
                $("#recibioNom").text(data.recibio.nombre);
                $("#recibioFecha").text(data.recibio.fecha);
                $("#recibioHora").text(data.recibio.hora);

                data.actualizo.nombre == " " ? 
                $("#infoActualizo").css('display','none'): 
                $("#infoActualizo").css('display','flex');
                $("#actualizoFecha").text(data.actualizo.fecha);
                $("#actualizoNom").text(data.actualizo.nombre);
                $("#actualizoHora").text(data.actualizo.hora);

                data.atendio.nombre == " " ?
                $("#infoAtendio").css('display', 'none'):
                $("#infoAtendio").css('display', 'flex');
                $("#atendioNom").text(data.atendio.nombre);
                $("#atendioFecha").text(data.atendio.fecha);
                $("#atendioHora").text(data.atendio.hora);
            }
        }
    })
}
$(document).ready(() => {
    let estadoTel = false;
    $("#agregaTel").on("click", () => {
        if (estadoTel) {
            $('#inputTelf2').css('display', 'none');
            $("#cambiarIcono").html(`<i class="fas fa-plus"></i>`);
            $('#telefono2').val("");
            estadoTel = false;
        } else {
            $('#inputTelf2').css('display', 'flex');
            $("#cambiarIcono").html(`<i class="fas fa-minus"></i>`);
            estadoTel = true;
        }
    })
    $("#AagregaTel").on("click", () => {
        if (estadoTel) {
            $('#ainputTelf2').css('display', 'none');
            $("#AcambiarIcono").html(`<i class="fas fa-plus"></i>`);
            $('#Atelefono2').val("");
            estadoTel = false;
        } else {
            $('#ainputTelf2').css('display', 'flex');
            $("#AcambiarIcono").html(`<i class="fas fa-minus"></i>`);
            estadoTel = true;
        }
    })
    $('#telefono').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#telefono2').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#cPostal").on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    })
})