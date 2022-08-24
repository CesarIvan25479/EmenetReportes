<?php
require_once "../controller/conexion.php";
CONST ESTADO = array(
    "1" => "Pendientes",
    "3" => "Realizadas",
    "4" => "No exitosas"
);
$clave = $_GET["clave"];

if ($clave == 1) {
    $query = "SELECT ins.id, detins.id_instalacion, ins.nombreCliente, 
    ins.telefono, catp.nombrePoblacion, ins.fechaRegistro, 
    clasin.descripcion, detins.fechaAtencion 
    FROM instalaciones AS ins 
    INNER JOIN catalogoPoblaciones AS catp ON ins.id_poblacion = catp.id 
    INNER JOIN clasificacionesInstalacion AS clasin ON clasin.id = ins.id_clasificacion 
    LEFT JOIN detalleInstalacion AS detins ON detins.id_instalacion = ins.id 
    WHERE id_estado = '$clave' ORDER bY ins.id DESC";
    $result = mysqli_query($conexion, $query);
} else {
    $query = "SELECT ins.id, detins.id_instalacion, ins.nombreCliente, 
    ins.telefono, catp.nombrePoblacion, ins.fechaRegistro, 
    clasin.descripcion, detins.fechaAtencion 
    FROM instalaciones AS ins 
    INNER JOIN catalogoPoblaciones AS catp ON ins.id_poblacion = catp.id 
    INNER JOIN clasificacionesInstalacion AS clasin ON clasin.id = ins.id_clasificacion 
    LEFT JOIN detalleInstalacion AS detins ON detins.id_instalacion = ins.id 
    WHERE id_estado = '$clave' ORDER bY ins.id DESC LIMIT 150";
    $result = mysqli_query($conexion, $query);
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table id="tablaRepor" class="table table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Folio</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Población</th>
                        <?php if ($clave == 1) : ?>
                            <th scope="col">Registro</th>
                        <?php else : ?>
                            <th scope="col">Registro | Atendido</th>
                        <?php endif; ?>
                        <th scope="col">Clasif.</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <?php while ($datos = mysqli_fetch_array($result)) :
                ?>

                    <?php if ($clave == 3):?>
                        <tr class="table-success">
                    <?php elseif($clave == 4):?>
                        <tr class="table-danger">
                    <?php else:?>
                        <tr>
                    <?php endif; ?>
                        <th scope="row" data-toggle="modal" onclick="buscarDatosIns('<?= $datos['id'] ?>')" data-target="#modalActualizarInst"><?= $datos["id"] ?></th>
                        <td data-toggle="modal" onclick="buscarDatosIns('<?= $datos['id'] ?>')" data-target="#modalActualizarInst"><?= $datos["nombreCliente"] ?></td>
                        <td data-toggle="modal" onclick="buscarDatosIns('<?= $datos['id'] ?>')" data-target="#modalActualizarInst" style="color: #00809C;font-weight: bold;"><?=substr($datos["telefono"],0,10)?></td>
                        <td data-toggle="modal" onclick="buscarDatosIns('<?= $datos['id'] ?>')" data-target="#modalActualizarInst"><?= $datos["nombrePoblacion"] ?></td>
                        <?php if ($clave == 1) : ?>
                            <td onclick="buscarDatosIns('<?= $datos['id'] ?>')" data-toggle="modal" data-target="#modalActualizarInst"><?= date("d-m-Y", strtotime(substr($datos["fechaRegistro"], 0, 10))) ?></td>
                        <?php else : ?>
                            <td onclick="buscarDatosIns('<?= $datos['id'] ?>')" data-toggle="modal" data-target="#modalActualizarInst"><?=date("d-m-Y", strtotime(substr($datos["fechaRegistro"], 0, 10)))?><small style="font-weight: bold;color:red;font-size:18px"> | </small><?=date("d-m-Y", strtotime(substr($datos["fechaAtencion"], 0, 10)))?></td>
                        <?php endif; ?>
                        <td onclick="buscarDatosIns('<?= $datos['id'] ?>')" data-toggle="modal" data-target="#modalActualizarInst" style="color: #00809C;font-weight: bold;"><?= $datos["descripcion"] ?></td>
                        <td>
                            <form action="../../../Emenet/pages/ordenesDocumentos.php" method="post">
                                <input type="hidden" value="" name="folio">
                                <button class="btn btn-block btn-outline-primary btn-xs" type="submit"><i class="fas fa-map-marked"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tablaRepor').DataTable({
            "columnDefs": [{
                "targets": 0
            }],
            "order": [ 0, 'desc' ],
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Resultados _START_-_END_ de  _TOTAL_",
                "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "",
                "sSearch": "Buscar Cliente:",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
            },
            "lengthMenu": [
                [25, 50, 100, -1],
                [25, 50, 100, "Todos"]
            ],
            scrollCollapse: true
        });
    });
    document.getElementById("estadoInstalacion").innerText = "Instalaciones <?=ESTADO[$clave]?>";
</script>