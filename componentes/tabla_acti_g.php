<?php
error_reporting(0);
include '../app/conexion.php';
$conexion = conexion();
//Proporciona el nombre del servidor especificado en la configuración del host
$base_url = "HTTPS://" . $_SERVER['HTTP_HOST'] . "/sistemas/";
//Se obtiene la fecha y hora actual
$fecha_actual = date("d-m-Y", $time);
//Referencia a las variables definidas de forma global
$GLOBALS['fecharet'] = $GLOBALS['fecha_actual'];

?>

<div class="row" style="width: 1270px;">
    <div class="col-sm-12">
        <h2 class="h2Consultor">Mis últimos 100 trámites</h2>
        <!--Data-order ordenamiento de descendente a ascendente-->
        <table data-order='[[0, "desc"]]' class="table table-hover table-condensed table-bordered" id="tablaDinamicaLoadGmm">
            <caption>
            </caption>
            <thead>
                <tr>
                    <td class="tdCancelados">
                        <p><small>FOLIO GAM</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>TIPO DE SOLICITUD</small></p>
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
                        <p><small>N° PÓLIZA</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>PRIORIDAD</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>FECHA SOLICITUD</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>FOLIO GNP (OT)</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>FECHA INICIO</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>FECHA PROMESA</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>DÍAS DE RETARDO</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>ESTATUS TRAMITE</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>VER MÁS</small></p>
                    </td>
                </tr>
            </thead>
            <!-- Query muestra los folios del ramo gmm en estado cancelado -->
            <?php
            $sql = "SELECT * FROM folios_g WHERE estado = 'CANCELADO' ORDER BY id";
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
                            <small><?php echo $ver[0]; ?></small>
                        </span>
                    </td>

                    <!-- TIPO DE SOLICITUD  -->
                    <td align="center" width="80px"><small><?php echo "$ver[3]"; ?></small></td>

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
                    <td align="center" width="230px"><small><?php echo $ver[10]; ?></small></td>

                    <!-- NUMERO DE POLIZA  -->
                    <td align="center" width="15px"><small><?php echo $ver[5]; ?></small></td>

                    <!-- PRIORIDAD -->
                    <td align="center" width="100px"><small><?php echo $ver[12]; ?></small></td>

                    <!-- FECHA SOLICITUD -->
                    <td align="center" width="100px">
                        <small>
                            <?php
                            $fechap = $ver[1];
                            $fechap1 = new DateTime($fechap);
                            echo $fechap1->format("d-m-Y");
                            ?>
                        </small>
                    </td>

                    <!-- FOLIO GNP-->
                    <td align="center" width="120px"><small><?php echo $ver[6]; ?></small></td>

                    <!-- FECHA INICIO -->
                    <td align="center" width="150px">
                        <small>
                            <?php
                            if ($ver[14] == "CASO ESPECIAL" or $ver[14] == "PROCESO" or $ver[14] == "REPROCESO" or $ver[14] == "TERMINADO" or $ver[14] == "TERMINADO CON POLIZA"  or $ver[14] == "ACTIVADO MED" or $ver[14] == "ACTIVADO FLT" or $ver[14] == "ACTIVADO GNP") {

                                $sqlpr = "SELECT fechaest FROM promesa_g WHERE folio='$ver[0]'";
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

                            if ($ver[14] == 'ENVIADO' or $ver[14] == 'CANCELADO' or $ver[14] == 'RECHAZO DE SUSCRIPCION') { ?>
                                <small>***</small>

                            <?php } ?>

                            <small>
                                <?php

                                // Solicitud - ALTA POLIZA NACIONAL 

                                if ($ver[3] == 'ALTA POLIZA NACIONAL') {
                                    $sqlApolizaN = "SELECT * FROM producto_gmm WHERE producto = '$ver[4]' AND tipo_solicitud ='1'";
                                    $resultApolizaN = mysqli_query($conexion, $sqlApolizaN);

                                    while ($verProductoF = mysqli_fetch_row($resultApolizaN)) {

                                        $sqlPromesa = "SELECT fechaest FROM promesa_g WHERE folio = '$ver[0]'";
                                        $resultPromesaF = mysqli_query($conexion, $sqlPromesa);

                                        while ($verFecha = mysqli_fetch_row($resultPromesaF)) {
                                            $fecha = $verFecha[0]; // Fecha- Cambio de Estado
                                            $dias = $verProductoF[3]; // Dias promesa del producto 

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

                                            //Validamos fecha promesa y fecha actual para accionar el semaforo 
                                            if ($ver[14] == 'PROCESO' || $ver[14] == 'REPROCESO' || $ver[14] == 'ACTIVADO MED' || $ver[14] == 'ACTIVADO GNP' || $ver[14] == 'ACTIVADO FLT') {

                                                if ($fechaprom > $fechaactual) { ?>
                                                    <img src="img/ver.png" class="semaf||oV" />
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
                                    }
                                } // cierre - ALTA POLIZA NACIONAL


                                // Solicitud - ALTA POLIZA INTERNACION

                                if ($ver[3] == 'ALTA POLIZA INTERNACIONAL') {
                                    $sqlr = "SELECT * FROM producto_gmm WHERE producto='$ver[4]' AND tipo_solicitud='2'";
                                    $resr = mysqli_query($conexion, $sqlr);

                                    while ($verr = mysqli_fetch_row($resr)) {

                                        $sqlf = "SELECT fechaest FROM promesa_g WHERE folio='$ver[0]'";
                                        $resultf = mysqli_query($conexion, $sqlf);

                                        while ($verf = mysqli_fetch_row($resultf)) {
                                            $fecha = $verf[0];
                                            $dias = $verr[3];

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
                                            if ($ver[14] == 'PROCESO' || $ver[14] == 'REPROCESO' || $ver[14] == 'ACTIVADO MED' || $ver[14] == 'ACTIVADO GNP' || $ver[14] == 'ACTIVADO FLT') {

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
                                    }
                                } // cierre - ALTA POLIZA INTERNACIONAL 


                                // Solicitud - MOVIMIENTOS

                                if ($ver[3] == 'MOVIMIENTOS') {

                                    $sqlr = "SELECT * FROM producto_gmm WHERE producto='$ver[4]' AND tipo_solicitud='3'";
                                    $resr = mysqli_query($conexion, $sqlr);

                                    while ($verr = mysqli_fetch_row($resr)) {
                                        $sqlf = "SELECT fechaest FROM promesa_g WHERE folio='$ver[0]'";
                                        $resultf = mysqli_query($conexion, $sqlf);

                                        while ($verf = mysqli_fetch_row($resultf)) {
                                            $fecha = $verf[0]; //fecha del cambio de estado 
                                            $dias = $verr[3]; //dias de promesa para resolver tramite

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
                                            if ($ver[14] == 'PROCESO' || $ver[14] == 'REPROCESO' || $ver[14] == 'ACTIVADO MED' || $ver[14] == 'ACTIVADO GNP' || $ver[14] == 'ACTIVADO FLT') {

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
                                    }
                                } // cierre - MOVIMIENTOS


                                // Estado - CASO ESPECIAL  

                                // Query donde muestra la fecha promesa para gmm
                                $sqlf = "select fechaest from promesa_g where folio='$ver[0]'";
                                $resultf = mysqli_query($conexion, $sqlf);
                                while ($verf = mysqli_fetch_row($resultf)) {

                                    $fecha = $verf[0];
                                    $diasC = 7;

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
                                    //Inicializando el contador
                                    $i = 0;
                                    while ($i < $diasC) {
                                        //Se suma un dia a la fecha final (86400 segundos)
                                        $fecha_venci_noti += 86400;
                                        $es_feriado = FALSE;
                                        //Verifico si la fecha final actual es feriado o no
                                        foreach ($feriados as $key => $feriado) {
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

                                    $fechapromC = strtotime(date('d-m-Y', $fecha_venci_noti));
                                    $fechaprom1C = date('d-m-Y', $fecha_venci_noti);
                                    $time = time();
                                    $fechaactual = strtotime(date('d-m-Y', $time));

                                    // Valido si el estado es caso especial para activar el semaforo
                                    if ($ver[14] == 'CASO ESPECIAL') {
                                        if ($fechapromC > $fechaactual) { ?>
                                            <img src="img/ver.png" class="semaforoV" />
                                            &nbsp;
                                        <?php
                                            echo $fechaprom1C;
                                        } elseif ($fechapromC < $fechaactual) { ?>
                                            <img src="img/roj.png" class="semaforoR" />
                                            &nbsp;
                                        <?php
                                            echo $fechaprom1C;
                                        } elseif ($fechapromC = $fechaactual) { ?>
                                            <img src="img/ama.png" class="semaforoA" />
                                            &nbsp;
                                            <?php
                                            echo $fechaprom1C;
                                        }
                                    }
                                }


                                // Estado - TERMINADOS (semaforo y fecha promesa)

                                if ($ver[14] == 'TERMINADO' || $ver[14] == 'TERMINADO CON POLIZA') {

                                    $sqlTerminados = "SELECT cd_estado_g FROM cam_estado_g WHERE folio_g = '$ver[0]'";
                                    $resultadoT = mysqli_query($conexion, $sqlTerminados);

                                    while ($verCambioF = mysqli_fetch_row($resultadoT)) {
                                        $cambioEstado = $verCambioF[0]; // Fecha - Cambio de estado					
                                        $newDate2 = date("d-m-Y", strtotime($cambioEstado));
                                        $timestamp = strtotime($newDate2);

                                        // Consulta para saber el penultimo estado
                                        $sqlPenulE = "SELECT estado1 FROM comentarios_g WHERE folio = '$ver[0]' ORDER BY id DESC LIMIT 1,1";
                                        $resultadoPenulE = mysqli_query($conexion, $sqlPenulE);

                                        while ($verEstado = mysqli_fetch_row($resultadoPenulE)) {
                                            $penultimoE = $verEstado[0]; // Muestra el penultimo estado que se inserto 

                                            if (($penultimoE == 'CASO ESPECIAL') && ($ver[14] == 'TERMINADO' || $ver[14] == 'TERMINADO CON POLIZA')) {

                                                if ($fechapromC > $timestamp) { ?>
                                                    <img src="img/ver.png" class="semaforoV" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1C;
                                                } elseif ($fechapromC < $timestamp) { ?>
                                                    <img src="img/roj.png" class="semaforoR" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1C;
                                                } elseif ($fechapromC = $timestamp) { ?>
                                                    <img src="img/ama.png" class="semaforoA" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1C;
                                                }
                                                // Para los demás estados
                                            } else {

                                                if ($fechaprom > $timestamp) { ?>
                                                    <img src="img/ver.png" class="semaforoV" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1;
                                                } elseif ($fechaprom < $timestamp) { ?>
                                                    <img src="img/roj.png" class="semaforoR" />
                                                    &nbsp;
                                                <?php
                                                    echo $fechaprom1;
                                                } elseif ($fechaprom = $timestamp) { ?>
                                                    <img src="img/ama.png" class="semaforoA" />
                                                    &nbsp;
                                <?php
                                                    echo $fechaprom1;
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                            </small>
                        </b>
                    </td>

                    <!-- DIAS DE RETARDO -->
                    <td align="center" width="75px">
                        <small>

                            <?php

                            //SIN FECHA EL ESTADO DE ENVIADO Y CANCELADO NO OBTENDRA NINGUN RETARDO
                            if ($ver[14] == 'ENVIADO' or $ver[14] == 'CANCELADO' || $ver[14] == 'RECHAZO DE SUSCRIPCION') {
                                echo "***";
                            }

                            if ($ver[14] == 'CASO ESPECIAL') {

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
                                $startDate = (new DateTime($fechaprom1C));
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

                            if ($ver[14] == 'PROCESO' || $ver[14] == 'REPROCESO') {

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
                            if ($ver[14] == "TERMINADO" || $ver[14] == "TERMINADO CON POLIZA") {

                                $sqlpr = "select cd_estado_g from cam_estado_g where folio_g='$ver[0]'";
                                $resultpr = mysqli_query($conexion, $sqlpr);

                                while ($verpr = mysqli_fetch_row($resultpr)) {

                                    $datospr = $verpr[0]; //FECHA CAMBIO DE ESTADO

                                    // Consulta para saber el penultimo estado
                                    $sqlPenulE = "SELECT estado1 FROM comentarios_g WHERE folio = '$ver[0]' ORDER BY id DESC LIMIT 1,1";
                                    $resultadoPenulE = mysqli_query($conexion, $sqlPenulE);

                                    while ($verEstado = mysqli_fetch_row($resultadoPenulE)) {
                                        $penultimoE = $verEstado[0]; // Muestra el penultimo estado que se inserto 
                                        if (($penultimoE == 'CASO ESPECIAL') && ($ver[14] == 'TERMINADO' || $ver[14] == 'TERMINADO CON POLIZA')) {
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
                                            $startDate = (new DateTime($fechaprom1C));
                                            //Fecha final
                                            $endDate = (new DateTime($datospr))->modify('-1 day');
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

                                            if ($startDate > $endDate) {
                                                echo "Días: 0";
                                            } else {
                                                echo 'Días: ' . $workdays;
                                            }
                                        } else {
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
                                }
                            }

                            //ENTRAN TODOS LOS ACTIVADOS PARA LA CONDICION DE 20 DIAS
                            if ($ver[14] == 'ACTIVADO FLT' or $ver[14] == 'ACTIVADO MED' or $ver[14] == 'ACTIVADO GNP') {

                                $sqlpr = "select fechaest from promesa_g where folio='$ver[0]'";

                                $resultpr = mysqli_query($conexion, $sqlpr);
                                while ($verpr = mysqli_fetch_row($resultpr)) {

                                    $datosp = $verpr[0];

                                    $fechaActual = date("d-m-Y");
                                    $date1 = new DateTime($fechaActual); //fecha actual

                                    $date2 = new Datetime($datosp); //fecha cambio de estado - FECHA INICIO

                                    // Devolvera la diferencia entre las dos variables DateTime dadas
                                    $diff = $date1->diff($date2);

                                    $res = $diff = $diff->days . ' días '; //Diferencia de días

                                    if ($ver[3] == 'ALTA POLIZA NACIONAL' or $ver[3] == 'ALTA POLIZA INTERNACIONAL' or $ver[3] == 'MOVIMIENTOS') {

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
                                        //Periodo de fechas
                                        $date_range = new DatePeriod($startDate, $interval, $endDate); //creamos rango de fechas
                                        //Inicia el contador
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

                                    if ($res > 20) {

                                        $sql1 = "UPDATE folios_g set estado='CANCELADO' where id='$ver[0]'";
                                        $result = mysqli_query($conexion, $sql1);
                                    }
                                }

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

                                $dias = 20; //DIAS HABILES

                                //Timestam de Fecha de Comienzo
                                $comienzo = strtotime($datosp);

                                //Inicializo la fecha final
                                $fecha_venci_noti = $comienzo;

                                //Inicializo el contador
                                $i = 0;

                                while ($i < $dias) {  //WHILE 2

                                    //Le sumo un dia a la fecha final (86400 segundos)
                                    $fecha_venci_noti += 86400;

                                    //Inicializo a FALSE la variable para saber si es Feriado
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
                                    if (!(date("w", $fecha_venci_noti) == 6 or date("w", $fecha_venci_noti) == 0 or  $es_feriado)) {

                                        //En caso de no ser Sabado, Domingo o Feriado aumentamos el contador
                                        $i++;
                                    }
                                }
                            }

                            ?>

                        </small>
                    </td>

                    <!-- ESTATUS DEL TRAMITE  -->
                    <td align="center" width="70px"><small><?php echo $ver[14]; ?></small></td>

                    <!-- VER SEGUIMIENTO  -->
                    <td align="center" width="50px">
                        <button class="btn btn-link glyphicon glyphicon-retweet " data-toggle="modal" data-target="#modalUpload_g" onclick="reactivar_g('<?php echo $datos ?>')"></button>
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
            $('#tablaDinamicaLoadGmm').DataTable({
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