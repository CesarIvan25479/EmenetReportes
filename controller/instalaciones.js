const mostrarPendientes = (clave) => {
    $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave=" + clave);
}
const mostrarRealizadas = (clave) => {
    $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave=" + clave);
}
const mostrarCanceladas = (clave) => {
    $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave=" + clave);
}
const buscarLocalidad = ()=>{
    let codigo = document.getElementById("cPostal").value;
    if(codigo.length ==5){
        console.log("afds")
        $.ajax({
            type: 'POST',
            url: '../model/localidades.php',
            dataType: 'json',
            data: "",
            success: (data) => {
                if(data.estado == "error"){
                    console.error("No se pudieron obtener los datos del API CP")
                }else{
                    console.log(data)
                }
            }
        })
    }
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
        this.value = this.value.replace(/[^0-9]/g,'');
    });
    $('#telefono2').on('input', function (){
        this.value = this.value.replace(/[^0-9]/g,'');
    });
    $("#cPostal").on('input', function (){
        this.value = this.value.replace(/[^0-9]/g,'');
    })
})