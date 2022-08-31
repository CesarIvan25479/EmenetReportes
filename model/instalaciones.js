let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 7000
});

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
                $("#folio").val(data.info.clave);
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
                $("#estado").val(data.info.estado);

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

const validarCampos = () => {
    $("#cliente").val() == "" ? $("#cliente").prop('required', true) : $("#cliente").prop('required', false);
    $("#telefono").val() == "" ? $("#telefono").prop('required', true) : $("#telefono").prop("required", false);
    $("#direccion").val() == "" ? $("#direccion").prop("required", true) : $("#direccion").prop("required", false);
    $("#clasificacion").val() == "" ? $("#clasificacion").prop("required", true) : $("#clasificacion").prop("required", false);
}

const agregarInstalacion = () => {
    const formulario = document.getElementById("formAgregarIns");
    const datos = new FormData(formulario);
    fetch('../controller/instalaciones/agregarInstalacion.php',{
        method: "POST",
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if(data.estado == "llenar"){
            validarCampos();
        }else if(data.estado == "conexion"){
            Toast.fire({
                icon: 'error',
                title: `No se pudo guardar Verifica tu conexión`
            });
        }else{
            validarCampos();
            Toast.fire({
                icon: 'success',
                title: `Instalacion Guardada correctamente 
                ${data.nombreRegistro}`
            });
            document.getElementById('formAgregarIns').reset();
            $('#modalRegistroInst').modal('hide');
            $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave=1");
        }
    })
}

const validarCamposAct = () => {
    $("#acliente").val() == "" ? $("#acliente").prop('required', true) : $("#acliente").prop('required', false);
    $("#atelefono").val() == "" ? $("#atelefono").prop('required', true) : $("#atelefono").prop("required", false);
    $("#adireccion").val() == "" ? $("#adireccion").prop("required", true) : $("#adireccion").prop("required", false);
    $("#aclasificacion").val() == "" ? $("#aclasificacion").prop("required", true) : $("#aclasificacion").prop("required", false);
}


const actualizarInstalacion = () =>{
    const formulario =document.getElementById("formActulizarIns");
    const datos = new FormData(formulario);
    fetch("../controller/instalaciones/actualizarInstalacion.php",{
        method: "POST",
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if(data.estado == "llenar"){
            validarCamposAct();
        }else if(data.estado == "error"){
            Toast.fire({
                icon: 'error',
                title: `No se pudo Actualizar la informacion, vuleve a intentarlo`
            });
        }else{
            console.log(data)
            validarCamposAct();
            Toast.fire({
                icon: 'success',
                title: `Información actualizada correctamente 
                ${data.estado}`
            });
            document.getElementById('formActulizarIns').reset();
            $('#modalActualizarInst').modal('hide');
            $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave="+data.estadoReg);
        }
    })
}

const completarInstalacion = () =>{
    const formulario = document.getElementById("formActulizarIns");
    const datos = new FormData(formulario);
    fetch("../controller/instalaciones/completarIns.php",{
        method: "POST",
        body: datos
    })
    .then(res => res.json())
    .then(data =>{
        console.log(data)
    })
}