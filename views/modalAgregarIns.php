<?php
include "../controller/conexion.php";
$query = "SELECT *FROM catalogopoblaciones";
$resultPobla = mysqli_query($conexion, $query);

$query = "SELECT *FROM clasificacionesInstalacion";
$resultClasifi = mysqli_query($conexion, $query);
?>
<div class="modal fade" id="modalRegistroInst" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="agregarOrden" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Registrar Instalación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="cliente" class="col-sm-3 col-form-label">Nombre:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control form-control-sm" placeholder="Nombre del titular" 
                                onkeyup="javascript:this.value=this.value.toUpperCase();" 
                                id="Acliente" name="cliente">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-sm-3 col-form-label">Teléfono:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend" id="agregaTel">
                                    <span class="input-group-text" id="cambiarIcono"><i class="fas fa-plus"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-sm"
                                placeholder="Número Teléfonico" maxlength="10" name="telefono" id="telefono">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row telefono2" id="inputTelf2">
                        <label for="telefono2" class="col-sm-3 col-form-label">Teléfono 2:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control form-control-sm" 
                                placeholder="Número Teléfonico" maxlength="10" name="telefono2" id="telefono2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cPostal" class="col-sm-3 col-form-label">Localidad:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <select class="form-control form-control-sm select2" style="width: 100%;" id="poblacion" name="poblacion">
                                    <option value="ADS">ASDSA</option>
                                    <?php while ($localidad = mysqli_fetch_array($resultPobla)) : ?>
                                        <option value="<?= $localidad['id'] ?>"><?= $localidad['nombrePoblacion'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coordenadas" class="col-sm-3 col-form-label">Coordenadas:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control form-control-sm" 
                                placeholder="Coordenadas de Maps" name="coordenadas" id="coordenadas">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="direccion" class="col-sm-3 col-form-label">Dirección:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control form-control-sm" 
                                placeholder="Nombre de la calle y número" 
                                onkeyup="javascript:this.value=this.value.toUpperCase();" name="direccion" id="direccion">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="caracteristicas" class="col-sm-3 col-form-label">Características del domicilio:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <textarea class="form-control form-control-sm" rows="2" 
                                placeholder="Descripción de la casa" 
                                onkeyup="javascript:this.value=this.value.toUpperCase();" name="caracteristicas" id="caracteristicas"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="referencias" class="col-sm-3 col-form-label">Referencias:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <textarea class="form-control form-control-sm" rows="2" 
                                placeholder="Puntos de referencia para encontrar el domicilio" 
                                onkeyup="javascript:this.value=this.value.toUpperCase();" 
                                name="referencias" id="referencias"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="disponibilidad" class="col-sm-3 col-form-label">Disponibilidad:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <textarea class="form-control form-control-sm" rows="1" 
                                placeholder="Días y horario en el que se encuentren en el domicilio" 
                                onkeyup="javascript:this.value=this.value.toUpperCase();" 
                                name="disponibilidad" id="disponibilidad"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clasificacion" class="col-sm-3 col-form-label">Clasificación:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <select name="clasificacion" id="clasificacion" class="form-control form-control-sm">
                                    <option>INA</option>
                                    <option>IFO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="observaciones" class="col-sm-3 col-form-label">Observaciones:</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <textarea class="form-control form-control-sm" rows="2" 
                                onkeyup="javascript:this.value=this.value.toUpperCase();" 
                                name="observaciones" id="observaciones"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-success btn-sm">Registrar Instalación</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(() => {
        let estadoTel = false;
        $("#agregaTel").on("click", () => {
            if (estadoTel) {
                $('#inputTelf2').css('display', 'none');
                $("#cambiarIcono").html(`<i class="fas fa-plus"></i>`);
                $('#telefono2').val("");
                estadoTel = false;
            } else {
                $('#inputTelf2').css('display', 'flex');
                $("#cambiarIcono").html(`<i class="fas fa-minus"></i>`);
                estadoTel = true;
            }
        })
        $('#telefono').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        $('#telefono2').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        $("#cPostal").on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        })
    })
</script>