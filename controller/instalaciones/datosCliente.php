<?php
include "../conexion.php";
$cliente = $_POST["cliente"];
$query = "SELECT 
ins.id, ins.nombreCliente, ins.telefono, catp.id as idPob,
ins.coordenadas, ins.direccion, ins.caracteristicasDomicilio,
ins.referencias, clasin.descripcion, ins.disponibilidad, ins.observaciones, detins.id_instalando,
uRec.nombre AS recNombre, uRec.aPaterno AS recPaterno, ins.fechaRegistro, 
uAct.nombre AS actNombre, uAct.aPaterno AS actPaterno, detins.fechaActualizacion,
uAten.nombre AS atenNombre, uAten.aPaterno AS atenPaterno, detins.fechaAtencion,
uIns.nombre AS instNombre, uIns.aPaterno AS instPaterno, detins.fechaInstalando
FROM instalaciones AS ins 
INNER JOIN catalogopoblaciones AS catp ON ins.id_poblacion = catp.id 
INNER JOIN clasificacionesinstalacion AS clasin ON clasin.id = ins.id_clasificacion 
INNER JOIN usuarios AS uRec ON ins.id_recibio = uRec.id
LEFT JOIN detalleinstalacion AS detins ON detins.id_instalacion = ins.id 
LEFT JOIN usuarios AS uAct ON detins.id_actualizo = uAct.id
LEFT JOIN usuarios AS uAten ON detins.id_atendio = uAten.id
LEFT JOIN usuarios AS uIns ON detins.id_instalando = uIns.id
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
    $data["instalando"] = [
        "nombre" => "{$datos['instNombre']} {$datos['instPaterno']}",
        "fecha" => date("d-m-Y", strtotime(substr($datos['fechaInstalando'], 0, 10)))." | ".date_format(date_create(substr($datos['fechaInstalando'], 10, 10)), 'g:i A'),
    ];
    $data["info"] = [
        "clave" => $datos["id"],
        "nombre" => $datos["nombreCliente"],
        "telefono" => $datos["telefono"],
        "poblacion" => $datos["idPob"],
        "ubicacion" => $datos["coordenadas"],
        "nomCalle" => $datos["direccion"], 
        "detalleCasa" => $datos["caracteristicasDomicilio"],
        "refDomicilio" => $datos["referencias"],
        "tipoServicio" => $datos["descripcion"],
        "horarioDis" => $datos["disponibilidad"],
        "observaciones" => $datos["observaciones"],
        "instalando" => $datos["id_instalando"],
    ];
}else{
    $data["estado"] = "error";
}
echo json_encode($data);