<?php
session_start();
if (isset($_SESSION["nombreUser"])) {
  $usuario = $_SESSION["nombreUser"];
  $clave = $_GET["estado"];
} else {
  header("location: ../index.html");
  die();
}
include "../model/conexion.php";
$query = "SELECT *FROM catalogopoblaciones";
$result = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Instalaciones</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="icon" href="../dist/img/Logosinfondo.svg">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-closed sidebar-collapse">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#modalRegistroInst">Nueva Instalación</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#pendientes" class="nav-link" onclick="mostrarPendientes('1')">Pendientes</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#realizadas" class="nav-link" onclick="mostrarRealizadas('3')">Realizdas</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#canceladas" class="nav-link" onclick="mostrarCanceladas('4')">Canceladas</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">10 Notificaciones</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-headset mr-2"></i> 4 reportes nuevos
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-calendar mr-2"></i> 8 Instalaciones nuevas
              <span class="float-right text-muted text-sm">12 horas</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">Mostrar Todas las Notificaciones</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../" class="brand-link">
        <img src="../dist/img/Logosinfondo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-5" style="opacity: .8">
        <span class="brand-text font-weight-light">Emenet Comunica...</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/profile-user.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $usuario ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" id="mostrarMenuLateral">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Administración</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-solid fa-headset"></i>
                <p>
                  Soporte técnico
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./Clientes.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nuevo Reporte</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link active" data-toggle="modal" data-target="#IntFecha">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reportes Pendiente</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./OrdenesInstalacion.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reportes Atendidos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./OrdenesInstalacion.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Estadisticas</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                  Instalaciones
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link" data-toggle="modal" data-target="#modalRegistroInst">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nueva Instalación</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="mostrarPendientes('1')" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Instalaciones Pendientes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="mostrarPendientes('3')" role="button" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Instalaciones Realizdas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="mostrarPendientes('4')" role="button" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Instalaciones Canceladas</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>
                  Sistema
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./routers.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Router</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Corte</p>
                    <i class="right fas fa-angle-left"></i>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Coyoltepec</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Puntos de Acceso</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Planes de internet</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Zonas</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h4 class="m-0">
                <small id="estadoInstalacion">Instalaciones Pendientes</small>
              </h4>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                  Instalaciones Pendientes
                </div>
                <div class="card-body">
                  <div id="tablaInstalaciones" class="tablaInstalaciones"></div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal Registro Cliente -->
    <div class="modal fade" id="modalRegistroInst" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Registrar Instalación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group row">
              <label for="cliente" class="col-sm-3 col-form-label">Nombre:</label>
              <div class="col-sm-9">
                <div class="input-group mb-1">
                  <input type="text" class="form-control form-control-sm" placeholder="Nombre del titular" onkeyup="javascript:this.value=this.value.toUpperCase();" id="Acliente" name="cliente">
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
                  <input type="text" class="form-control form-control-sm" placeholder="Número Teléfonico" maxlength="10" name="telefono" id="telefono">
                </div>
              </div>
            </div>

            <div class="form-group row telefono2" id="inputTelf2">
              <label for="telefono2" class="col-sm-3 col-form-label">Teléfono 2:</label>
              <div class="col-sm-9">
                <div class="input-group mb-1">
                  <input type="text" class="form-control form-control-sm" placeholder="Número Teléfonico" maxlength="10" name="telefono2" id="telefono2">
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="cPostal" class="col-sm-3 col-form-label">Localidad:</label>
              <div class="col-sm-2">
                <div class="input-group mb-1">
                  <input type="text" class="form-control form-control-sm" maxlength="5" placeholder="C. P." name="cPostal" id="cPostal" onkeyup="buscarLocalidad()">
                </div>
              </div>
              <div class="col-sm-7">
                <div class="input-group mb-1">
                <select class="form-control form-control-sm select2" style="width: 100%;" id="nombre" name="nombre">
                            <?php while ($clientes = sqlsrv_fetch_array($resultadoClientes)) : ?>
                              <option value="<?= $clientes['NOMBRE'] ?>"><?= $clientes['NOMBRE'] ?></option>
                            <?php endwhile; ?>
                          </select>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="coordenadas" class="col-sm-3 col-form-label">Coordenadas:</label>
              <div class="col-sm-9">
                <div class="input-group mb-1">
                  <input type="text" class="form-control form-control-sm" placeholder="Coordenadas de Maps" name="coordenadas" id="coordenadas">
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="direccion" class="col-sm-3 col-form-label">Dirección:</label>
              <div class="col-sm-9">
                <div class="input-group mb-1">
                  <input type="text" class="form-control form-control-sm" placeholder="Nombre de la calle y número" onkeyup="javascript:this.value=this.value.toUpperCase();" name="direccion" id="direccion">
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="caracteristicas" class="col-sm-3 col-form-label">Características del domicilio:</label>
              <div class="col-sm-9">
                <div class="input-group mb-1">
                  <textarea class="form-control form-control-sm" rows="2" placeholder="Descripción de la casa" onkeyup="javascript:this.value=this.value.toUpperCase();" name="caracteristicas" id="caracteristicas"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="referencias" class="col-sm-3 col-form-label">Referencias:</label>
              <div class="col-sm-9">
                <div class="input-group mb-1">
                  <textarea class="form-control form-control-sm" rows="2" placeholder="Puntos de referencia para encontrar el domicilio" onkeyup="javascript:this.value=this.value.toUpperCase();" name="referencias" id="referencias"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="disponibilidad" class="col-sm-3 col-form-label">Disponibilidad:</label>
              <div class="col-sm-9">
                <div class="input-group mb-1">
                  <textarea class="form-control form-control-sm" rows="1" placeholder="Días y horario en el que se encuentren en el domicilio" onkeyup="javascript:this.value=this.value.toUpperCase();" name="disponibilidad" id="disponibilidad"></textarea>
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
                  <textarea class="form-control form-control-sm" rows="2" onkeyup="javascript:this.value=this.value.toUpperCase();" name="observaciones" id="observaciones"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-outline-success btn-sm">Registrar Instalación</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Actualizar Cliente -->
    <div id="modalActualizar"></div>
    <!--- -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
        <p>Sidebar content</p>
        <p>Sidebar content</p>
        <p>Sidebar content</p>
        <p>Sidebar content</p>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        ...
      </div>
      <!-- Default to the left -->
      <strong>Emenet Comunicaciones <a href="https://m-net.mx"> m-net.mx</a>.</strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/js/select2.full.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- Page specific script -->
  <script src="../controller/instalaciones.js"></script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });
    $(document).ready(() => {
      $("#tablaInstalaciones").load("../views/tablaInstalaciones.php?clave=<?= $clave ?>")
      $("#modalActualizar").load("../views/modalActualizar.php");
    })
  </script>
</body>

</html>