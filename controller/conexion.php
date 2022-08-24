<?php
$conexion = mysqli_connect("127.0.0.1", "root", "", "mnet_reportes");
if(!$conexion){
    echo "No se puedo establecer la conexion con las base de datos";
}