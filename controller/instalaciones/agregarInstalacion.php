<?php
include "../conexion.php";
session_start();
$nombreCliente = strip_tags(trim($_POST["cliente"]));
$telefono = strip_tags(trim($_POST["telefono"]));
$telefono2 = strip_tags(trim($_POST["telefono2"]));
$poblacion = strip_tags(trim($_POST["poblacion"]));
$coordenadas = strip_tags(trim($_POST["coordenadas"]));
$direccion = strip_tags(trim($_POST["direccion"]));
$caracteristicas = strip_tags(trim($_POST["caracteristicas"]));
$referencias = strip_tags(trim($_POST["referencias"]));
$disponibilidad = strip_tags(trim($_POST["disponibilidad"]));
$clasificacion = strip_tags(trim($_POST["clasificacion"]));
$observaciones = strip_tags(trim($_POST["observaciones"]));

if (empty($nombreCliente) || empty($telefono) || empty($poblacion) || empty($direccion) || empty($clasificacion)) {
    $data["estado"] = "llenar";
    echo json_encode($data);
} else {
    $query = "INSERT INTO instalaciones
    (id_clasificacion, nombreCliente, telefono, id_poblacion, coordenadas,
    direccion, caracteristicasDomicilio, referencias, disponibilidad, 
    observaciones, id_recibio, fechaRegistro, id_estado) 
    VALUES(
    '$clasificacion',
    '$nombreCliente',
    '$telefono$telefono2',
    '$poblacion',
    '$coordenadas',
    '$direccion',
    '$caracteristicas',
    '$referencias',
    '$disponibilidad',
    '$observaciones',
    '{$_SESSION["iduser"]}',
    NOW(),
    '1'
)";

    if ($result = mysqli_query($conexion, $query)) {
        $data["nombreRegistro"] = $nombreCliente;
        echo json_encode($data);
    }else{
        $data["estado"] = "conexion";
    }
}
