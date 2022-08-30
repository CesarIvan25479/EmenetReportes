<?php
include "../controller/conexion.php";
$query = "SELECT *FROM catalogoPoblaciones";
$result = mysqli_query($conexion, $query);

$query = "SELECT *FROM clasificacionesInstalacion";
$resultClasifi = mysqli_query($conexion, $query);
?>
<div class="modal fade" id="modalActualizarInst" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formActulizarIns">
                <div class="modal-header" id="estadoAtendiendo">
                    <div>
                        <h5 class="modal-title" id="tituloModalAct" style="font-weight: 600;"></h5>
                        <p class="formatAtendiendo" id="datosAtendiendo">Atendiendo: <b id="atenNombre"></b> - <b id="atenFecha"></b></p>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="acliente" class="col-sm-3 col-form-label">Nombre:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control form-control-sm" placeholder="Nombre del titular" id="acliente" name="cliente" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <input 
                                type="hidden" class="form-control form-control-sm"  
                                 id="folio" name="folio">
                                 <input 
                                type="hidden" class="form-control form-control-sm"  
                                 id="estado" name="estado">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="atelefono" class="col-sm-3 col-form-label">Teléfono:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend" id="AagregaTel">
                                    <span class="input-group-text" id="AcambiarIcono">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-sm" placeholder="Número Teléfonico" name="telefono" id="atelefono">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row telefono2" id="ainputTelf2">
                        <label for="atelefono2" class="col-sm-3 col-form-label">Teléfono 2:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control form-control-sm" p laceholder="Número Teléfonico" name="telefono2" id="atelefono2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="acPostal" class="col-sm-3 col-form-label">Localidad:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <select class="form-control form-control-sm" data-dropdown-css-class="select2-danger" style="width: 100%;" id="apoblacion" name="poblacion">
                                    <?php while ($localidad = mysqli_fetch_array($result)) : ?>
                                        <option value="<?= $localidad['id'] ?>"><?= $localidad['nombrePoblacion'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="acoordenadas" class="col-sm-3 col-form-label">Coordenadas:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control form-control-sm" placeholder="Coordenadas de Maps" name="coordenadas" id="acoordenadas">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="adireccion" class="col-sm-3 col-form-label">Dirección:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control form-control-sm" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Nombre de la calle y número" name="direccion" id="adireccion">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="acaracteristicas" class="col-sm-3 col-form-label">Características del domicilio:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <textarea class="form-control form-control-sm" rows="2" placeholder="Descripción de la casa" onkeyup="javascript:this.value=this.value.toUpperCase();" name="caracteristicas" id="acaracteristicas"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="areferencias" class="col-sm-3 col-form-label">Referencias:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <textarea class="form-control form-control-sm" rows="2" placeholder="Puntos de referencia para encontrar el domicilio" onkeyup="javascript:this.value=this.value.toUpperCase();" name="referencias" id="areferencias"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="adisponibilidad" class="col-sm-3 col-form-label">Disponibilidad:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <textarea class="form-control form-control-sm" rows="1" placeholder="Días y horario en el que se encuentren en el domicilio" onkeyup="javascript:this.value=this.value.toUpperCase();" name="disponibilidad" id="adisponibilidad"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="aclasificacion" class="col-sm-3 col-form-label">Clasificación:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <select name="clasificacion" id="aclasificacion" class="form-control form-control-sm">
                                    <?php while ($clasificacion = mysqli_fetch_array($resultClasifi)) : ?>
                                        <option value="<?= $clasificacion['id'] ?>"><?= $clasificacion["nombreClasificacion"] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="aobservaciones" class="col-sm-3 col-form-label">Observaciones:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-2">
                                <textarea class="form-control form-control-sm" rows="2" onkeyup="javascript:this.value=this.value.toUpperCase();" name="observaciones" id="aobservaciones"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container div-cont mb-2">
                        <b class="titulo-aviso">Registrado por <small class="usario-registro" id="recibioNom"></small></b>
                        <b class="info-Fecha">Fecha: <small class="usario-registro" id="recibioFecha"></small></b>
                        <b class="info-Fecha">Hora: <small class="usario-registro" id="recibioHora"></small></b>
                    </div>
                    <div class="container div-cont mb-2" id="infoActualizo">
                        <b class="titulo-aviso">Actualizado por <small class="usario-registro" id="actualizoNom"></small></b>
                        <b class="info-Fecha">Fecha: <small class="usario-registro" id="actualizoFecha"></small></b>
                        <b class="info-Fecha">Hora: <small class="usario-registro" id="actualizoHora"></small></b>
                    </div>
                    <div class="container div-cont mb-2" id="infoAtendio">
                        <b class="titulo-aviso">Atendido por <small class="usario-registro" id="atendioNom"></small></b>
                        <b class="info-Fecha">Fecha: <small class="usario-registro" id="atendioFecha"></small></b>
                        <b class="info-Fecha">Hora: <small class="usario-registro" id="atendioHora"></small></b>
                    </div>

                </div>
                <div class="modal-footer flex-column">
                    <div class="d-flex justify-content-between" style="width: 100%; margin-bottom: 8px">
                        <button type="button" class="btn btn-block btn-outline-primary btn-sm"><i class="fas fa-toolbox"></i></button>
                    </div>
                    <div class="d-flex justify-content-between" style="width: 100%;">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-outline-danger btn-sm">No exitosa <i class="fab fa-mixer"></i></button>
                        <button type="button" class="btn btn-outline-warning btn-sm" onclick="actualizarInstalacion()">Actualizar <i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-outline-success btn-sm">Completar <i class="fas fa-check"></i></button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
    $(document).ready(() => {
        let estadoTel = false;
        $("#AagregaTel").on("click", () => {
            if (estadoTel) {
                $('#ainputTelf2').css('display', 'none');
                $("#AcambiarIcono").html(`<i class="fas fa-plus"></i>`);
                $('#atelefono2').val("");
                estadoTel = false;
            } else {
                $('#ainputTelf2').css('display', 'flex');
                $("#AcambiarIcono").html(`<i class="fas fa-minus"></i>`);
                estadoTel = true;
            }
        })
        $('#Atelefono').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        $('#Atelefono2').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        $("#acPostal").on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        })
    });
</script>