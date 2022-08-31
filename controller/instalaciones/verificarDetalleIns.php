<?php
function validarTablaDetalle($conexion, $folio)
{
    $query = "SELECT COUNT(id) AS cantidad FROM detalleInstalacion WHERE id_instalacion = '$folio' LIMIT 1";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}
