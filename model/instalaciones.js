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
                $("#acliente").val(data.info.nombre.toUpperCase());
                if (data.info.telefono.length == 20) {
                    $('#ainputTelf2').css('display', 'flex');
                    $("#AcambiarIcono").html(`<i class="fas fa-minus"></i>`);
                    $("#atelefono2").val(data.info.telefono.substr(10,20));
                }
                $("#atelefono").val(data.info.telefono.substr(0, 10));
                $("#apoblacion").val(data.info.poblacion);
                $("#acoordenadas").val(data.info.ubicacion);
                $("#adireccion").val(data.info.nomCalle.toUpperCase());
                $("#acaracteristicas").val(data.info.detalleCasa.toUpperCase());
                $("#areferencias").val(data.info.refDomicilio.toUpperCase());
                $("#adisponibilidad").val(data.info.horarioDis.toUpperCase());
                $("#aclasificacion").val(data.info.tipoServicio);
                $("#aobservaciones").val(data.info.observaciones.toUpperCase());
                $("#tituloModalAct").text(data.info.nombre.toUpperCase());
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

                if(data.instalando.nombre == " "){
                    $("#estadoAtendiendo").css("background-color", "");
                    $("#datosAtendiendo").css('display', 'none')
                }else{
                    $("#estadoAtendiendo").css("background-color", "#ffe3d3");
                    $("#datosAtendiendo").css('display', 'block');
                    $("#atenNombre").text(data.instalando.nombre);
                    $("#atenFecha").text(data.instalando.fecha);
                }
                
            }
        }
    })
}
