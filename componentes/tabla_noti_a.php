<?php
error_reporting(0);
include '../app/conexion.php';
$conexion = conexion();
$base_url = "HTTPS://" . $_SERVER['HTTP_HOST'] . "/sistemas/";

?>

<div>
    <h2>Mis Notificaciones</h2>
    <table id="tablaDinamicaLoad" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style="text-align: center">NOTIFICACIONES</th>
                <th style="width: 180px; text-align: center">DETALLES</th>
            </tr>
        </thead>
        <tbody>

            <!-- Query para identificar el tipo de notificacion que es -->
            <?php
            $sqlTipo = "SELECT tipo FROM notificaciones_a WHERE contador = '1' AND folio > '0' GROUP BY tipo";
            $resultTipo = mysqli_query($conexion, $sqlTipo);
            while ($verTipo = mysqli_fetch_array($resultTipo)) {
                $datoTipo = $verTipo[0];
                if ($datoTipo === "TRAMITE") {

            ?>
                    <tr>
                        <!-- Querys para la seccion de tramites -->
                        <?php

                        $sqlTramite = "SELECT folio FROM notificaciones_a WHERE contador = '1' AND tipo = 'TRAMITE' AND folio > '0' GROUP BY folio DESC";
                        $resultTramite = mysqli_query($conexion, $sqlTramite);
                        while ($verTramite = mysqli_fetch_array($resultTramite)) {
                            $datoTramite = $verTramite[0];

                            $sqlUsuario = "SELECT usuario FROM notificaciones_a WHERE contador = '1' AND (tipo = 'TRAMITE' AND folio = '$datoTramite') GROUP BY folio";
                            $resultUsuario = mysqli_query($conexion, $sqlUsuario);
                            while ($verUsuario = mysqli_fetch_array($resultUsuario)) {
                                $datoUsuario = $verUsuario[0];
                            }

                            $sqlFecha = "SELECT fecha FROM notificaciones_a WHERE contador = '1' AND (tipo = 'TRAMITE' AND folio = '$datoTramite')";
                            $resultFecha = mysqli_query($conexion, $sqlFecha);
                            while ($verFecha = mysqli_fetch_array($resultFecha)) {
                                $datoFecha = $verFecha[0];
                                $newDate = date("d-m-Y", strtotime($datoFecha));
                            }
                        ?>
                            <!-- Notificaciones -->
                            <td align="center">
                                <small>
                                    <b><?= $datoUsuario ?></b> generó un nuevo <b>Trámite</b> el día <b><?= $newDate ?></b> y le fue asignado el <b>folio <?= $datoTramite ?></b>
                                </small>

                            </td>

                            <!-- Detalles -->
                            <td align="center">
                                <form class="" action="seguimiento_a_c.php?id=<?php echo $datoTramite; ?>" method="post">
                                    <button class="btn btn-warning glyphicon glyphicon-align-justify" value="<?php echo $datoTramite; ?>" id="id" name="id"></button>
                                </form>
                            </td>
                    </tr>
                <?php
                        }
                    } elseif ($datoTipo === "COMENTARIO") { ?>

                <tr>
                    <!-- Querys para la sección de comentarios -->
                    <?php
                        $sqlComent = "SELECT folio FROM notificaciones_a WHERE contador = '1' AND tipo = 'COMENTARIO' AND folio > '0' GROUP BY folio DESC";
                        $resultComent = mysqli_query($conexion, $sqlComent);
                        while ($verComent = mysqli_fetch_array($resultComent)) {
                            $datoComent = $verComent[0];

                            $sqlUsuario = "SELECT usuario FROM notificaciones_a WHERE contador = '1' AND (tipo = 'COMENTARIO' AND folio = '$datoComent') GROUP BY folio";
                            $resultUsuario = mysqli_query($conexion, $sqlUsuario);
                            while ($verUsuario = mysqli_fetch_array($resultUsuario)) {
                                $datoUsuario = $verUsuario[0];
                            }

                            $sqlConteoC = "SELECT COUNT(*) FROM notificaciones_a WHERE contador = '1' AND (tipo = 'COMENTARIO' AND folio = '$datoComent') GROUP BY folio";
                            $resultConteoC = mysqli_query($conexion, $sqlConteoC);
                            while ($verConteoC = mysqli_fetch_array($resultConteoC)) {
                                $datoConteoC = $verConteoC[0];
                            }

                            $sqlFultima = "SELECT MAX(fecha) AS id FROM notificaciones_a WHERE contador = '1' AND (tipo = 'COMENTARIO' AND folio = '$datoComent') ";
                            $resultFultima = mysqli_query($conexion, $sqlFultima);
                            while ($verFultima = mysqli_fetch_array($resultFultima)) {
                                $datoFultima = $verFultima[0];
                                $newDateC = date("d-m-Y", strtotime($datoFultima));
                            }
                    ?>
                        <!-- Notificaciones -->
                        <td align="center">
                            <small>
                                <b><?= $datoUsuario ?></b> agrego <b><?= $datoConteoC . " Comentario(s)" ?></b> al <b>folio <?= $datoComent ?></b>, última actualización el día <b><?= $newDateC ?></b>
                            </small>

                        </td>

                        <!-- Detalles -->
                        <td align="center">
                            <form class="" action="seguimiento_a_c.php?id=<?php echo $datoComent; ?>" method="post">
                                <button class="btn btn-warning glyphicon glyphicon-align-justify" value="<?php echo $datoComent; ?>" id="id" name="id"></button>
                            </form>
                        </td>
                </tr>
            <?php
                        }
                    } elseif ($datoTipo === "ARCHIVO") { ?>

            <tr>
                <!-- Querys para la sección de archivos -->
                <?php
                        $sqlAr = "SELECT folio FROM notificaciones_a WHERE contador = '1' AND tipo = 'ARCHIVO' AND folio > '0' GROUP BY folio DESC";
                        $resultAr = mysqli_query($conexion, $sqlAr);
                        while ($verAr = mysqli_fetch_array($resultAr)) {
                            $datoAr = $verAr[0];

                            $sqlUsuario = "SELECT usuario FROM notificaciones_a WHERE contador = '1' AND (tipo = 'ARCHIVO' AND folio = '$datoAr') GROUP BY folio";
                            $resultUsuario = mysqli_query($conexion, $sqlUsuario);
                            while ($verUsuario = mysqli_fetch_array($resultUsuario)) {
                                $datoUsuario = $verUsuario[0];
                            }

                            $sqlConteoA = "SELECT COUNT(*) FROM notificaciones_a WHERE contador = '1' AND (tipo = 'ARCHIVO' AND folio = '$datoAr') GROUP BY folio";
                            $resultConteoA = mysqli_query($conexion, $sqlConteoA);
                            while ($verConteoA = mysqli_fetch_array($resultConteoA)) {
                                $datoConteoA = $verConteoA[0];
                            }

                            $sqlFultima = "SELECT MAX(fecha) AS id FROM notificaciones_a WHERE contador = '1' AND (tipo = 'ARCHIVO' AND folio = '$datoAr')";
                            $resultFultima = mysqli_query($conexion, $sqlFultima);
                            while ($verFultima = mysqli_fetch_array($resultFultima)) {
                                $datoFultima = $verFultima[0];
                                $newDateA = date("d-m-Y", strtotime($datoFultima));
                            }

                ?>
                    <!-- Notificaciones -->
                    <td align="center">
                        <small>
                            <b><?= $datoUsuario ?></b> agrego <b><?= $datoConteoA . " Archivo(s)" ?></b> al <b>folio <?= $datoAr ?></b>, última actualización el día <b><?= $newDateA ?></b>
                        </small>

                    </td>

                    <!-- Detalles -->
                    <td align="center">
                        <form class="" action="seguimiento_a_c.php?id=<?php echo $datoAr; ?>" method="post">
                            <button class="btn btn-warning glyphicon glyphicon-align-justify" value="<?php echo $datoAr; ?>" id="id" name="id"></button>
                        </form>
                    </td>
            </tr>
        <?php
                        }
                    } elseif ($datoTipo === "REACTIVACION") { ?>
        <!-- Querys para reactivaciones -->
        <tr>
            <?php
                        $sqlReact = "SELECT folio FROM notificaciones_a WHERE contador = '1' AND tipo = 'REACTIVACION' AND folio > '0' GROUP BY folio DESC";
                        $resultReact = mysqli_query($conexion, $sqlReact);
                        while ($verReact = mysqli_fetch_array($resultReact)) {
                            $datoReact = $verReact[0];

                            $sqlUsuario = "SELECT usuario FROM notificaciones_a WHERE contador = '1' AND (tipo = 'REACTIVACION' AND folio = '$datoReact') GROUP BY folio";
                            $resultUsuario = mysqli_query($conexion, $sqlUsuario);
                            while ($verUsuario = mysqli_fetch_array($resultUsuario)) {
                                $datoUsuario = $verUsuario[0];
                            }

                            $sqlConteoA = "SELECT COUNT(*) FROM notificaciones_a WHERE contador = '1' AND (tipo = 'REACTIVACION' AND folio = '$datoReact') GROUP BY folio";
                            $resultConteoA = mysqli_query($conexion, $sqlConteoA);
                            while ($verConteoA = mysqli_fetch_array($resultConteoA)) {
                                $datoConteoA = $verConteoA[0];
                            }

                            $sqlFultima = "SELECT MAX(fecha) AS id FROM notificaciones_a WHERE contador = '1' AND (tipo = 'REACTIVACION' AND folio = '$datoReact')";
                            $resultFultima = mysqli_query($conexion, $sqlFultima);
                            while ($verFultima = mysqli_fetch_array($resultFultima)) {
                                $datoFultima = $verFultima[0];
                                $newDateA = date("d-m-Y", strtotime($datoFultima));
                            }
            ?>

                <!-- Notificaciones -->
                <td align="center">
                    <small>
                        <b><?= $datoUsuario ?></b> reactivo el <b>folio <?= $datoReact ?></b> el día <b><?= $newDateA ?></b>
                    </small>
                </td>

                <!-- Detalles -->
                <td align="center">
                    <form class="" action="seguimiento_a_c.php?id=<?php echo $datoReact; ?>" method="post">
                        <button class="btn btn-warning glyphicon glyphicon-align-justify" value="<?php echo $datoReact; ?>" id="id" name="id"></button>
                    </form>
                </td>

        </tr>

<?php
                        }
                    }
                }
?>
        </tbody>

    </table>
</div>

<script>
    $(document).ready(function() {
        $('#tablaDinamicaLoad').DataTable({
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
            },


        });
    });
</script>