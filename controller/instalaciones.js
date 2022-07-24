const mostrarPendientes = (clave) =>{
    $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave="+clave);
}
const mostrarRealizadas= (clave) =>{
    $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave="+clave);
}
const mostrarCanceladas = (clave) =>{
    $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave="+clave);
}
