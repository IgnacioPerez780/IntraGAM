<?php

error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();

//$consulta = $_POST['consulta'];
//$solicitud = $_POST['solicitud'];
$poliza = $_POST['poliza'];
$asegurado = $_POST['asegurado'];

session_start();
if (isset($_POST['poliza'])) {
    $_SESSION["poliza"] = $poliza;
}

if (isset($_POST['asegurado'])) {
    $_SESSION["asegurado"] = $asegurado;
}


//$estatus = $_POST['estatus'];

//echo "Resultados de la busqueda de la consulta ".$poliza." solicitada";

?>


<div class="row" style="width: 1245px;">
    <div class="col-sm-12">
        <h2 class="h2Vida">Consulta de Trámites</h2>
        <!--Data-order ordenamiento de descendente a ascendente-->
        <table class="table table-hover table-condensed table-bordered" id="tablaDinamicaLoadVida">
            <caption>
                <!--<button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                    Generar Trámite
                    <span class="glyphicon glyphicon-plus"></span>
                </button>-->
            </caption>
            <thead>
                <tr>
                    <td class="tdFoliosv">
                        <p><small>FOLIO GAM</small></p>
                    </td>

                    <td class="tdFoliosv">
                        <p><small>GDD</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>TIPO SOLICITUD</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>NOMBRE DEL AGENTE</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>NOMBRE DEL CONTRATANTE</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>N° PÓLIZA</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>FECHA SOLICITUD</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>FOLIO GNP (OT)</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>FECHA INICIO</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>FECHA PROMESA</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>DÍAS DE RETARDO</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>ESTATUS TRÁMITE</small></p>
                    </td>
                    <td class="tdFoliosv">
                        <p><small>VER MÁS</small></p>
                    </td>

                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($poliza)) {

                    $sql = "SELECT * FROM folios WHERE contratante like '%$asegurado%'";
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
                            <!--FOLIO-->
                            <td width="30px"><span style="font-weight:bold;"><small><?php echo $ver[0]; ?></small></span></td>

                            <!--GDD-->
                            <td width="40px">
                                <span>
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
                                </span>
                            </td>

                            <!--TIPO DE SOLICITUD-->
                            <td width="80px"><span><small><?php echo $ver[3]; ?></small></td>

                            <!--AGENTE-->
                            <td width="150px">
                                <span>

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
                            <!--CONTRATANTE-->
                            <td width="150px"><span><small><?php echo $ver[11]; ?></small></span></td>

                            <!--CAMBIO ANEXADO PARA VISUALIZAR LA POLIZA QUE SE INGRESO EN EL CAMPO CORRESPONDIENTE DE CADA SOLICITUD-->
                            <td width="90px">
                                <span>
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

                            <!--FECHA SOLICITUD-->
                            <td width="80px">
                                <span>
                                    <small>
                                        <?php
                                        $fechap = $ver[1];
                                        $fechap1 = new DateTime($fechap);
                                        echo $fechap1->format("d-m-Y");
                                        ?>
                                    </small>
                                </span>
                            </td>

                            <!--FOLIO GNP-->
                            <td width="80px"><span><small><?php echo $ver[16]; ?></small></span></td>


                            <!--FECHA INICIO-->
                            <td width="80px">
                                <span>
                                    <small>
                                        <?php
                                        if ($ver[14] == "PROCESO" or $ver[14] == "REPROCESO" or $ver[14] == "TERMINADO" or $ver[14] == "TERMINADO CON POLIZA"  or $ver[14] == "ACTIVADO MED" or $ver[14] == "ACTIVADO FLT" or $ver[14] == "ACTIVADO GNP") {

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

                            <!--FECHA PROMESA-->
                            <td width="90px">
                                <span>
                                    <b>

                                        <?php

                                        //if ($ver[3] == 'PAGOS' or $ver[3] == 'ALTA DE POLIZA' or $ver[3] == 'MOVIMIENTOS') {
                                        //if ($ver[14] == 'TERMINADO' or $ver[14] == 'TERMINADO CON POLIZA') { 
                                        ?>

                                        <!-- <small>***</small> -->
                                        <?php
                                        // }
                                        //}

                                        //if ($ver[3] == 'PAGOS' or $ver[3] == 'ALTA DE POLIZA' or $ver[3] == 'MOVIMIENTOS') {
                                        //if ($ver[14] == "ACTIVADO MED" or $ver[14] == "ACTIVADO FLT" or $ver[14] == "ACTIVADO GNP") { 
                                        ?>

                                        <!-- <small>***</small> -->
                                        <?php
                                        // }
                                        // }

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

                                                        if ($ver[14] == 'PROCESO' or $ver[14] == 'REPROCESO' or $ver[14] == 'ACTIVADO MED' or $ver[14] == 'ACTIVADO GNP' or $ver[14] == 'ACTIVADO FLT') {

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
                                                        ?>
                                                    <?php
                                                    } //cierre while 
                                                    ?>
                                                </small>
                                            <?php
                                            } //cierre else
                                            ?>

                                            <!-- Agrego para que el semaforo no cambie si esta en estas condiciones -->
                                            <small>
                                                <?php
                                                $consulta = "select cd_estado from cam_estado where folio='$ver[0]'";
                                                $resultado = mysqli_query($conexion, $consulta);

                                                while ($verfecha = mysqli_fetch_row($resultado)) {
                                                    $datosfecha = $verfecha[0]; //cambio de estado
                                                    $fechap = strtotime(date("d-m-Y", strtotime($datosfecha))); //formateo de la fecha cambio de estado

                                                    if ($ver[14] == "TERMINADO") { //condiciones

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
                                                ?>
                                            </small>

                                        <?php
                                        } //cierre pagos
                                        ?>

                                        <?php
                                        if ($ver[3] == 'ALTA DE POLIZA') {

                                            $sqlr = "select * from rango where tiporan='$ver[5]'";
                                            $resr = mysqli_query($conexion, $sqlr);

                                            if ($ver[14] == 'CANCELADO' or $ver[14] == 'ENVIADO') { ?>
                                                <small>***</small>

                                                <?php

                                            } else {

                                                while ($verr = mysqli_fetch_row($resr)) {
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

                                                                if ($ver[14] == 'PROCESO' or $ver[14] == 'REPROCESO' or $ver[14] == 'ACTIVADO MED' or $ver[14] == 'ACTIVADO GNP' or $ver[14] == 'ACTIVADO FLT') {

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
                                                        </small></b>
                                            <?php

                                                } //cierre while
                                            } //cierre else

                                            ?>

                                            <!-- Agrego para que el semaforo no cambie si esta en estas condiciones -->

                                            <small>
                                                <?php

                                                $consulta = "select cd_estado from cam_estado where folio='$ver[0]'";
                                                $resultado = mysqli_query($conexion, $consulta);

                                                while ($verfecha = mysqli_fetch_row($resultado)) {
                                                    $datosfecha = $verfecha[0]; //cambio de estado
                                                    $fechap = strtotime(date("d-m-Y", strtotime($datosfecha))); //formateo de la fecha cambio de estado

                                                    if ($ver[14] == "TERMINADO CON POLIZA" or $ver[14] == "TERMINADO") { //condiciones

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
                                                ?>
                                            </small>

                                        <?php

                                        } //cierre de alta poliza
                                        ?>

                                        <?php
                                        if ($ver[3] == 'MOVIMIENTOS') {

                                            $sqlr = "select * from producto where producto='$ver[9]'";
                                            $resr = mysqli_query($conexion, $sqlr);

                                            if ($ver[14] == 'CANCELADO' or $ver[14] == 'ENVIADO') { ?>
                                                <small>***</small>

                                                <?php

                                            } else {

                                                while ($verr = mysqli_fetch_row($resr)) {

                                                ?>
                                                    <b><small>
                                                            <?php
                                                            $sqlf = "select fechaest from promesa where folio='$ver[0]'"; //FECHA DEL CAMBIO DE ESTADO PARA PROCESO Y REPROCESO
                                                            $resultf = mysqli_query($conexion, $sqlf);

                                                            while ($verf = mysqli_fetch_row($resultf)) {

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
                                                                );

                                                                $comienzo = strtotime($fecha);
                                                                $fecha_venci_noti = $comienzo;

                                                                //Inicializo el contador
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

                                                                if ($ver[14] == 'PROCESO' or $ver[14] == 'REPROCESO' or $ver[14] == 'ACTIVADO MED' or $ver[14] == 'ACTIVADO GNP' or $ver[14] == 'ACTIVADO FLT') {

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
                                                        </small></b>
                                            <?php
                                                } //cierre while 
                                            } //cierre else

                                            ?>
                                            <!-- Agrego para que el semaforo no cambie si esta en estas condiciones -->

                                            <small>
                                                <?php

                                                $consulta = "select cd_estado from cam_estado where folio='$ver[0]'";
                                                $resultado = mysqli_query($conexion, $consulta);

                                                while ($verfecha = mysqli_fetch_row($resultado)) {
                                                    $datosfecha = $verfecha[0]; //cambio de estado
                                                    $fechap = strtotime(date("d-m-Y", strtotime($datosfecha))); //reseteo de la fecha de cambio de estado

                                                    if ($ver[14] == 'TERMINADO') { //condiciones

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
                                                ?>
                                            </small>

                                        <?php
                                        } //cierre movimientos

                                        ?>
                                    </b>
                                </span>
                            </td>

                            <!--RETARDO DE DIAS -->
                            <td width="40px">
                                <span>

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

                                                if ($res > 20) {

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
                                        }   //CIERRE IF 1

                                        //DIAS DE RETARDO ENTRE FECHA PROMESA Y FECHA ACTUAL

                                        ?>
                                    </small>
                                </span>
                            </td>

                            <!--ESTADO-->
                            <td style="text-align:left;" width="130px">
                                <span>

                                    <?php
                                    if ($ver[14] == 'CANCELADO') { ?>
                                        <img src="img/Cancelado.png" width="43" height="43" />
                                        <small><b>CANCELADO</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'ACTIVADO FLT') { ?>
                                        <img src="img/Act_Flt.png" width="43" height="43" />
                                        <small><b>ACT. FLT</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'ACTIVADO GNP') { ?>
                                        <img src="img/Act_GNP.png" width="43" height="43" />
                                        <small><b>ACT. GNP</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'ACTIVADO MED') { ?>
                                        <img src="img/Act_Med.png" width="43" height="43" />
                                        <small><b>ACT. MED</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'PROCESO') { ?>
                                        <img src="img/Proceso.png" width="43" height="43" />
                                        <small><b>PROCESO</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'REPROCESO') { ?>
                                        <img src="img/Reproceso.png" width="43" height="43" />
                                        <small><b>REPROCESO</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'ENVIADO') { ?>
                                        <img src="img/enviado.png" width="43" height="43" />
                                        <small><b>ENVIADO</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'TERMINADO') { ?>
                                        <img src="img/Terminado.png" width="43" height="43" />
                                        <small><b>TERMINADO</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'TERMINADO CON POLIZA') { ?>
                                        <img src="img/Terminado_p.png" width="45" height="45" />
                                        <small><b>TERMINADO/P</b></small>
                                    <?php
                                    }
                                    ?>
                                </span>
                            </td>
                            <td width="50px">
                                <form class="" action="seguimiento_colab.php?id=<?php echo $ver[0]; ?>" method="post">
                                    <button class="btn btn-link glyphicon glyphicon-search" value="<?php echo $ver[0]; ?>" id="id" name="id"></button>
                                    <!--DETALLES-->
                                </form>

                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    $sql = "SELECT * FROM folios WHERE id LIKE '%$poliza%' and contratante like '%$asegurado%'";
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
                            <!--FOLIO-->
                            <td width="30px"><span><small><?php echo $ver[0]; ?></small></span></td>

                            <!--GDD-->
                            <td width="40px">
                                <span>
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
                                </span>
                            </td>
                            <!--TIPO DE SOLICITUD-->
                            <td width="80px"><span><small><?php echo $ver[3]; ?></small></span></td>

                            <!--AGENTE-->
                            <td width="150px">
                                <span>
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
                            <!--CONTRATANTE-->
                            <td width="150px"><span><small><?php echo $ver[11]; ?></small></span></td>

                            <!--CAMBIO ANEXADO PARA VISUALIZAR LA POLIZA QUE SE INGRESO EN EL CAMPO CORRESPONDIENTE DE CADA SOLICITUD-->
                            <td width="90px">
                                <span>
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

                            <!--FECHA SOLICITUD-->
                            <td width="80px">
                                <span>
                                    <small>
                                        <?php
                                        $fechap = $ver[1];
                                        $fechap1 = new DateTime($fechap);
                                        echo $fechap1->format("d-m-Y");
                                        ?>
                                    </small>
                                </span>
                            </td>

                            <!--FOLIO GNP-->
                            <td width="80px"><span><small><?php echo $ver[16]; ?></small></span></td>


                            <!--FECHA INICIO-->
                            <td width="80px">
                                <span>
                                    <small>
                                        <?php
                                        if ($ver[14] == "PROCESO" or $ver[14] == "REPROCESO" or $ver[14] == "TERMINADO" or $ver[14] == "TERMINADO CON POLIZA"  or $ver[14] == "ACTIVADO MED" or $ver[14] == "ACTIVADO FLT" or $ver[14] == "ACTIVADO GNP") {

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

                            <!--FECHA PROMESA-->
                            <td width="90px">
                                <span>
                                    <b>

                                        <?php

                                        //if ($ver[3] == 'PAGOS' or $ver[3] == 'ALTA DE POLIZA' or $ver[3] == 'MOVIMIENTOS') {
                                        //if ($ver[14] == 'TERMINADO' or $ver[14] == 'TERMINADO CON POLIZA') { 
                                        ?>

                                        <!-- <small>***</small> -->
                                        <?php
                                        // }
                                        //}

                                        //if ($ver[3] == 'PAGOS' or $ver[3] == 'ALTA DE POLIZA' or $ver[3] == 'MOVIMIENTOS') {
                                        //if ($ver[14] == "ACTIVADO MED" or $ver[14] == "ACTIVADO FLT" or $ver[14] == "ACTIVADO GNP") { 
                                        ?>

                                        <!-- <small>***</small> -->
                                        <?php
                                        // }
                                        // }

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

                                                        if ($ver[14] == 'PROCESO' or $ver[14] == 'REPROCESO' or $ver[14] == 'ACTIVADO MED' or $ver[14] == 'ACTIVADO GNP' or $ver[14] == 'ACTIVADO FLT') {

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
                                                        ?>
                                                    <?php
                                                    } //cierre while 
                                                    ?>
                                                </small>
                                            <?php
                                            } //cierre else
                                            ?>

                                            <!-- Agrego para que el semaforo no cambie si esta en estas condiciones -->
                                            <small>
                                                <?php
                                                $consulta = "select cd_estado from cam_estado where folio='$ver[0]'";
                                                $resultado = mysqli_query($conexion, $consulta);

                                                while ($verfecha = mysqli_fetch_row($resultado)) {
                                                    $datosfecha = $verfecha[0]; //cambio de estado
                                                    $fechap = strtotime(date("d-m-Y", strtotime($datosfecha))); //formateo de la fecha cambio de estado

                                                    if ($ver[14] == "TERMINADO") { //condiciones

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
                                                ?>
                                            </small>

                                        <?php
                                        } //cierre pagos
                                        ?>

                                        <?php
                                        if ($ver[3] == 'ALTA DE POLIZA') {

                                            $sqlr = "select * from rango where tiporan='$ver[5]'";
                                            $resr = mysqli_query($conexion, $sqlr);

                                            if ($ver[14] == 'CANCELADO' or $ver[14] == 'ENVIADO') { ?>
                                                <small>***</small>

                                                <?php

                                            } else {

                                                while ($verr = mysqli_fetch_row($resr)) {
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

                                                                if ($ver[14] == 'PROCESO' or $ver[14] == 'REPROCESO' or $ver[14] == 'ACTIVADO MED' or $ver[14] == 'ACTIVADO GNP' or $ver[14] == 'ACTIVADO FLT') {

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
                                                        </small></b>
                                            <?php

                                                } //cierre while
                                            } //cierre else

                                            ?>

                                            <!-- Agrego para que el semaforo no cambie si esta en estas condiciones -->

                                            <small>
                                                <?php

                                                $consulta = "select cd_estado from cam_estado where folio='$ver[0]'";
                                                $resultado = mysqli_query($conexion, $consulta);

                                                while ($verfecha = mysqli_fetch_row($resultado)) {
                                                    $datosfecha = $verfecha[0]; //cambio de estado
                                                    $fechap = strtotime(date("d-m-Y", strtotime($datosfecha))); //formateo de la fecha cambio de estado

                                                    if ($ver[14] == "TERMINADO CON POLIZA" or $ver[14] == "TERMINADO") { //condiciones

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
                                                ?>
                                            </small>

                                        <?php

                                        } //cierre de alta poliza
                                        ?>

                                        <?php
                                        if ($ver[3] == 'MOVIMIENTOS') {

                                            $sqlr = "select * from producto where producto='$ver[9]'";
                                            $resr = mysqli_query($conexion, $sqlr);

                                            if ($ver[14] == 'CANCELADO' or $ver[14] == 'ENVIADO') { ?>
                                                <small>***</small>

                                                <?php

                                            } else {

                                                while ($verr = mysqli_fetch_row($resr)) {

                                                ?>
                                                    <b><small>
                                                            <?php
                                                            $sqlf = "select fechaest from promesa where folio='$ver[0]'"; //FECHA DEL CAMBIO DE ESTADO PARA PROCESO Y REPROCESO
                                                            $resultf = mysqli_query($conexion, $sqlf);

                                                            while ($verf = mysqli_fetch_row($resultf)) {

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
                                                                );

                                                                $comienzo = strtotime($fecha);
                                                                $fecha_venci_noti = $comienzo;

                                                                //Inicializo el contador
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

                                                                if ($ver[14] == 'PROCESO' or $ver[14] == 'REPROCESO' or $ver[14] == 'ACTIVADO MED' or $ver[14] == 'ACTIVADO GNP' or $ver[14] == 'ACTIVADO FLT') {

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
                                                        </small></b>
                                            <?php
                                                } //cierre while 
                                            } //cierre else

                                            ?>
                                            <!-- Agrego para que el semaforo no cambie si esta en estas condiciones -->

                                            <small>
                                                <?php

                                                $consulta = "select cd_estado from cam_estado where folio='$ver[0]'";
                                                $resultado = mysqli_query($conexion, $consulta);

                                                while ($verfecha = mysqli_fetch_row($resultado)) {
                                                    $datosfecha = $verfecha[0]; //cambio de estado
                                                    $fechap = strtotime(date("d-m-Y", strtotime($datosfecha))); //reseteo de la fecha de cambio de estado

                                                    if ($ver[14] == 'TERMINADO') { //condiciones

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
                                                ?>
                                            </small>

                                        <?php
                                        } //cierre movimientos

                                        ?>
                                    </b>
                                </span>
                            </td>

                            <!--RETARDO DE DIAS -->
                            <td width="40px">
                                <span>
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

                                                if ($res > 20) {

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
                                        }   //CIERRE IF 1

                                        //DIAS DE RETARDO ENTRE FECHA PROMESA Y FECHA ACTUAL

                                        ?>
                                    </small>
                                </span>
                            </td>

                            <!--ESTADO-->
                            <td style="text-align:left;" width="130px">
                                <span>

                                    <?php
                                    if ($ver[14] == 'CANCELADO') { ?>
                                        <img src="img/Cancelado.png" width="43" height="43" />
                                        <small><b>CANCELADO</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'ACTIVADO FLT') { ?>
                                        <img src="img/Act_Flt.png" width="43" height="43" />
                                        <small><b>ACT. FLT</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'ACTIVADO GNP') { ?>
                                        <img src="img/Act_GNP.png" width="43" height="43" />
                                        <small><b>ACT. GNP</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'ACTIVADO MED') { ?>
                                        <img src="img/Act_Med.png" width="43" height="43" />
                                        <small><b>ACT. MED</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'PROCESO') { ?>
                                        <img src="img/Proceso.png" width="43" height="43" />
                                        <small><b>PROCESO</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'REPROCESO') { ?>
                                        <img src="img/Reproceso.png" width="43" height="43" />
                                        <small><b>REPROCESO</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'ENVIADO') { ?>
                                        <img src="img/enviado.png" width="43" height="43" />
                                        <small><b>ENVIADO</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'TERMINADO') { ?>
                                        <img src="img/Terminado.png" width="43" height="43" />
                                        <small><b>TERMINADO</b></small>
                                    <?php
                                    }
                                    if ($ver[14] == 'TERMINADO CON POLIZA') { ?>
                                        <img src="img/Terminado_p.png" width="43" height="43" />
                                        <small><b>TERMINADO/P</b></small>
                                    <?php
                                    }
                                    ?>
                                </span>
                            </td>
                            <td width="50px">
                                <form class="" action="seguimiento_colab.php?id=<?php echo $ver[0]; ?>" method="post">
                                    <button class="btn btn-link glyphicon glyphicon-search" value="<?php echo $ver[0]; ?>" id="id" name="id"></button>
                                    <!--DETALLES-->
                                </form>

                            </td>
                        </tr>
                <?php
                    }
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
            $('#tablaDinamicaLoadVida').DataTable({
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