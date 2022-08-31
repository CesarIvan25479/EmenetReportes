<?php
include "../conexion.php";
include "./verificarDetalleIns.php";
session_start();
$folio = $_POST["folio"];
$data["folio"] = $folio;
$row = validarTablaDetalle($conexion, $folio);
$data["num"] = validarTablaDetalle($conexion, $folio);;
$data["num2"] = (int)validarTablaDetalle($conexion, $folio);;
if($row == "1"){
    $query = "UPDATE detalleInstalacion SET
		id_atendio = '{$_SESSION["iduser"]}',
		fechaAtencion = NOW(),
		id_instalando = null,
		fechaInstalando = null
		WHERE
		id_instalacion = '$folio'";
}else{
    $data["prub"] = "inserta";
}
echo json_encode($data);