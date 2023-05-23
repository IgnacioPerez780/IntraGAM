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
<div class="row">
    <div class="col-sm-12">
        <h2>Mis Trámites Cancelados</h2>
        <table class="table table-hover table-condensed table-bordered" id="tablaDinamicaLoad">
            <!--Data-order ordenamiento de descendente a ascendente-->
            <caption>

            </caption>
            <thead>
                <tr>
                    <td class="tdCancelados">
                        <p><small>FOLIO GAM</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>TIPO SOLICITUD</small></p>
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
                        <p><small>ESTATUS TRÁMITE</small></p>
                    </td>
                    <td class="tdCancelados">
                        <p><small>ACTIVAR</small></p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <!--Query muestra los folios del ramo vida con estatus de estado cancelado-->
                <?php
                $sql = "SELECT * FROM folios WHERE id > 20000 AND estado = 'CANCELADO' ORDER BY id DESC";
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
                        $ver[16] . "||" .
                        $ver[17] . "||" .
                        $ver[18];
                ?>
                    <tr>
                        <td align="center" width="30px"><span span style="font-weight:bold;"><small><?php echo $ver[0]; ?></small></td>
                        <!--FOLIO-->

                        <td align="center" width="80px"><span><small><?php echo $ver[3]; ?></small></span></td>
                        <!--TIPO DE SOLICITUD-->

                        <td align="center" width="150px"><span>
                                <!--AGENTE-->
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
                            </span>
                        </td>
                        <td align="center" width="150px"><span><small><?php echo $ver[11]; ?></small></span></td>
                        <!--CONTRATANTE-->

                        <td align="center" width="90px"><span>

                                <!--CAMBIO ANEXADO PARA VISUALIZAR LA POLIZA QUE SE INGRESO EN EL CAMPO CORRESPONDIENTE DE CADA SOLICITUD-->
                                <small>
                                    <?php
                                    if ($ver[3] == "MOVIMIENTOS") {

                                        echo  $ver[8];
                                    }
                                    if ($ver[3] == "ALTA DE POLIZA" || $ver[3] == "PAGOS") {

                                        echo  $ver[17];
                                    }

                                    ?>

                                </small>
                            </span>
                        </td>

                        </td>
                        <!--POLIZA-->

                        <td align="center" width="50px"><span>
                                <!--FECHA SOLICITUD-->
                                <small>
                                    <?php
                                    $fechap = $ver[1];
                                    $fechap1 = new DateTime($fechap);
                                    echo $fechap1->format("d-m-Y");
                                    ?>
                                </small>
                            </span>
                        </td>


                        <td align="center" width="80px"><span><small><?php echo $ver[16]; ?></small></span></td>
                        <!--FOLIO GNP-->


                        <td align="center" width="80px"><span>
                                <!--FECHA INICIO-->

                                <small>
                                    <?php
                                    if ($ver[14] == "PROCESO" or $ver[14] == "REPROCESO") {

                                        $sqlpr = "select fechaest from promesa where folio='$ver[0]'";
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
                            </span>
                        </td>

                        <td align="center" width="90px"><span><b>
                                    <!--FECHA PROMESA-->
                                    <?php

                                    if ($ver[3] == 'PAGOS' or $ver[3] == 'ALTA DE POLIZA' or $ver[3] == 'MOVIMIENTOS') {
                                        if ($ver[14] == 'TERMINADO' or $ver[14] == 'TERMINADO CON POLIZA') { ?>

                                            <small>***</small>
                                        <?php
                                        }
                                    }

                                    if ($ver[3] == 'PAGOS' or $ver[3] == 'ALTA DE POLIZA' or $ver[3] == 'MOVIMIENTOS') {
                                        if ($ver[14] == "ACTIVADO MED" or $ver[14] == "ACTIVADO FLT" or $ver[14] == "ACTIVADO GNP") { ?>

                                            <small>***</small>
                                        <?php
                                        }
                                    }

                                    if ($ver[3] == 'PAGOS') {
                                        if ($ver[14] == 'CANCELADO' or $ver[14] == 'ENVIADO') { ?>
                                            <small>***</small>
                                        <?php
                                        } else { ?>
                                            <small>
                                                <?php
                                                $sqlf = "select fechaest from promesa where folio='$ver[0]'";
                                                $resultf = mysqli_query($conexion, $sqlf);

                                                while ($verf = mysqli_fetch_row($resultf)) {
                                                    $datosf = $verf[0];


                                                    $fecha = $verf[0];
                                                    $dias = 1;

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

                                                    $comienzo = strtotime($fecha);
                                                    $fecha_venci_noti = $comienzo;

                                                    $i = 0;

                                                    while ($i < $dias) {
                                                        $fecha_venci_noti += 86400;

                                                        $es_feriado = FALSE;

                                                        foreach ($feriados as $key => $feriado) {
                                                            if (date("Y-m-d", $fecha_venci_noti) === date("Y-m-d", strtotime($feriado))) {
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

                                                    if ($ver[14] == 'PROCESO' or $ver[14] == 'REPROCESO') {


                                                        if ($fechaprom > $fechaactual) { ?>
                                                            <img src="img/ver.png" />
                                                            &nbsp;
                                                        <?php
                                                            echo $fechaprom1;
                                                        } else if ($fechaprom < $fechaactual) { ?>
                                                            <img src="img/roj.png" />
                                                            &nbsp;
                                                        <?php
                                                            echo $fechaprom1;
                                                        } else if ($fechaprom = $fechaactual) { ?>
                                                            <img src="img/ama.png" />
                                                            &nbsp;
                                                <?php
                                                            echo $fechaprom1;
                                                        }
                                                    }
                                                }
                                                ?>
                                            </small>

                                        <?php
                                        }
                                    } //CIERRE IF PAGOS

                                    if ($ver[3] == 'ALTA DE POLIZA') {

                                        $sqlr = "select * from rango where tiporan='$ver[5]'";
                                        $resr = mysqli_query($conexion, $sqlr);

                                        if ($ver[14] == 'CANCELADO' or $ver[14] == 'ENVIADO') { ?>
                                            <small>***</small>

                                            <?php

                                            //CIERRE DE LA CONDICION CANCELADO Y ENVIADO

                                        } else { //ELSE 1

                                            while ($verr = mysqli_fetch_row($resr)) { //WHILE 1
                                                $d_promesar = $verr[2];
                                            ?>

                                                <b><small>
                                                        <?php
                                                        $sqlf = "select fechaest from promesa where folio='$ver[0]'"; //FECHA DEL CAMBIO DE ESTADO
                                                        $resultf = mysqli_query($conexion, $sqlf);

                                                        while ($verf = mysqli_fetch_row($resultf)) { //WHILE 2
                                                            $datosf = $verf[0];


                                                            $fecha = $verf[0];
                                                            $dias = $verr[2];

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

                                                            $comienzo = strtotime($fecha);
                                                            $fecha_venci_noti = $comienzo;

                                                            $i = 0;

                                                            while ($i < $dias) { //WHILE 3
                                                                $fecha_venci_noti += 86400;

                                                                $es_feriado = FALSE;

                                                                foreach ($feriados as $key => $feriado) { //FOREACH
                                                                    if (date("Y-m-d", $fecha_venci_noti) === date("Y-m-d", strtotime($feriado))) {
                                                                        $es_feriado = TRUE;
                                                                    }
                                                                } //CIERRE FOREACH

                                                                if (!(date("w", $fecha_venci_noti) == 6 || date("w", $fecha_venci_noti) == 0 || $es_feriado)) {
                                                                    $i++;
                                                                }
                                                            } //CIERRE WHILE 3




                                                            $fechaprom = strtotime(date('d-m-Y', $fecha_venci_noti));
                                                            $fechaprom1 = date('d-m-Y', $fecha_venci_noti);

                                                            $time = time();
                                                            $fechaactual = strtotime(date('d-m-Y', $time));


                                                            if ($ver[14] == 'PROCESO' or $ver[14] == 'REPROCESO') {

                                                                if ($fechaprom > $fechaactual) { ?>
                                                                    <img src="img/ver.png" />
                                                                    &nbsp;
                                                                <?php
                                                                    echo $fechaprom1;
                                                                } else if ($fechaprom < $fechaactual) { ?>
                                                                    <img src="img/roj.png" />
                                                                    &nbsp;
                                                                <?php
                                                                    echo $fechaprom1;
                                                                } else if ($fechaprom = $fechaactual) { ?>
                                                                    <img src="img/ama.png" />
                                                                    &nbsp;
                                                        <?php
                                                                    echo $fechaprom1;
                                                                }
                                                            }
                                                        } //CIERRE WHILE 2
                                                        ?>
                                                    </small></b>
                                            <?php

                                            } //CIERRE WHILE 1
                                        } //CIERRE ELSE 1

                                    } //CIERRE IF ALTA POLIZA

                                    if ($ver[3] == 'MOVIMIENTOS') {

                                        $sqlr = "select * from producto where producto='$ver[9]'";
                                        $resr = mysqli_query($conexion, $sqlr);


                                        if ($ver[14] == 'CANCELADO' or $ver[14] == 'ENVIADO') { ?>
                                            <small>***</small>

                                            <?php

                                            //CIERRE DE LA CONDICION CANCELADO Y ENVIADO

                                        } else { //ELSE 1

                                            while ($verr = mysqli_fetch_row($resr)) { //WHILE 1

                                            ?>

                                                <b><small>
                                                        <?php
                                                        $sqlf = "select fechaest from promesa where folio='$ver[0]'"; //FECHA DEL CAMBIO DE ESTADO PARA PROCESO Y REPROCESO
                                                        $resultf = mysqli_query($conexion, $sqlf);

                                                        while ($verf = mysqli_fetch_row($resultf)) { //WHILE 2

                                                            $fecha = $verf[0]; //fecha del cambio de estado proceso y reproceso

                                                            $dias = $verr[3]; //dias de promesa para resolver tramite


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

                                                            $comienzo = strtotime($fecha);

                                                            $fecha_venci_noti = $comienzo;


                                                            //Inicializo el contador
                                                            $i = 0;

                                                            while ($i < $dias) { //WHILE 3


                                                                $fecha_venci_noti += 86400;


                                                                $es_feriado = FALSE;


                                                                foreach ($feriados as $key => $feriado) { //FOREACH
                                                                    if (date("Y-m-d", $fecha_venci_noti) === date("Y-m-d", strtotime($feriado))) {

                                                                        $es_feriado = TRUE;
                                                                    }
                                                                } //CIERRE FOREACH


                                                                if (!(date("w", $fecha_venci_noti) == 6 || date("w", $fecha_venci_noti) == 0 || $es_feriado)) {
                                                                    $i++;
                                                                }
                                                            } //CIERRE WHILE 3


                                                            $fechaprom = strtotime(date('d-m-Y', $fecha_venci_noti));

                                                            $fechaprom1 = date('d-m-Y', $fecha_venci_noti);


                                                            $time = time();

                                                            $fechaactual = strtotime(date('d-m-Y', $time));


                                                            if ($ver[14] == 'PROCESO' or $ver[14] == 'REPROCESO') {

                                                                if ($fechaprom > $fechaactual) { ?>
                                                                    <img src="img/ver.png" />
                                                                    &nbsp;
                                                                <?php
                                                                    echo $fechaprom1;
                                                                } else if ($fechaprom < $fechaactual) { ?>
                                                                    <img src="img/roj.png" />
                                                                    &nbsp;
                                                                <?php
                                                                    echo $fechaprom1;
                                                                } else if ($fechaprom = $fechaactual) { ?>
                                                                    <img src="img/ama.png" />
                                                                    &nbsp;
                                                        <?php
                                                                    echo $fechaprom1;
                                                                }
                                                            }
                                                        } //CIERRE WHILE 2
                                                        ?>
                                                    </small></b>
                                    <?php

                                            } //CIERRE WHILE 1




                                        } //CIERRE ELSE 1

                                    } //CIERRE IF MOVIMIENTOS
                                    ?>
                                </b>
                            </span>
                        </td>



                        <td align="center" width="40px"><span>
                                <!--RETARDO DE DIAS -->

                                <small>

                                    <?php

                                    //SIN FECHA EL ESTADO DE ENVIADO Y CANCELADO NO OBTENDRA NINGUN RETARDO
                                    if ($ver[14] == 'ENVIADO' or $ver[14] == 'CANCELADO') {

                                        echo "***";
                                    }


                                    if ($ver[14] == 'PROCESO' or $ver[14] == 'REPROCESO') {


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

                                    //CONGELA LOS DÍAS DE DIFERENCIA ENTRE DOS DÍAS
                                    if ($ver[14] == "TERMINADO" or $ver[14] == "TERMINADO CON POLIZA") {

                                        $sqlpr = "select cd_estado from cam_estado where folio='$ver[0]'";
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

                                            $endDate = (new DateTime($datospr))->modify('-1 day');

                                            $interval = new DateInterval('P1D');

                                            $date_range = new DatePeriod($startDate, $interval, $endDate); //creamos rango de fechas

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
                                    } //CIERRE IF CONDICIONES TERMINADO O TERMINADO CON POLIZA


                                    //ENTRAN TODOS LOS ACTIVADOS PARA LA CONDICION DE 10 DIAS

                                    if ($ver[14] == 'ACTIVADO FLT' or $ver[14] == 'ACTIVADO MED' or $ver[14] == 'ACTIVADO GNP') { //IF 1

                                        $sqlpr = "select fechaest from promesa where folio='$ver[0]'";

                                        $resultpr = mysqli_query($conexion, $sqlpr);
                                        while ($verpr = mysqli_fetch_row($resultpr)) { //WHILE 1

                                            $datosp = $verpr[0];

                                            $fechaActual = date("d-m-Y");
                                            $date1 = new DateTime($fechaActual); //fecha actual

                                            $date2 = new Datetime($datosp); //fecha cambio de estado - FECHA INICIO

                                            $diff = $date1->diff($date2);

                                            $res = $diff = $diff->days . ' días '; //Diferencia de días

                                            if ($ver[3] == 'PAGOS' or $ver[3] == 'ALTA DE POLIZA' or $ver[3] == 'MOVIMIENTOS') {

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

                                            if ($res > 10) {

                                                $sql1 = "UPDATE folios set estado='CANCELADO' where id='$ver[0]'";

                                                $result = mysqli_query($conexion, $sql1);
                                            }
                                        } //CIERRE DEL WHILE 1


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

                                        $dias = 10; //DIAS HABILES

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
                                    }   //CIERRE IF 1

                                    //DIAS DE RETARDO ENTRE FECHA PROMESA Y FECHA ACTUAL

                                    ?>

                                </small>
                            </span>
                        </td>

                        <td style="text-align:left;" width="130px"><span>
                                <!--ESTADO-->

                                <?php
                                if ($ver[14] == 'CANCELADO') { ?>
                                    <img src="img/Cancelado.png" width="43" height="43" />
                                    <small><b>Cancelado</b></small>
                                <?php
                                }
                                if ($ver[14] == 'ACTIVADO FLT') { ?>
                                    <img src="img/Activado FLT.png" width="43" height="43" />
                                    <small><b>ACT FLT</b></small>
                                <?php
                                }
                                if ($ver[14] == 'ACTIVADO GNP') { ?>
                                    <img src="img/Activado GNP.png" width="43" height="43" />
                                    <small><b>ACT GNP</b></small>
                                <?php
                                }
                                if ($ver[14] == 'ACTIVADO MED') { ?>
                                    <img src="img/med.png" width="43" height="43" />
                                    <small><b>ACT MED</b></small>
                                <?php
                                }
                                if ($ver[14] == 'PROCESO') { ?>
                                    <img src="img/Procesos.png" width="43" height="43" />
                                    <small><b>Proceso</b></small>
                                <?php
                                }
                                if ($ver[14] == 'REPROCESO') { ?>
                                    <img src="img/Reproceso.png" width="43" height="43" />
                                    <small><b>Reproceso</b></small>
                                <?php
                                }
                                if ($ver[14] == 'ENVIADO') { ?>
                                    <img src="img/enviado.png" width="43" height="43" />
                                    <small><b>Enviado</b></small>
                                <?php
                                }
                                if ($ver[14] == 'TERMINADO') { ?>
                                    <img src="img/Terminado.png" width="43" height="43" />
                                    <small><b>Terminado</b></small>
                                <?php
                                }
                                if ($ver[14] == 'TERMINADO CON POLIZA') { ?>
                                    <img src="img/tp.png" width="43" height="43" />
                                    <small><b>Terminado / P</b></small>
                                <?php
                                }
                                ?>
                            </span>
                        </td>
                        <td align="center" width="50px">
                            <button class="btn btn-link glyphicon glyphicon-retweet " data-toggle="modal" data-target="#modalUpload" onclick="reactivar('<?php echo $datos ?>')"></button>
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
                "order": [[0, 'desc']],
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