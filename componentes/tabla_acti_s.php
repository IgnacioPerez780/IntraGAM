<?php
error_reporting(0);
include '../app/conexion.php';
$conexion = conexion();
$nomusuario = $_SESSION['nomusuario'];
$id = $_SESSION['id_usuario'];
//Proporciona el nombre del servidor especificado en la configuración del host
$base_url = "HTTPS://" . $_SERVER['HTTP_HOST'] . "/sistemas/";
//Se obtiene la fecha y hora actual
$fecha_actual = date("d-m-Y", $time);
//Referencia a las variables definidas de forma global
$GLOBALS['fecharet'] = $GLOBALS['fecha_actual'];

?>
<div class="row" style="width: 1190px;">
    <div class="col-sm-12">
        <h2>Mis últimos 100 trámite</h2>
        <!--Data-order ordenamiento de descendente a ascendente-->
        <table data-order='[[0, "desc"]]' class="table table-hover table-condensed table-bordered" id="tablaDinamicaLoad">
            <caption>
                <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                    Generar Trámite
                    <span class="glyphicon glyphicon-plus"></span>
                </button> -->
            </caption>
            <thead>
                <tr>
                    <td class="tdCancelados">
                        <p><small>FOLIO GAM</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>RAMO</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>GDD</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>NOMBRE DEL AGENTE</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>NOMBRE DEL CONTRATANTE</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>NOMBRE DEL AFECTADO</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>N° PÓLIZA</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>FECHA SOLICITUD</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>ESTATUS TRÁMITE</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>DÍAS DE TRAMITE</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>ACTIVAR</small></p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <!-- Query mostrara los folios de siniestros con estado cancelado -->
                <?php
                $sql = "SELECT * FROM folios_s WHERE estado = 'CANCELADO' ORDER BY id";
                $result = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($result)) {

                    $datos = $ver[0] . "||" .
                        $ver[1] . "||" .
                        $ver[2] . "||" .
                        $ver[3] . "||" .
                        $ver[4] . "||" .
                        $ver[5] . "||" .
                        $ver[6] . "||" .
                        $ver[7] . "||" .
                        $ver[8] . "||" .
                        $ver[9] . "||" .
                        $ver[10] . "||" .
                        $ver[11] . "||" .
                        $ver[12] . "||" .
                        $ver[13] . "||" .
                        $ver[14] . "||" .
                        $ver[15] . "||" .
                        $ver[16];

                ?>
                    <tr>
                        <!-- FOLIO GAM -->
                        <td width="55px"><span style="font-weight:bold;"><small><?php echo $ver[0]; ?></small></span></td>
                        <!-- RAMO  -->
                        <td width="50px"><small><?php echo $ver[2]; ?></small></td>
                        <!--GDD-->
                        <td width="40px"><span style="font-size:10pt;">
                                <small>
                                    <?php
                                    $sqln = "select gdd from datos_agente where id='$ver[15]'";
                                    $resultn = mysqli_query($conexion, $sqln);
                                    while ($vern = mysqli_fetch_row($resultn)) {
                                        $datosn = $vern[0];
                                        if ($vern[0] == 18) {
                                            echo "RR";
                                        } else if ($vern[0] == 19) {
                                            echo "OS";
                                        } else if ($vern[0] == 20) {
                                            echo "MG";
                                        } else if ($vern[0] == 21) {
                                            echo "NO";
                                        } else {
                                            echo "--";
                                        }
                                    }
                                    ?>
                                </small>
                        </td>
                        <!-- NOMBRE AGENTE -->
                        <td width="250px">
                            <small>
                                <?php
                                $sqln = "select nombre from datos_agente where id='$ver[15]'";
                                $resultn = mysqli_query($conexion, $sqln);
                                while ($vern = mysqli_fetch_row($resultn)) {
                                    $datosn = $vern[0];
                                    echo $vern[0];
                                }


                                ?>
                            </small>
                        </td>
                        <!-- NOMBRE CONTRATANTE -->
                        <td width="250px"><small><?php echo $ver[7]; ?></small> </td>
                        <!-- NOMBRE AFECTADO -->
                        <td width="250px"><small><?php echo $ver[16]; ?></small></td>
                        <!-- NUMERO DE POLIZA -->
                        <td width="100px"><small><?php echo $ver[8]; ?></small></td>
                        <!-- FECHA SOLICITUD  -->
                        <td width="80px">
                            <small>
                                <?php
                                $fechaSolicitud = $ver[1];
                                $fechaS = new DateTime($fechaSolicitud);
                                echo $fechaS->format("d-m-Y");
                                ?>
                            </small>
                        </td>
                        <!-- ESTATUS TRAMITE -->
                        <td width="100px"><small><?php echo $ver[14]; ?></small></td>
                        <!-- DIAS DE RETARDO -->
                        <td width="50px"><small>

                                <?php
                                if ($ver[14] == 'ENVIADO' || $ver[14] == 'INCOMPLETO') {
                                    echo "***";
                                }

                                if ($ver[14] == 'REPROCESO' || $ver[14] == 'PROCESO' || $ver[14] == 'CANCELADO' || $ver[14] == 'TERMINADO' || $ver[14] == 'PROCESO GNP') {
                                    $consulta = "SELECT fecha_cam_estado  FROM folios_s WHERE id='$ver[0]'";
                                    $resultado = mysqli_query($conexion, $consulta);

                                    while ($verf = mysqli_fetch_row($resultado)) {
                                        $datosf = $verf[0]; //FECHA CAMBIO DE ESTADO 
                                        $fecha = $verf[0];
                                        $dias = 0;

                                        //ARREGLO CON TODOS LOS DIAS FERIADOS 
                                        $feriados = array(
                                            '2019-01-01',
                                            '2019-02-04',
                                            '2019-03-18',
                                            '2019-04-18',
                                            '2019-04-19',
                                            '2019-05-01',
                                            '2019-05-10',
                                            '2019-09-16',
                                            '2019-11-18',
                                            '2019-12-12',
                                            '2019-12-25',
                                            '2019-12-31',
                                            '2020-01-01',
                                            '2020-02-03',
                                            '2020-03-16',
                                            '2020-04-09',
                                            '2020-04-10',
                                            '2020-05-01',
                                            '2020-09-16',
                                            '2020-11-16',
                                            '2020-12-25',
                                            '2021-01-01',
                                            '2021-02-01',
                                            '2021-03-15',
                                            '2021-04-08',
                                            '2021-04-09',
                                            '2021-09-16',
                                            '2021-11-15',
                                            '2022-02-07',
                                            '2022-03-21',
                                            '2022-04-14',
                                            '2022-04-15',
                                            '2022-09-16',
                                            '2022-11-01',
                                            '2022-11-02',
                                            '2022-10-21',
                                                            '2023-02-06',
                                                            '2023-03-20',
                                                            '2023-04-06',
                                                            '2023-04-07',
                                                            '2023-05-01',
                                                            '2023-05-05',
                                                            '2023-05-10',
                                                            '2023-09-16',
                                                            '2023-11-01',
                                                            '2023-11-02',
                                                            '2023-11-20',
                                                            '2023-12-12',
                                                            '2023-12-25',
                                        );
                                        //Convierte la fecha en formato Unix
                                        $comienzo = strtotime($fecha);
                                        //Inicializa la fecha final
                                        $fecha_venci_noti = $comienzo;
                                        //Inicializo el contador
                                        $i = 0;

                                        while ($i < $dias) {
                                            //Se suma un dia a la fecha final (86400 segundos)
                                            $fecha_venci_noti += 86400;
                                            $es_feriado = FALSE;

                                            //Recorro todos los feriados
                                            foreach ($feriados as $key => $feriado) {
                                                //Verifico si la fecha final actual es feriado o no
                                                if (date("Y-m-d", $fecha_venci_noti) === date("Y-m-d", strtotime($feriado))) {
                                                    //En caso de ser feriado cambio mi variable a TRUE
                                                    $es_feriado = TRUE;
                                                }
                                            }

                                            if (!(date("w", $fecha_venci_noti) == 6 || date("w", $fecha_venci_noti) == 0 || $es_feriado)) {
                                                $i++;
                                            }
                                        }

                                        $fechaprom = strtotime(date('d-m-Y', $fecha_venci_noti));
                                        $fechaprom1 = date('d-m-Y', $fecha_venci_noti);

                                        $time = time();
                                        $fechaactual = strtotime(date('d-m-Y', $time));
                                    }
                                }

                                if ($ver[14] == 'REPROCESO' || $ver[14] == 'PROCESO' || $ver[14] == 'PROCESO GNP') {
                                    //ARREGLO CON TODOS LOS DIAS FERIADOS 
                                    $feriados = array(
                                        '2019-01-01',
                                        '2019-02-04',
                                        '2019-03-18',
                                        '2019-04-18',
                                        '2019-04-19',
                                        '2019-05-01',
                                        '2019-05-10',
                                        '2019-09-16',
                                        '2019-11-18',
                                        '2019-12-12',
                                        '2019-12-25',
                                        '2019-12-31',
                                        '2020-01-01',
                                        '2020-02-03',
                                        '2020-03-16',
                                        '2020-04-09',
                                        '2020-04-10',
                                        '2020-05-01',
                                        '2020-09-16',
                                        '2020-11-16',
                                        '2020-12-25',
                                        '2021-01-01',
                                        '2021-02-01',
                                        '2021-03-15',
                                        '2021-04-08',
                                        '2021-04-09',
                                        '2021-09-16',
                                        '2021-11-15',
                                        '2022-02-07',
                                        '2022-03-21',
                                        '2022-04-14',
                                        '2022-04-15',
                                        '2022-09-16',
                                        '2022-11-01',
                                        '2022-11-02',
                                        '2022-10-21',
                                                            '2023-02-06',
                                                            '2023-03-20',
                                                            '2023-04-06',
                                                            '2023-04-07',
                                                            '2023-05-01',
                                                            '2023-05-05',
                                                            '2023-05-10',
                                                            '2023-09-16',
                                                            '2023-11-01',
                                                            '2023-11-02',
                                                            '2023-11-20',
                                                            '2023-12-12',
                                                            '2023-12-25',
                                    );

                                    $startDate = (new DateTime($fechaprom1));
                                    $endDate = (new DateTime($fecharet))->modify('+1 day');
                                    $interval = new DateInterval('P1D');
                                    $date_range = new DatePeriod($startDate, $interval, $endDate); //creamos rango de fechas
                                    $workdays = -1;

                                    foreach ($date_range as $date) {
                                        //Se considera el fin de semana y los feriados como no hábiles
                                        if ($date->format("N") < 6 and !in_array($date->format("Y-m-d"), $feriados))
                                            ++$workdays; // se cuentan los días habiles
                                    }

                                    if ($startDate >= $endDate) {
                                        echo "Días: 0";
                                    } else {
                                        echo 'Días: ' . $workdays;
                                    }
                                }

                                //SI LOS TRAMITES SON TERMINADO O CANCELADO SE CONGELAN

                                if ($ver[14] == 'TERMINADO' || $ver[14] == 'CANCELADO') {
                                    $consulta2 = "SELECT cd_estado_s FROM cam_estado_s WHERE folio_s='$ver[0]'";
                                    $resultado2 = mysqli_query($conexion, $consulta2);

                                    while ($vertc = mysqli_fetch_row($resultado2)) {
                                        $datostc = $vertc[0];

                                        //ARREGLO CON TODOS LOS DIAS FERIADOS
                                        $feriados = array(
                                            '2019-01-01',
                                            '2019-02-04',
                                            '2019-03-18',
                                            '2019-04-18',
                                            '2019-04-19',
                                            '2019-05-01',
                                            '2019-05-10',
                                            '2019-09-16',
                                            '2019-11-18',
                                            '2019-12-12',
                                            '2019-12-25',
                                            '2019-12-31',
                                            '2020-01-01',
                                            '2020-02-03',
                                            '2020-03-16',
                                            '2020-04-09',
                                            '2020-04-10',
                                            '2020-05-01',
                                            '2020-09-16',
                                            '2020-11-16',
                                            '2020-12-25',
                                            '2021-01-01',
                                            '2021-02-01',
                                            '2021-03-15',
                                            '2021-04-08',
                                            '2021-04-09',
                                            '2021-09-16',
                                            '2021-11-15',
                                            '2022-02-07',
                                            '2022-03-21',
                                            '2022-04-14',
                                            '2022-04-15',
                                            '2022-09-16',
                                            '2022-11-01',
                                            '2022-11-02',
                                            '2022-10-21',
                                                            '2023-02-06',
                                                            '2023-03-20',
                                                            '2023-04-06',
                                                            '2023-04-07',
                                                            '2023-05-01',
                                                            '2023-05-05',
                                                            '2023-05-10',
                                                            '2023-09-16',
                                                            '2023-11-01',
                                                            '2023-11-02',
                                                            '2023-11-20',
                                                            '2023-12-12',
                                                            '2023-12-25',
                                        );
                                        //Fecha inicial
                                        $startDate = (new DateTime($fechaprom1));
                                        //Fecha final
                                        $endDate = (new DateTime($datostc))->modify('-1 day');
                                        //Se establece el intervalo de 1 dia
                                        $interval = new DateInterval('P1D');
                                        //Rango de fechas
                                        $date_range = new DatePeriod($startDate, $interval, $endDate); //creamos rango de fechas
                                        //Inica el contador
                                        $workdays = 0;

                                        foreach ($date_range as $date) {
                                            //Se considera el fin de semana y los feriados como no hábiles
                                            if ($date->format("N") < 6 and !in_array($date->format("Y-m-d"), $feriados)) {
                                                ++$workdays; // se cuentan los días habiles

                                            }
                                        }

                                        //COMPRUEBA SI ES NULL LA CASILLA O HAY DIA EN EL CAMBIO DE FECHA 
                                        if ($startDate > $endDate || is_null($ver[17])) {
                                            echo "Días: 0";
                                        } else {
                                            echo 'Días: ' . $workdays;
                                        }
                                    }
                                }

                                ?>

                            </small></td>
                        <!-- SEGUIMIENTO DEL TRAMITE -->
                        <td width="50px">
                            <button class="btn btn-link glyphicon glyphicon-retweet" data-toggle="modal" data-target="#modalUpload_s" onclick="reactivar_s('<?php echo $datos ?>')"></button>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<footer>
    <script src="<?php echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
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
                }
            });
        });
    </script>
</footer>