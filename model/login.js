let iniciar = document.getElementById("iniciarSesion");
iniciar.addEventListener("submit", (e) =>{
    e.preventDefault();
    var formInicia = new FormData(iniciar);
    fetch("./controller/login.php",{
        method: "POST",
        body: formInicia
    })
    .then(res => res.json())
    .then(data =>{
        if(data.estado == "conectado"){
            window.open("./panel/reportes.php","_self");
        }else{
            $('#mensajeConexion').css('display','block');
        }
    })
})
$.ajax({
    type: "POST",
    url: "./controller/recordarSesion.php",
    dataType: "json",
    success: (data) => {
        if(data.estado == "guardado"){
            $("#usuario").val(data.usuario)
            $("#password").val(data.pass);
            $("#recordar").prop("checked", true);
        }
    }
})