<?php
require_once "conexion.php";
if($_COOKIE["usuario"]){
    $data["estado"] = "guardado";
    $query = "SELECT usuario, contrasena FROM usuarios WHERE id = '{$_COOKIE['usuario']}'";
    $result = mysqli_query($conexion, $query);
    $datosGuardados = mysqli_fetch_array($result);
    $data["usuario"] = $datosGuardados["usuario"];
    $data["pass"] = $datosGuardados["contrasena"];
}
echo json_encode($data);