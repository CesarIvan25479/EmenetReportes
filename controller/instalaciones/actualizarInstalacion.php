<?php
function actualizarDatos(
    $nombreCliente,
    $telefono,
    $telefono2,
    $poblacion,
    $coordenadas,
    $direccion,
    $caracteristicas,
    $referencias,
    $disponibilidad,
    $clasificacion,
    $observaciones,
    $folio, 
    $conexion
) {
    $query = "UPDATE instalaciones SET
		nombreCliente = '$nombreCliente',
		telefono = '$telefono$telefono2',
		id_poblacion = '$poblacion',
		coordenadas = '$coordenadas',
		direccion = '$direccion',
		caracteristicasDomicilio = '$caracteristicas',
		referencias = '$referencias',
		disponibilidad = '$disponibilidad',
		id_clasificacion = '$clasificacion',
		observaciones = '$observaciones'
		WHERE
		id = '$folio'";
    if(mysqli_query($conexion, $query)){
        return $nombreCliente;
    }else{
        return "error";
    }
}


include "../conexion.php";
session_start();
$folio = strip_tags(trim($_POST["folio"]));
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
    $query = "SELECT COUNT(id) AS cantidad FROM detalleInstalacion WHERE id_instalacion = '$folio' LIMIT 1";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_array($result);
    if ($row["cantidad"] == 1) {
        $query = "UPDATE detalleInstalacion SET id_actualizo = '{$_SESSION["iduser"]}',
                fechaActualizacion 	= NOW() WHERE id_instalacion = '$folio'";
        if(mysqli_query($conexion, $query)){
            $data["estado"] = actualizarDatos($nombreCliente, $telefono, $telefono2,
            $poblacion, $coordenadas, $direccion, $caracteristicas, $referencias, $disponibilidad,
            $clasificacion, $observaciones, $folio, $conexion);
            echo json_encode($data);
        }else{
            $data["estado"] == "error";
            echo json_encode($data);
        }
    }else{
        $query = "INSERT INTO detalleInstalacion(id_instalacion, id_actualizo, fechaActualizacion)
                VALUES('$folio', '{$_SESSION["iduser"]}', NOW())";
        if(mysqli_query($conexion, $query)){
            $data["estado"] = actualizarDatos($nombreCliente, $telefono, $telefono2,
            $poblacion, $coordenadas, $direccion, $caracteristicas, $referencias, $disponibilidad,
            $clasificacion, $observaciones, $folio, $conexion);
            echo json_encode($data);
        }else{
            $data["estado"] == "error";
            echo json_encode($data);
        }
    }
}
