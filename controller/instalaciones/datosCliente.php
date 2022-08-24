<?php
include "../conexion.php";
$cliente = $_POST["cliente"];
$query = "SELECT ins.id, ins.coordenadas, ins.direccion, ins.caracteristicasDomicilio,
ins.referencias, ins.observaciones, detins.id_instalacion, ins.nombreCliente, 
ins.telefono, catp.id as idPob, ins.fechaRegistro, 
clasin.descripcion, detins.fechaAtencion, detins.fechaActualizacion, ins.disponibilidad,
uRec.nombre AS recNombre, uRec.aPaterno AS recPaterno,
uAct.nombre AS actNombre, uAct.aPaterno AS actPaterno,
uAten.nombre AS atenNombre, uAten.aPaterno AS atenPaterno
FROM instalaciones AS ins 
INNER JOIN catalogopoblaciones AS catp ON ins.id_poblacion = catp.id 
INNER JOIN clasificacionesinstalacion AS clasin ON clasin.id = ins.id_clasificacion 
INNER JOIN usuarios AS uRec ON ins.id_recibio = uRec.id
LEFT JOIN detalleinstalacion AS detins ON detins.id_instalacion = ins.id 
LEFT JOIN usuarios AS uAct ON detins.id_actualizo = uAct.id
LEFT JOIN usuarios AS uAten ON detins.id_atendio = uAten.id
WHERE ins.id = $cliente";
$result = mysqli_query($conexion, $query);
$datos = mysqli_fetch_array($result);
if($result){
    $data["recibio"] = [
        "nombre" => "{$datos['recNombre']} {$datos['recPaterno']}",
        "fecha" => date("d-m-Y", strtotime(substr($datos["fechaRegistro"], 0, 10))),
        "hora" => date_format(date_create(substr($datos["fechaRegistro"], 10, 10)), 'g:i A'),
    ];
    $data["actualizo"] = [
        "nombre" => "{$datos['actNombre']} {$datos['actPaterno']}",
        "fecha" => date("d-m-Y", strtotime(substr($datos["fechaActualizacion"], 0, 10))),
        "hora" => date_format(date_create(substr($datos["fechaActualizacion"], 10, 10)), 'g:i A'),
    ];
    $data["atendio"] = [
        "nombre" => "{$datos['atenNombre']} {$datos['atenPaterno']}",
        "fecha" => date("d-m-Y", strtotime(substr($datos["fechaAtencion"],0, 10))),
        "hora" => date_format(date_create(substr($datos["fechaAtencion"], 10, 10)), 'g:i A'),
    ];
    $data["info"] = $datos;
}else{
    $data["estado"] = "error";
}
echo json_encode($data);