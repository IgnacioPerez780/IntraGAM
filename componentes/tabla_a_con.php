<?php
error_reporting(0);
include '../app/conexion.php';
$conexion = conexion();

//Proporciona el nombre del servidor especificado en la configuradcion del host
$base_url = "HTTPS://" . $_SERVER['HTTP_HOST'] . "/sistemas/";
//Se obtiene la fecha y hora actual
$fecha_actual = date("d-m-Y", $time);
//Referencia a las variables definidas de forma global
$GLOBALS['fecharet'] = $GLOBALS['fecha_actual'];

?>

<div class="row" style="width: 1240px;">
    <div class="col-sm-12">
        <h2 class="h2Consultor">Mis últimos 100 trámites</h2>
        <table data-order='[[0, "desc"]]' class="table table-hover table-condensed table-bordered" id="tablaDinamicaLoadAuto">
            <caption>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                    Generar Trámite
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </caption>
            <thead>
                <tr>
                    <td class="tdAutos">
                        <p><small>FOLIO GAM</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>TIPO DE SOLICITUD</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>GDD</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>NOMBRE DEL AGENTE</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>NOMBRE DEL CONTRATANTE</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>N° PÓLIZA</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>PRIORIDAD</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>FECHA SOLICITUD</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>FOLIO GNP (OT)</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>FECHA INICIO</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>FECHA PROMESA</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>DÍAS DE RETARDO</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>ESTATUS TRÁMITE</small></p>
                    </td>
                    <td class="tdAutos">
                        <p><small>VER MÁS</small></p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php
                //Query solo mostrara los ultimos 100 folios ingresados en autos
                $sql = "SELECT * FROM folios_a ORDER BY id DESC LIMIT 100";
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
                        $ver[15];
                ?>
                    <tr>
                        <!-- FOLIO -->
                        <td align="center" width="30px">
                            <span style="font-weight:bold;">
                                <small>
                                    <?php echo $ver[0]; ?>
                                </small>
                            </span>
                        </td>

                        <!-- TIPO DE SOLICITUD  -->
                        <td align="center" width="80px"><small><?php echo "$ver[3]"; ?></small></td>

                        <!-- GDD -->
                        <td align="center" width="40px">
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
                                    } else if ($vern[0] == 27) {
                                        echo "DV";
                                    } else {
                                        echo "--";
                                    }
                                }
                                ?>
                            </small>
                        </td>

                        <!-- NOMBRE DEL AGENTE   -->
                        <td align="center" width="250px">
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

                        <!-- NOMBRE DEL CONTRATANTE  -->
                        <td align="center" width="230px"><small><?php echo $ver[6]; ?></small></td>

                        <!-- NUMERO DE POLIZA  -->
                        <td align="center" width="80px"><small><?php echo $ver[7]; ?></small></td>

                        <!-- PRIORIDAD -->
                        <td align="center" width="50px"><small><?php echo $ver[9]; ?></small></td>

                        <!-- FECHA SOLICITUD -->
                        <td align="center" width="90px">
                            <small>
                                <?php
                                $fechap = $ver[1];
                                $fechap1 = new DateTime($fechap);
                                echo $fechap1->format("d-m-Y");
                                ?>
                            </small>
                        </td>

                        <!-- FOLIO -->
                        <td align="center" width="120px"><small><?php echo $ver[8]; ?></small></td>

                        <!-- FECHA INICIO -->
                        <td align="center" width="100px">
                            <small>
                                <?php
                                if ($ver[13] == "PROCESO" or $ver[13] == "TERMINADO") {

                                    $sqlpr = "SELECT fechaest FROM promesa_a WHERE folio='$ver[0]'";
                                    $resultpr = mysqli_query($conexion, $sqlpr);
                                    while ($verpr = mysqli_fetch_row($resultpr)) {
                                        $datospr = $verpr[0];

                                        $fechaot = $verpr[0];
                                        $fechapr1 = new Datetime($fechaot);
                                        echo $fechapr1->format("d-m-Y");
                                    }
                                } else { ?>
                                    ***
                                <?php
                                }
                                ?>
                            </small>
                        </td>

                        <!-- FECHA PROMESA -->
                        <td align="center" width="125px">
                            <b>
                                <!-- Estados donde no tienen ninguna Fecha promesa -->
                                <?php

                                if ($ver[13] == 'ENVIADO' or $ver[13] == 'CANCELADO' or $ver[13] == 'INCOMPLETO') { ?>
                                    <small>***</small>

                                <?php } ?>

                                <small>
                                    <?php
                                    // Solicitud - NUEVO NEGOCIO 

                                    if ($ver[3] == 'NUEVO NEGOCIO') {

                                        $sqlProductoA = "SELECT * FROM producto_autos WHERE producto = '$ver[4]' AND tipo_solicitud = '1'";
                                        $resultProductoA = mysqli_query($conexion, $sqlProductoA);

                                        while ($verProductoA = mysqli_fetch_row($resultProductoA)) {

                                            $sqlPromesaA = "SELECT fechaest FROM promesa_a WHERE folio = '$ver[0]'";
                                            $resultPromesaA = mysqli_query($conexion, $sqlPromesaA);

                                            while ($verFechaPromA = mysqli_fetch_row($resultPromesaA)) {
                                                $fecha = $verFechaPromA[0]; // Fecha- Cambio de Estado
                                                $dias = $verProductoA[3]; // Dias promesa del producto 
                                            }

                                            //Arreglo de los dias feriados en GAM
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
                                            //Inicializando el contador
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

                                                //Verifico que no sea un sabado, domingo o feriado
                                                if (!(date("w", $fecha_venci_noti) == 6 || date("w", $fecha_venci_noti) == 0 || $es_feriado)) {
                                                    //En caso de no ser sabado, domingo o feriado aumentamos nuestro contador
                                                    $i++;
                                                }
                                            }
                                            $fechaprom = strtotime(date('d-m-Y', $fecha_venci_noti));
                                            $fechaprom1 = date('d-m-Y', $fecha_venci_noti);
                                            $time = time();
                                            $fechaactual = strtotime(date('d-m-Y', $time));

                                            //Validamos fecha promesa y fecha actual para accionar el semaforo 
                                            if ($ver[13] == 'PROCESO') {

                                                if ($fechaprom > $fechaactual) { ?>
                                                    <img src="img/ver.png" class="semaforoV" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1;
                                                } else if ($fechaprom < $fechaactual) { ?>
                                                    <img src="img/roj.png" class="semaforoR" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1;
                                                } else if ($fechaprom = $fechaactual) { ?>
                                                    <img src="img/ama.png" class="semaforoA" />
                                                    &nbsp;
                                        <?php
                                                    echo $fechaprom1;
                                                }
                                            }
                                        }
                                        ?>
                                        <!-- Agrego para que el semaforo no cambie si esta en estas condiciones -->
                                        <?php
                                        $consulta = "select cd_estado_a from cam_estado_a where folio_a='$ver[0]'";
                                        $resultado = mysqli_query($conexion, $consulta);

                                        while ($verfecha = mysqli_fetch_row($resultado)) {
                                            $datosfecha = $verfecha[0]; //cambio de estado
                                            $fechap = strtotime(date("d-m-Y", strtotime($datosfecha))); //formateo de la fecha cambio de estado

                                            if ($ver[13] == "TERMINADO") { //condiciones

                                                if ($fechaprom > $fechap) { ?>
                                                    <img src="img/ver.png" class="semaforoV" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1;
                                                } else if ($fechaprom < $fechap) { ?>
                                                    <img src="img/roj.png" class="semaforoR" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1;
                                                } else if ($fechaprom = $fechap) { ?>
                                                    <img src="img/ama.png" class="semaforoA" />
                                                    &nbsp;
                                    <?php
                                                    echo $fechaprom1;
                                                }
                                            }
                                        }
                                    } // cierre - NUEVO NEGOCIO 
                                    ?>

                                    <?php

                                    // Solicitud - MOVIMIENTOS

                                    if ($ver[3] == 'MOVIMIENTOS') {
                                        $sqlProductoA = "SELECT * FROM producto_autos WHERE producto = '$ver[4]' AND tipo_solicitud = '2'";
                                        $resultProductoA = mysqli_query($conexion, $sqlProductoA);

                                        while ($verProductoA = mysqli_fetch_row($resultProductoA)) {

                                            $sqlPromesaA = "SELECT fechaest FROM promesa_a WHERE folio = '$ver[0]'";
                                            $resultPromesaA = mysqli_query($conexion, $sqlPromesaA);

                                            while ($verFechaPromA = mysqli_fetch_row($resultPromesaA)) {
                                                $fecha = $verFechaPromA[0]; // Fecha- Cambio de Estado
                                                $dias = $verProductoA[3]; // Dias promesa del producto 
                                            }
                                            //Arreglo de dias feriados en GAM
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
                                            //Inicializando el contador
                                            $i = 0;
                                            while ($i < $dias) {
                                                //Se suma un dia a la fecha final (86400 segundos)
                                                $fecha_venci_noti += 86400;
                                                $es_feriado = FALSE;
                                                //Recorro todos los dias feriados
                                                foreach ($feriados as $key => $feriado) {
                                                    //Verifico si la fecha final actual es feriado o no
                                                    if (date("Y-m-d", $fecha_venci_noti) === date("Y-m-d", strtotime($feriado))) {
                                                        //En caso de ser feriado cambio mi variable a TRUE 
                                                        $es_feriado = TRUE;
                                                    }
                                                }

                                                //Verifico que no sea un sabado, domingo o feriado
                                                if (!(date("w", $fecha_venci_noti) == 6 || date("w", $fecha_venci_noti) == 0 || $es_feriado)) {
                                                    //En caso de no ser sabado, domingo o feriado aumentamos nuestro contador
                                                    $i++;
                                                }
                                            }
                                            $fechaprom = strtotime(date('d-m-Y', $fecha_venci_noti));
                                            $fechaprom1 = date('d-m-Y', $fecha_venci_noti);
                                            $time = time();
                                            $fechaactual = strtotime(date('d-m-Y', $time));

                                            //Validamos fecha promesa y fecha actual para accionar el semaforo
                                            if ($ver[13] == 'PROCESO') {

                                                if ($fechaprom > $fechaactual) { ?>
                                                    <img src="img/ver.png" class="semaforoV" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1;
                                                } else if ($fechaprom < $fechaactual) { ?>
                                                    <img src="img/roj.png" class="semaforoR" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1;
                                                } else if ($fechaprom = $fechaactual) { ?>
                                                    <img src="img/ama.png" class="semaforoA" />
                                                    &nbsp;
                                        <?php
                                                    echo $fechaprom1;
                                                }
                                            }
                                        }
                                        ?>

                                        <!-- Agrego para que el semaforo no cambie si esta en estas condiciones -->
                                        <?php
                                        $consulta = "select cd_estado_a from cam_estado_a where folio_a='$ver[0]'";
                                        $resultado = mysqli_query($conexion, $consulta);

                                        while ($verfecha = mysqli_fetch_row($resultado)) {
                                            $datosfecha = $verfecha[0]; //cambio de estado
                                            $fechap = strtotime(date("d-m-Y", strtotime($datosfecha))); //formateo de la fecha cambio de estado

                                            if ($ver[13] == "TERMINADO") { //condiciones

                                                if ($fechaprom > $fechap) { ?>
                                                    <img src="img/ver.png" class="semaforoV" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1;
                                                } else if ($fechaprom < $fechap) { ?>
                                                    <img src="img/roj.png" class="semaforoR" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1;
                                                } else if ($fechaprom = $fechap) { ?>
                                                    <img src="img/ama.png" class="semaforoA" />
                                                    &nbsp;
                                    <?php
                                                    echo $fechaprom1;
                                                }
                                            }
                                        }
                                    } // cierre - MOVIMIENTOS 
                                    ?>
                                </small>
                            </b>
                        </td>

                        <!-- DIAS DE RETARDO -->
                        <td align="center" width="75px">
                            <small>
                                <?php

                                //SIN FECHA EL ESTADO DE ENVIADO Y CANCELADO NO OBTENDRA NINGUN RETARDO
                                if ($ver[13] == 'ENVIADO' or $ver[13] == 'CANCELADO' or $ver[13] == 'INCOMPLETO') {
                                    echo "***";
                                }

                                // DIAS DE RETARDO EN EL ESTADOS PROCESO 
                                if ($ver[13] == 'PROCESO') {

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
                                    $endDate = (new DateTime($fecharet))->modify('+1 day');
                                    //Se establece el intervalo de 1 dia
                                    $interval = new DateInterval('P1D');
                                    //Rango de fechas
                                    $date_range = new DatePeriod($startDate, $interval, $endDate); //creamos rango de fechas
                                    //Inica el contador
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

                                //CONGELA LOS DÍAS DE DIFERENCIA ENTRE DOS DÍAS
                                if ($ver[13] == "TERMINADO") {

                                    $sqlpr = "select cd_estado_a from cam_estado_a where folio_a='$ver[0]'";
                                    $resultpr = mysqli_query($conexion, $sqlpr);

                                    while ($verpr = mysqli_fetch_row($resultpr)) {

                                        $datospr = $verpr[0]; //FECHA CAMBIO DE ESTADO

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
                                        $endDate = (new DateTime($datospr))->modify('-1 day');
                                        //Se establece el intervalo de 1 dia
                                        $interval = new DateInterval('P1D');
                                        //Periodo de fechas
                                        $date_range = new DatePeriod($startDate, $interval, $endDate); //creamos rango de fechas
                                        //Inicia el contador
                                        $workdays = 0;

                                        foreach ($date_range as $date) {
                                            //Se considera el fin de semana y los feriados como no hábiles
                                            if ($date->format("N") < 6 and !in_array($date->format("Y-m-d"), $feriados)) {
                                                ++$workdays; // se cuentan los días habiles
                                            }
                                        }

                                        if ($startDate > $endDate) {

                                            echo "Días: 0";
                                        } else {

                                            echo 'Días: ' . $workdays;
                                        }
                                    }
                                }

                                ?>
                            </small>
                        </td>

                        <!-- ESTATUS DEL TRAMITE  -->
                        <td align="center" width="70px"><small><?php echo $ver[13]; ?></small></td>

                        <!-- VER SEGUIMIENTO  -->
                        <td align="center" width="50px">
                            <form class="" action="seguimiento_a_c.php?id=<?php echo $ver[0]; ?>" method="post">
                                <button class="btn btn-link glyphicon glyphicon-search" value="<?php echo $ver[0]; ?>" id="id" name="id"></button>
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
<footer>
    <script src="<?php echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablaDinamicaLoadAuto').DataTable({
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