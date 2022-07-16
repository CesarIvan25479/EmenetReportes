<?php
session_start();
require_once "conexion.php";

$data = array();
$usuario = $_POST["usuario"];
$password = $_POST["password"];

$query = "SELECT nombre, id, aPaterno, usuario FROM usuarios where usuario = '$usuario' and contrasena = '$password'";
$result = mysqli_query($conexion, $query);
$datos = mysqli_fetch_array($result);

if(mysqli_num_rows($result) > 0){
    $_SESSION["nombreUser"] = $datos['nombre']." ".$datos['aPaterno'];
    $_SESSION["iduser"] = $datos["id"];
    $data["estado"] = "conectado";
    if(isset($_POST["recordar"])){
        setcookie("usuario", $datos["id"], time() + 30*24*60*60);
    }else{
        setcookie("usuario", $datos["id"], time() - 10);
    }
    
    mysqli_close($conexion);
}
echo json_encode($data);