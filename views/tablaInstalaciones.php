<?php
require_once "../model/conexion.php";
$clave = $_GET["clave"];

if ($clave == 1) {
    $query = "SELECT ins.id, detins.id_instalacion, ins.nombreCliente, 
    ins.telefono, catp.nombrePoblacion, ins.fechaRegistro, 
    clasin.nombreClasificacion, detins.fechaAtencion 
    FROM instalaciones AS ins 
    INNER JOIN catalogopoblaciones AS catp ON ins.id_poblacion = catp.id 
    INNER JOIN clasificacionesinstalacion AS clasin ON clasin.id = ins.id_clasificacion 
    INNER JOIN detalleinstalacion AS detins ON detins.id_instalacion = ins.id 
    WHERE id_estado = '$clave' ORDER bY ins.id DESC";
    $result = mysqli_query($conexion, $query);
} else {
    $query = "SELECT ins.id, detins.id_instalacion, ins.nombreCliente, 
    ins.telefono, catp.nombrePoblacion, ins.fechaRegistro, 
    clasin.nombreClasificacion, detins.fechaAtencion 
    FROM instalaciones AS ins 
    INNER JOIN catalogopoblaciones AS catp ON ins.id_poblacion = catp.id 
    INNER JOIN clasificacionesinstalacion AS clasin ON clasin.id = ins.id_clasificacion 
    INNER JOIN detalleinstalacion AS detins ON detins.id_instalacion = ins.id 
    WHERE id_estado = '$clave' ORDER bY ins.id DESC LIMIT 50";
    $result = mysqli_query($conexion, $query);
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table id="ordenes" class="table table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Folio</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Población</th>
                        <?php if($clave == 1):?>
                        <th scope="col">Registro</th>
                        <?php else: ?>
                            <th scope="col">Registro | Atendido</th>
                        <?php endif;?>
                        <th scope="col">Clas.</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <?php while ($datos = mysqli_fetch_array($result)) :
                ?>
                    <tr>
                        <th scope="row"><?= $datos["id"] ?></th>
                        <td><?= $datos["nombreCliente"] ?></td>
                        <td><?= $datos["telefono"] ?></td>
                        <td><?= $datos["nombrePoblacion"] ?></td>
                        <?php if ($clave == 1) : ?>
                            <td><?= substr($datos["fechaRegistro"], 0, 10) ?></td>
                        <?php else: ?>
                            <td><?= substr($datos["fechaRegistro"], 0, 10)." | ". substr($datos["fechaAtencion"], 0, 10)?></td>
                        <?php endif; ?>
                        <td><?= $datos["nombreClasificacion"] ?></td>
                        <td>
                            <form action="../../../Emenet/pages/ordenesDocumentos.php" method="post">
                                <input type="hidden" value="" name="folio">
                                <button class="btn btn-block btn-outline-primary btn-xs" type="submit"><i class="fas fa-map-marked"></i></button>
                            </form>
                            <form action="../../../Emenet/pages/ordenesDocumentos.php" method="post">
                                <input type="hidden" value="" name="folio">
                                <button class="btn btn-block btn-outline-primary btn-xs" type="submit"><i class="fas fa-check"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>