<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();
session_start();

if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}

$nomusuario = $_SESSION['nomusuario'];
if ($nomusuario == "Angeles C" or $nomusuario == "Miriam M") {

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
        <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
        <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
        <!-- HOJAS DE ESTILO -->
        <link rel="stylesheet" href="css/hoja_digitalizacion.css">
        <!-- DATATABLES -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    </head>

    <?php
    include('plantillas/digitalizacion.php');
    $nombreCarpeta = $_POST['nombre'];
    ?>

    <body>

        <!-- BOTON / NUEVO REGISTRO -->
        <div class="container">
            <div class="form-group form-control-sm">
                <button id="nueva" type="button" class="btn" data-toggle="modal" data-target="#modalCarpeta">
                    <svg id="Capa_1" enable-background="new 0 0 512 512" height="50" viewBox="0 0 512 512" width="50" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <g>
                                <path d="m28.017 372.641c-15.473 0-28.017-12.544-28.017-28.017v-344.624h176.227l48.823 38.303h197.033v56.034c-140.39 121.029-231.318 278.304-394.066 278.304z" fill="#3d9ae2" />
                                <g>
                                    <path d="m56.034 94.337v250.287c0 15.473-12.544 28.017-28.017 28.017h225.05l26.373-144.123-26.373-134.18h-197.033z" fill="#96c8ef" />
                                    <path d="m253.067 94.337v278.304h169.016c15.473 0 28.017-12.544 28.017-28.017v-250.287z" fill="#69b1e9" />
                                </g>
                                <g>
                                    <path d="m253.067 294.251h-103.663v-30h103.663l17.582 15z" fill="#69b1e9" />
                                </g>
                                <g>
                                    <path d="m253.067 264.251h103.663v30h-103.663z" fill="#3d9ae2" />
                                </g>
                            </g>
                            <g>
                                <circle cx="415.159" cy="415.159" fill="#001737" r="96.841" />
                                <path d="m457.678 400.159h-27.519v-27.518h-30v27.518h-27.518v30h27.518v27.519h30v-27.519h27.519z" fill="#77ca95" />
                            </g>
                        </g>
                    </svg>
                    <br>Nuevo Registro</br>
                </button>
            </div>
        </div>

        <!-- MODAL PARA CREAR CARPETAS -->
        <div class="modal fade" id="modalCarpeta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <form method="POST" action="crearCarpeta.php" enctype="multipart/form-data">

                <?php
                $nomusuario = $_SESSION['nomusuario'];
                ?>
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Nuevo Registro</h4>
                        </div>
                        <div class="modal-body">

                            <label>Nombre Contratante:</label>
                            <textarea name="nombreContratante" class="form-control" placeholder="Ingresa un nombre" onkeyup="mayusculas(this);"></textarea>

                            <label>Número Póliza:</label>
                            <textarea name="numeroP" class="form-control" placeholder="Ingresa número de póliza" onkeyup="mayusculas(this);"></textarea>

                            <label>Ramo:</label>
                            <select class="form-control" id="ramo" name="ramo">
                                <option selected disabled hidden>Seleccione: </option>
                                <option value="AUTOS">AUTOS</option>
                                <option value="DAÑOS">DAÑOS</option>
                                <option value="FIANZAS">FIANZAS</option>
                                <option value="GMM">GMM</option>
                                <option value="SINIESTROS">SINIESTROS</option>
                                <option value="VIDA">VIDA</option>
                            </select>

                            <label>Comentario:</label>
                            <textarea name="comentario" class="comentarios form-control" rows="5" placeholder="Ingresa un breve comentario (opcional)" onkeyup="mayusculas(this);"></textarea>

                            <!-- DATOS ADICIONALES -->
                            <input style="display: none;" type="radio" name="nomusuario" value="<?php echo $nomusuario;  ?>" checked>
                            <div class="modal-footer">
                                <input class="btn btn-primary" type="submit" name="" value="ENVIAR">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>

        <!-- TABLA QUE MUESTRA LOS DATOS  -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <table id="example" class="table table-condensed table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>NÚMERO DE POLIZA</th>
                                <th>RAMO</th>
                                <th>COMENTARIO</th>
                                <th style="width: 120px;">FECHA</th>
                                <th>DETALLES</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $archivo = "SELECT * FROM carpetas_digitalizacion ORDER BY id DESC";
                            $resultT = mysqli_query($conexion, $archivo);
                            while ($archivos = mysqli_fetch_array($resultT)) {

                            ?>
                                <tr style="text-align: center; font-size: 14px;">
                                    <td><?php echo $archivos['nombreContratante']; ?></td>
                                    <td><?php echo $archivos['numeroP']; ?></td>
                                    <td><?php echo $archivos['ramo']; ?></td>
                                    <td><?php echo $archivos['comentario']; ?></td>
                                    <td><?php echo $newDate2 = date("d/m/Y h:i a", strtotime(utf8_decode($archivos['fecha']))); ?></td>
                                    <td>
                                        <form id="archivo" action="detalles.php" method="POST">
                                            <input style="display: none;" type="radio" name="id" value="<?php echo $archivos['id'];  ?>" checked>
                                            <input style="display: none;" type="radio" name="nombreContratante" value="<?php echo $archivos['nombreContratante'];  ?>" checked>
                                            <input style="display: none;" type="radio" name="numeroP" value="<?php echo $archivos['numeroP'];  ?>" checked>
                                            <input style="display: none;" type="radio" name="comentario" value="<?php echo $archivos['comentario'];  ?>" checked>
                                            <input style="display: none;" type="radio" name="fecha" value="<?php echo $archivos['fecha'];  ?>" checked>



                                            <button type="submit" style="background-color: transparent;   border: none;">
                                                <svg id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" width="45" height="35" xmlns="http://www.w3.org/2000/svg">
                                                    <g>
                                                        <g>
                                                            <path d="m25.023 363.22c-13.82 0-25.023-11.204-25.023-25.024v-327.803h157.398l43.607 34.211h175.981v50.047c-125.39 108.097-206.603 268.569-351.963 268.569z" fill="#3d9ae2" />
                                                            <g>
                                                                <path d="m50.047 94.651v243.545c0 13.82-11.203 25.023-25.023 25.023h201.005l23.555-148.725-23.556-119.843z" fill="#96c8ef" />
                                                                <path d="m226.028 94.651v268.569h150.958c13.82 0 25.023-11.203 25.023-25.023v-243.546z" fill="#69b1e9" />
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <path d="m380.587 322.298 131.413 131.429-24.101 24.105-79.756-51.667-51.469-79.949z" fill="#a2abb8" />
                                                                    <path d="m332.716 370.178 23.958-23.962 131.225 131.616-23.77 23.775z" fill="#7e8b96" />
                                                                </g>
                                                                <path d="m252.817 242.048c34.607-34.393 90.542-34.219 124.935.388s34.219 90.542-.388 124.935l-75.788-47.888z" fill="#fff5f5" />
                                                                <path d="m377.364 367.371c-34.607 34.393-90.542 34.219-124.935-.388s-34.219-90.542.388-124.935z" fill="#dce6eb" />
                                                            </g>
                                                            <g>
                                                                <path d="m366.766 356.707c13.319-13.239 21.604-31.552 21.667-51.77.125-40.441-32.673-73.444-73.114-73.57-20.221-.063-38.582 8.106-51.903 21.345l-17.669-3.593-3.468-17.676c18.771-18.655 44.642-30.164 73.134-30.076 56.982.177 103.197 46.68 103.02 103.662-.088 28.491-11.759 54.291-30.529 72.945l-17.61-3.534z" fill="#c8d2dc" />
                                                                <path d="m211.749 304.389c.088-28.491 11.759-54.291 30.529-72.945l21.137 21.269c-13.322 13.239-21.604 31.549-21.667 51.77-.125 40.441 32.673 73.444 73.114 73.57 20.223.063 38.582-8.103 51.903-21.345l21.137 21.269c-18.771 18.655-44.642 30.164-73.134 30.076-56.982-.178-103.197-46.681-103.019-103.664z" fill="#a2abb8" />
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>

                                            </button>
                                        </form>
                                    </td>

                                </tr>

                            <?php

                            }
                            ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>


        <footer>
            <script src="<?php echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
            <script src="<?php echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?php echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>

            <script src="<?php echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
            <script src="<?php echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?php echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>


            <script type="text/javascript">
                $(document).ready(function() {
                    $('#example').DataTable({
                        "order": [
                            [0, 'desc']
                        ],
                        stateSave: true,
                        stateDuration: -1,
                        stateDuration: 60 * 25,
                        language: {
                            "sProcessing": "Procesando...",
                            "sLengthMenu": "Mostrar _MENU_ registros",
                            "sZeroRecords": "No se encontraron resultados",
                            "sEmptyTable": "Ningún dato disponible en esta tabla",
                            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                        }
                    });
                });

                // FUNCION PARA MAYUSCULAS
                function mayusculas(e) {
                    e.value = e.value.toUpperCase();
                }
            </script>
        </footer>

    </body>



<?php

} else {
    echo "<script> window.location='index.php'; </script>";
    header('location: index.php');
    exit;
}

?>