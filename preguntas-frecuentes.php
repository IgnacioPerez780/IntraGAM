<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();
session_start();

//Redireccion al index si no se esta logueado
if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" type="text/css" href="css/hoja_preguntas.css">

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<!-- Tipo de cabecera que se mostrara al agente -->
<?php
include('plantillas/cabecera_preguntasAgente.php');
?>

<body>

    <div class="container">
        <div class="panel-group" id="accordion">

            <!-- VIDA -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse_One">
                            <button class="collapsible">
                                <img class="icono" src="img/Vida x4.png">
                                Vida Individual
                            </button>
                        </a>
                    </h4>
                </div>

                <!-- SECCION PREGUNTAS -->
                <div id="collapse_One" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="panel-group" id="accordion1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse_One_One">
                                            <ul>
                                                <li>Preguntas frecuentes de Alta de Póliza o Nuevos Negocios</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_One_One" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <ol type="I">
                                                <li style="margin-left:-20px;"><b>¿Qué necesito para ingresar un Nuevo Negocio Vida Individual?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample">
                                            <ol type="1">
                                                <li>Requisitos para todos los productos</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Solicitud de Seguro vigente <a target="_black" href="https://www.gnp.com.mx">www.gnp.com.mx</a> debidamente llenada y firmada por el y/o los Asegurados, Contratante y Agente. </li>
                                                <li style="margin-left:35px;">Requisitos Médicos y Financieros: · Es necesario verificar si el Solicitante acumula Suma Asegurada, ya que, con relación a ésta, así como a su edad al momento de la solicitud, se determinarán los requisitos que deberá presentar, de acuerdo con la Guía de Requisitos de Asegurabilidad vigente <a target="_black" href="https://www.gnp.com.mx">(www.gnp.com.mx)</a>.</li>
                                                <li style="margin-left:35px;">Presentar 492 completo legible, vigente y cotejado (comprobante de domicilio no mayor a 3 meses (cfe, agua, gas natural, predio, Telmex, celular plan, tv de paga incluido con teléfono).</li>
                                                <li style="margin-left:35px;">Identificación oficial (INE, pasaporte, cartilla militar, residente permanente, IMSS, y formato único de identificación del cliente).</li>
                                                <li style="margin-left:35px;">Si el trámite corresponde a Vida Inversión, Elige, Consolida Total y Capitaliza, además de los requisitos anteriormente mencionados, debes presentar de forma indispensable:</li>
                                            </ol>

                                            <ul>
                                                <li style="margin-left:70px;">Convenio de Uso de Servicios Electrónicos.</li>
                                                <li style="margin-left:70px;">Copia del último Estado de Cuenta bancario (hoja completa y cotejada no mayor a 3 meses).</li>
                                                <li style="margin-left:70px;">Formato de domiciliación bancaria </li>
                                                <li style="margin-left:70px;">Carta aceptación de capitaliza (este último solo para plan capitaliza).</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_2" role="button" aria-expanded="false" aria-controls="collapseExample_2">
                                            <ol type="I" start="2">
                                                <li style="margin-left:-20px;"><b>¿Qué es un rango A, B y C?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_2">
                                            <ol type="1">
                                                <li style="margin-left:10px;">Son el tipo de exámenes médicos que requiere tu asegurado dependiendo su edad y suma asegurada solicitada.</li>
                                                <li style="margin-left:10px;">Consultar la guía de asegurabilidad en <a href="https://www.gnp.com.mx">www.gnp.com.mx</a> portal de intermediarios, vida, políticas. Agenda tu cita de examen médico en medica móvil:</li>
                                            </ol>

                                            <ul>
                                                <li style="margin-left:50px;">CDMX (55) 54-82-37-08 <b>Opción #1</b></li>
                                                <li style="margin-left:50px;">Guadalajara (33) 38-27-11-91 <b>Opción #1</b></li>
                                                <li style="margin-left:50px;">Monterrey (81) 83-78-26-70 <b>Opción #4</b></li>
                                                <li style="margin-left:50px;">Interior de la República (55) 54-82-37-08 <b>Opción #4</b></li>
                                                <li style="margin-left:50px;">Correo electrónico en examenmedico@medicamovil.com</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PAGOS -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse_One_Two">
                                            <ul>
                                                <li>Preguntas frecuentes de Pagos</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_One_Two" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1/PAGOS -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_3" role="button" aria-expanded="false" aria-controls="collapseExample_3">
                                            <ol type="I">
                                                <li style="margin-left:-20px;"><b>¿Cómo pago la prima con el fondo de inversión?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_3">
                                            <ol type="1">
                                                <li>Requisitos</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Solicitud de cambios(H-107), llenando los siguientes campos:</li>
                                            </ol>
                                            <ul>
                                                <li style="margin-left:70px;">Número de Póliza de la cual se realizará el retiro y fecha de llenado de la solicitud.</li>
                                                <li style="margin-left:70px;">Datos del Asegurado y Contratante.</li>
                                                <li style="margin-left:70px;">Datos del Agente: Clave, Zona, Nombre y Firma.</li>
                                                <li style="margin-left:70px;">Firma del Asegurado (si se trata de una póliza Vidas Conjuntas, ambos deberán firmar) y Contratante.</li>
                                                <li style="margin-left:70px;">En la Sección I "Movimientos Financieros" indicar en el apartado de Retiro para pago de prima, el monto, el ramo y el número de póliza a la que se aplicará el pago.</li>
                                            </ul>
                                            <ol type="a" start="2">
                                                <li style="margin-left:35px;">Al realizar el retiro se cobrará un recargo de 10 pesos ó 5 dólares, según el tipo de moneda del plan (es importante que cuente con monto suficiente).</li>
                                                <li style="margin-left:35px;">La póliza debe estar vigente / identificación oficial legible cotejada.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2/PAGOS -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_4" role="button" aria-expanded="false" aria-controls="collapseExample_4">
                                            <ol type="I" start="2">
                                                <li style="margin-left:-20px;"><b>¿Cómo pago la prima o póliza con otro ramo?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_4">
                                            <ol type="1">
                                                <li>Requisitos</li>
                                            </ol>
                                            <ol type="a">
                                                <li style="margin-left:35px;">Solicitud de cambios(H-107), llenando los siguientes campos:</li>
                                            </ol>
                                            <ul>
                                                <li style="margin-left:70px;">Número de Póliza de la cual se realizará el retiro y fecha de llenado de la solicitud.</li>
                                                <li style="margin-left:70px;">Datos del Asegurado y Contratante.</li>
                                                <li style="margin-left:70px;">Datos del Agente: Clave, Zona, Nombre y Firma.</li>
                                                <li style="margin-left:70px;">Firma del Asegurado (si se trata de una póliza Vidas Conjuntas, ambos deberán firmar) y Contratante.</li>
                                                <li style="margin-left:70px;">En la Sección I "Movimientos Financieros" indicar en el apartado de Retiro para pago de prima, el monto, el ramo y el número de póliza a la que se aplicará el pago.</li>
                                            </ul>
                                            <ol type="a" start="2">
                                                <li style="margin-left:35px;">Al realizar el retiro se cobrará un recargo de 10 pesos ó 5 dólares, según la moneda del plan. Las pólizas deben estar vigentes.</li>
                                                <li style="margin-left:35px;">Las pólizas debe ser del mismo asegurado.</li>
                                                <li style="margin-left:35px;">Identificación oficial legible cotejada.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 3/PAGOS  -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_5" role="button" aria-expanded="false" aria-controls="collapseExample_5">
                                            <ol type="I" start="3">
                                                <li style="margin-left:-20px;"><b>¿Cómo pago una póliza capitaliza?</b></li>
                                            </ol>
                                        </a>
                                        <div class="collapse" id="collapseExample_5">
                                            <ol type="a">
                                                <li style="margin-left:35px;">Llamar al call center de capitaliza para pagos y referencias:</li>
                                            </ol>
                                            <ul>
                                                <li style="margin-left:50px;">TELEFONO 52-27-90-00 <b>OPCIONES 4 1 1</b></li>
                                                <li style="margin-left:50px;">SIN COSTO 01800 400 9000</li>
                                            </ul>

                                            <ol type="a" start="2">
                                                <li style="margin-left:35px;">La póliza debe estar vigente.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 4/PAGOS  -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_6" role="button" aria-expanded="false" aria-controls="collapseExample_6">
                                            <ol type="I" start="4">
                                                <li style="margin-left:-20px;"><b>¿Cómo pago un prestamo?</b></li>
                                            </ol>
                                        </a>
                                        <div class="collapse" id="collapseExample_6">
                                            <ol type="a">
                                                <li style="margin-left:35px;">Llamar a la extensión de préstamos GNP 52-27-38-76.</li>
                                                <li style="margin-left:35px;">La póliza debe estar vigente.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 5/PAGOS  -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_7" role="button" aria-expanded="false" aria-controls="collapseExample_7">
                                            <ol type="I" start="5">
                                                <li style="margin-left:-20px;"><b>¿Cómo puedo ganar mi prima con diferentes formas de pago?</b></li>
                                            </ol>
                                        </a>
                                        <div class="collapse" id="collapseExample_7">
                                            <ol type="a">
                                                <li style="margin-left:35px;">Solicita el VB. vía correo con los formatos correspondientes en IntraGAM material de apoyo.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- MOVIMIENTOS -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse_One_Three">
                                            <ul>
                                                <li>Preguntas frecuentes de Movimientos</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>

                                <!-- PREGUNTA 1/MOVIMIENTOS -->
                                <div id="collapse_One_Three" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_8" role="button" aria-expanded="false" aria-controls="collapseExample_8">
                                            <ol type="I">
                                                <li style="margin-left:-20px;"><b>¿Cómo realizo el cambio de conduto de cobro de Vida Individual?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_8">
                                            <ol type="1">
                                                <li>Requisitos;</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Solicitud de cambios (H-107), llenando los siguientes campos:</li>
                                            </ol>
                                            <ul>
                                                <li style="margin-left:70px;">Número de Póliza en la cual se realizará el cambio y fecha de llenado de la solicitud.</li>
                                                <li style="margin-left:70px;">Datos del Asegurado y Contratante.</li>
                                                <li style="margin-left:70px;">En la Sección V “Otros cambios”, indicar la petición correspondiente.</li>
                                                <li style="margin-left:70px;">Datos del Agente: Clave, Zona, Nombre y Firma.</li>
                                                <li style="margin-left:70px;">Firma del Asegurado (si se trata de una póliza Vidas Conjuntas, ambos deberán firmar) y Contratante.</li>
                                            </ul>
                                            <ol type="a" start="2">
                                                <li style="margin-left:35px;">Si el cambio a Conducto de Cobro es a Intermediario, únicamente será necesario especificarlo en la sección V “Otros Cambios” de la Solicitud de cambios H-107.</li>
                                                <li style="margin-left:35px;">Si el cambio a Conducto de Cobro Banco, además de especificarlo en la sección V “Otros Cambios” de la Solicitud de cambios H-107, deberás incluir el formato Cargo a Tarjeta de Crédito debidamente llenado y firmado por el Contratante y el Agente. identificación oficial legible cotejada.</li>
                                                <li style="margin-left:35px;">La póliza debe estar vigente.</li>
                                                <li style="margin-left:35px;">Este cambio debe solicitarse a recibo pendiente.</li>
                                                <li style="margin-left:35px;">Si tu cambio es de menor a mayor lo podrás realizar a través del call center (ej. Si la póliza se encuentra mensual-banco y el cambio lo requieres a quedar anual-intermediario o banco).</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2/MOVIMIENTOS -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_9" role="button" aria-expanded="false" aria-controls="collapseExample_9">
                                            <ol type="I" start="2">
                                                <li style="margin-left:-20px;"><b>¿Cómo realizo correcciones o cambios en póliza Vida Individual?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_9">
                                            <ol type="1">
                                                <li style="margin-left:35px;">Solicitud de cambios(H-107), llenando los siguientes campos:</li>
                                            </ol>
                                            <ul>
                                                <li style="margin-left:70px;">Número de Póliza en la cual se realizará el cambio y Fecha de llenado de la solicitud.</li>
                                                <li style="margin-left:70px;">Indicar la petición correspondiente en la Sección V "Otros Cambios".</li>
                                                <li style="margin-left:70px;">Datos del Agente: Clave, Zona, Nombre y Firma.</li>
                                                <li style="margin-left:70px;">Firma del Asegurado (si se trata de una póliza Vidas Conjuntas, ambos deberán firmar) y Contratante.</li>
                                            </ul>
                                            <ol type="1" start="2">
                                                <li style="margin-left:35px;">La póliza debe estar vigente.</li>
                                                <li style="margin-left:35px;">Si el dato a corregir está dentro de los primeros 30 días de emitida la póliza, lo podrás solicitar solo mencionando en el folio de IntraGAM este se reprocesa y se versiona con la corrección.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 3/MOVIMIENTOS -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_10" role="button" aria-expanded="false" aria-controls="collapseExample_10">
                                            <ol type="I" start="3">
                                                <li style="margin-left:-20px;"><b>¿Cómo realizo una aportación programada o adicional extraordinaria única?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_10">
                                            <ol type="1">
                                                <li style="margin-left:35px;">La póliza debe estar vigente y pagada.</li>
                                                <li style="margin-left:35px;">Si son extraordinarias, estas solo se realizan únicamente con cheque o transferencia, solicitarla a través del portal de intermediarios www.gnp.com.mx o al siguiente correo: solicita.sartreforma@gnp.com.mx.</li>
                                                <li style="margin-left:35px;">Si tu aportación es programada se requiere que lo ingreses a través del folio IntraGAM, con el formato de CAT sin rebasar del 10% del monto de la prima.</li>
                                            </ol>
                                            <ul>
                                                <li style="margin-left:35px;"><b>Nota:</b> RECUERDA QUE AL LLENAR LOS FORMATOS CORRESPONDIENTES DE FORMA CORRECTA Y COMPLETA, LA SUSCRIPCIÓN SERÁ MÁS PRECISA Y EFICIENTE. EVITA LA ACTIVACIÓN AL OMITIR O LLENAR DATOS ERRÓNEAMENTE.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- GMM -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse_Two">
                            <button class="collapsible">
                                <img class="icono" src="img/GMM x4.png">
                                Gastos Médicos Mayores
                            </button>
                        </a>
                    </h4>
                </div>

                <div id="collapse_Two" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="panel-group" id="accordion2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse_Two_One">
                                            <ul>
                                                <li>Preguntas frecuentes de Alta de Póliza o Nuevos Negocios</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Two_One" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_11" role="button" aria-expanded="false" aria-controls="collapseExample_11">
                                            <ol type="I">
                                                <li style="margin-left:-20px;"><b>¿Qué documentos se requieren para Nuevos Negocios de 0 a 64 años?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_11">
                                            <ol type="1">
                                                <li>Solicitud de Seguro de Gastos Médicos Mayores y Anexos de la Solicitud de Seguro.</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Cuestionarios adicionales, los mencionados en la solicitud de seguro en caso de practicar dichas actividades deportivas y/o laborales.</li>
                                                <li style="margin-left:35px;">Identificación oficial.</li>
                                                <li style="margin-left:35px;">Comprobante de domicilio.</li>
                                                <li style="margin-left:35px;">Formato de identificación de cliente.</li>
                                            </ol>

                                            <ol type="1" start="2">
                                                <li>Para negocios con rango de edad entre 65 y 70 años adicionalmente se deberá presentar de manera obligatoria:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Historia clínica completa. (Antecedentes, diagnósticos, tratamientos, evolución, complicaciones, secuelas y estado actual de salud, de padecimientos previos y actuales).</li>
                                                <li style="margin-left:35px;">Perfil de lípidos completo.</li>
                                                <li style="margin-left:35px;">Química sanguínea 3 elementos.</li>
                                                <li style="margin-left:35px;">Hemoglobina glicosilada.</li>
                                                <li style="margin-left:35px;">Sangre en heces.</li>
                                                <li style="margin-left:35px;">Examen general de orina.</li>
                                                <li style="margin-left:35px;">Tele de tórax.</li>
                                                <li style="margin-left:35px;">Electrocardiograma en reposo.</li>
                                                <li style="margin-left:35px;">Densitometría ósea.</li>
                                                <li style="margin-left:35px;">Antígeno prostático (para hombres).</li>
                                                <li style="margin-left:35px;">Mastografía (mujeres).</li>
                                                <li style="margin-left:35px;">Los estudios corren a cuenta del cliente.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_12" role="button" aria-expanded="false" aria-controls="collapseExample_12">
                                            <ol type="I" start="2">
                                                <li style="margin-left:-20px;"><b>¿Qué documentos se necesitan para un Nuevo Negocio de Póliza Colectiva a Individual (CCI)?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_12">
                                            <ol type="1">
                                                <li>Se tienen 30 días para solicitar este movimiento.</li>
                                                <li>Solicitud de Seguro de Gastos Médicos Mayores y Anexos de la Solicitud de Seguro.</li>
                                                <li>Cuestionarios adicionales, los mencionados en la solicitud de seguro en caso de practicar dichas actividades deportivas y/o laborales.</li>
                                                <li>Identificación oficial.</li>
                                                <li>Comprobante de domicilio.</li>
                                                <li>Formato de identificación de cliente.</li>
                                                <li>Empleados:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Documento que compruebe la salida de la colectividad asegurada (recibo finiquito, acta de jubilación, incapacidad total o permanente, carta de Recursos Humanos que especifique la fecha de la separación laboral, renuncia o pérdida del beneficio para toda la empresa).</li>
                                            </ol>

                                            <ol type="1" start="8">
                                                <li>Alumnos:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Cédula profesional, certificado o carta de baja, especificando la fecha de separación de la Institución.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 3 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_13" role="button" aria-expanded="false" aria-controls="collapseExample_13">
                                            <ol type="I" start="3">
                                                <li style="margin-left:-20px;"><b>Para eliminación o reducción de períodos de espera</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_13">
                                            <ol type="1">
                                                <li>La póliza anterior deberá cumplir con:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Suma Asegurada mayor o igual a $635,000 pesos y deducible hasta $172,500 pesos.</li>
                                                <li style="margin-left:35px;">Un año mínimo de vigencia.</li>
                                                <li style="margin-left:35px;">Pertenecer a una Aseguradora autorizada por la Comisión Nacional de Seguros y Fianzas autorizada para comercializar GMM.</li>
                                                <li style="margin-left:35px;">No deberá de tener más de 30 días al descubierto entre la compañía anterior y la de GNP.</li>
                                                <li style="margin-left:35px;">En la carátula deberá contener nombre y fecha de nacimiento de los asegurados, vigencia, suma asegurada y deducible.</li>
                                            </ol>

                                            <ol type="1" start="2">
                                                <li>En caso de ser póliza individual, entregar comprobante de pago.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 4 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_14" role="button" aria-expanded="false" aria-controls="collapseExample_14">
                                            <ol type="I" start="4">
                                                <li style="margin-left:-20px;"><b>Conversión de conexión a Plan Individual</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_14">
                                            <ol type="1">
                                                <li>En todos los casos:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Solicitud de movimientos de Conexión Línea Azul.</li>
                                                <li style="margin-left:35px;">Solicitud de Seguro de Gastos Médicos Mayores, Anexos de la Solicitud de Seguro (en caso de solicitar cambio de condiciones) y Cuestionario de deportes peligrosos (en caso de ser necesario).</li>
                                                <li style="margin-left:35px;">Copia de la última carátula de la póliza colectiva o certificado individual.</li>
                                                <li style="margin-left:35px;">La carátula o certificado del asegurado deberá contener, nombre y fecha de nacimiento de los asegurados, vigencia, así como suma asegurada y deducible.</li>
                                                <li style="margin-left:35px;">Finiquitos de las reclamaciones que sucedieron durante la vigencia de Conexión Línea Azul GNP y Conexión GNP.</li>
                                                <li style="margin-left:35px;">Empleados:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:70px;">Documento que compruebe la salida de la colectividad asegurada (recibo finiquito, acta de jubilación, incapacidad total o permanente, carta de Recursos Humanos que especifique la fecha de la separación laboral, renuncia o pérdida del beneficio para toda la empresa).</li>
                                            </ol>

                                            <ol type="a" start="7">
                                                <li style="margin-left:35px;">Alumnos:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:70px;">Cédula profesional, certificado o carta de baja, especificando la fecha de separación de la Institución.</li>
                                            </ol>

                                            <ol type="1" start="2">
                                                <li>Para solicitar la conversión:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Máximo con 90 días naturales después de la separación de la colectividad asegurada.</li>
                                                <li style="margin-left:35px;">En caso de no haber presentado reclamaciones en la póliza colectiva, indicarlo en la Solicitud de movimientos Conexión Línea Azul GNP y Conexión GNP.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 5 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_15" role="button" aria-expanded="false" aria-controls="collapseExample_15">
                                            <ol type="I" start="5">
                                                <li style="margin-left:-20px;"><b>¿Cuál es el proceso para riesgo selecto?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_15">
                                            <ol type="1">
                                                <li>Tramite disponible para nuevo negocio y renovación.</li>
                                                <li>Agendar cita en laboratorio 75889759</li>
                                                <li>Después de efectuada la cita validar estatus, ruta GMM, riesgo selecto, seguimiento y relación OT.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 6 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_16" role="button" aria-expanded="false" aria-controls="collapseExample_16">
                                            <ol type="I" start="6">
                                                <li style="margin-left:-20px;"><b>¿Se puede contratar solidez familiar en cualquier momento?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_16">
                                            <ol type="1">
                                                <li>Se puede contratar al momento de emitir un nuevo negocio y en renovaciones, siempre que sean al menos 4 asegurados y este beneficio aplica para, Premium, Platino, Flexibles y también en los Premier 100,200,300 Y 400 considerando que en estos planes ya no hay nuevos negocios.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse_Two_Two">
                                            <ul>
                                                <li>Preguntas frecuentes de Movimientos</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>


                                <div id="collapse_Two_Two" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_17" role="button" aria-expanded="false" aria-controls="collapseExample_17">
                                            <ol type="I">
                                                <li style="margin-left:-20px;"><b>¿Qué se necesita para el alta de un asegurado?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_17">
                                            <ol type="1">
                                                <li>Documentos:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Solicitud y H-107.</li>
                                                <li style="margin-left:35px;">Alta de recién nacido:</li>
                                            </ol>

                                            <ol type="I">
                                                <li style="margin-left:70px;">Constancia de alumbramiento a acta de nacimiento en caso de recién nacido y se deberá de solicitar el alta dentro de los primeros 30 días a la fecha de nacimiento y que la madre cumpla con al menos10 mese de cobertura continua al momento del nacimiento.</li>
                                                <li style="margin-left:70px;">Si no cumple el requisito será con H-107, solicitud e identificación oficial</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_18" role="button" aria-expanded="false" aria-controls="collapseExample_18">
                                            <ol type="I" start="2">
                                                <li style="margin-left:-20px;"><b>¿Qué se necesita para rehabilitar una póliza?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_18">
                                            <ol type="1">
                                                <li>Documentos:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">46-60 días al descubierto 2% sin documentos.</li>
                                                <li style="margin-left:35px;">61-90 días al descubierto 4% h107, declaración de salud.</li>
                                                <li style="margin-left:35px;">91-120 días al descubierto 6% h107, declaración de salud.</li>
                                                <li style="margin-left:35px;">121 días en adelante: h-107 y solicitud, sujeto a valoración.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 3 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_19" role="button" aria-expanded="false" aria-controls="collapseExample_19">
                                            <ol type="I" start="3">
                                                <li style="margin-left:-20px;"><b>¿Se pueden hacer modificaciones en inter de vigencia?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_19">
                                            <ol type="1">
                                                <li>Movimientos en condiciones de la póliza:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Renovación:</li>
                                            </ol>

                                            <ol type="I">
                                                <li style="margin-left:70px;">Cualquier tipo de movimiento.</li>
                                            </ol>

                                            <ol type="a" start="2">
                                                <li style="margin-left:35px;">Inter de vigencia:</li>
                                            </ol>

                                            <ol type="I">
                                                <li style="margin-left:70px;">Solo baja en condiciones, siempre y cuando haya un recibo pendiente de pago.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse_Three_Three">
                                            <ul>
                                                <li>Preguntas frecuentes de Pagos</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>

                                <!-- PREGUNTA 1 -->
                                <div id="collapse_Three_Three" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_20" role="button" aria-expanded="false" aria-controls="collapseExample_20">
                                            <ol type="I">
                                                <li style="margin-left:-20px;"><b>Solicitar VOBO para pago después de la vigencia del recibo</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_20">
                                            <ol type="a">
                                                <li style="margin-left:35px;">Si la póliza está dentro de los 30 días puedes llamar a call center 52273132. Transferencia, efectivo (120,000 máximo), app de clientes y agentes.</li>
                                                <li style="margin-left:35px;">Si pasa de los 30 días solicita tu visto bueno por correo.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <!-- AUTOS -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion3" href="#collapse_Three">
                            <button class="collapsible">
                                <img class="icono" src="img/Autos x4.png">
                                Autos
                            </button>
                        </a>
                    </h4>
                </div>
                <div id="collapse_Three" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="panel-group" id="accordion3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion3" href="#collapse_Three_One">
                                            <ul>
                                                <li>Preguntas frecuentes de Nuevos Negocios</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Three_One" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_21" role="button" aria-expanded="false" aria-controls="collapseExample_21">
                                            <ol type="I">
                                                <li style="margin-left:-20px;"><b>¿Cuándo aplica el descuento por Seguro Previo?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_21">
                                            <ol type="1">
                                                <li>El descuento por seguro previo únicamente aplica para vehículos que cuenten con una póliza de seguro que provenga de otra compañía y se encuentre dentro de los primeros 30 días.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_22" role="button" aria-expanded="false" aria-controls="collapseExample_22">
                                            <ol type="I" start="2">
                                                <li style="margin-left:-20px;"><b>¿Cuál es la vigencia de una cotización?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_22">
                                            <ol type="1">
                                                <li>Tiene una vigencia de 15 días naturales a partir de la fecha de expedición impresa en esta cotización. Excepto en campañas especiales.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 3 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_23" role="button" aria-expanded="false" aria-controls="collapseExample_23">
                                            <ol type="I" start="3">
                                                <li style="margin-left:-20px;"><b>¿Qué puedo hacer si deseo emitir una póliza individual que proviene de venta masiva?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_23">
                                            <ol type="1">
                                                <li>Si tu cliente desee cambiar de canal de venta su póliza vigente de Autos, se debe levantar una Orden de Trabajo desde el WorkFlow de Autos en la sección OTROS, ingresando la siguiente documentación:</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Carta del asegurado solicitando la emisión de la póliza, integrando los datos del nuevo intermediario.</li>
                                                <li style="margin-left:35px;">Identificación oficial del cliente.</li>
                                                <li style="margin-left:35px;">Cotización con las condiciones y costo a reexpedir.</li>
                                                <li style="margin-left:35px;">En caso de que la póliza cuente con Beneficiario Preferente, es necesario adjuntar carta de conformidad, carta de liberación de crédito o documento que acredite lo anterior.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion3" href="#collapse_Three_Two">
                                            <ul>
                                                <li>Preguntas frecuentes de Tesorería</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Three_Two" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_24" role="button" aria-expanded="false" aria-controls="collapseExample_24">
                                            <ol type="I">
                                                <li style="margin-left:-20px;"><b>¿Qué documentación necesito para solicitar la devolución de primas?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_24">
                                            <ol type="1">
                                                <li>Ventanilla o transferencia</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Persona física</li>
                                            </ol>

                                            <ol type="I">
                                                <li style="margin-left:70px;">Identificación oficial vigente.</li>
                                                <li style="margin-left:70px;">Estado de cuenta (no mayor a 3 meses).</li>
                                            </ol>

                                            <ol type="a" start="2">
                                                <li style="margin-left:35px;">Persona moral</li>
                                            </ol>

                                            <ol type="I">
                                                <li style="margin-left:70px;">Identificación oficial vigente del representante legal.</li>
                                                <li style="margin-left:70px;">Estado de cuenta (no mayor a 3 meses).</li>
                                                <li style="margin-left:70px;">Acta constitutiva.</li>
                                                <li style="margin-left:70px;">RFC del representante legal.</li>
                                            </ol>

                                            <ol type="1" start="2">
                                                <li>Tarjeta bancaria</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:35px;">Persona física</li>
                                            </ol>

                                            <ol type="I">
                                                <li style="margin-left:70px;">Identificación oficial vigente.</li>
                                                <li style="margin-left:70px;">Estado de cuenta (no mayor a 3 meses).</li>
                                            </ol>

                                            <ol type="a" start="2">
                                                <li style="margin-left:35px;">Persona moral</li>
                                            </ol>

                                            <ol type="I">
                                                <li style="margin-left:70px;">Identificación oficial vigente del representante legal. </li>
                                                <li style="margin-left:70px;">Estado de cuenta (no mayor a 3 meses).</li>
                                                <li style="margin-left:70px;">Acta constitutiva.</li>
                                                <li style="margin-left:70px;">RFC del representante legal.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion3" href="#collapse_ThreeA_Three">
                                            <ul>
                                                <li>Preguntas frecuentes Pagos</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_ThreeA_Three" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_25" role="button" aria-expanded="false" aria-controls="collapseExample_25">
                                            <ol type="I">
                                                <li style="margin-left:-20px;"><b>¿En cuanto tiempo se ve aplicado un pago por referencia SART?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_25">
                                            <ol type="1">
                                                <li>Al utilizar la referencia de SART para el pago, la aplicación es en forma automática. En un lapso de 24 a 72 horas hábiles.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion3" href="#collapse_Three_Four">
                                            <ul>
                                                <li>Preguntas frecuentes Movimientos</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Three_Four" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_26" role="button" aria-expanded="false" aria-controls="collapseExample_26">
                                            <ol type="I">
                                                <li style="margin-left:-20px;"><b>¿Qué documentación necesito para la cancelación de un auto?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_26">
                                            <ol type="1">
                                                <li style="margin-left:35px;">Persona física</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:70px;">Carta cancelación firmada por el contratante.</li>
                                                <li style="margin-left:70px;">Identificación oficial del contratante.</li>
                                            </ol>

                                            <ol type="1" start="2">
                                                <li style="margin-left:35px;">Persona moral</li>
                                            </ol>

                                            <ol type="a">
                                                <li style="margin-left:70px;">Carta cancelación firmada por el contratante.</li>
                                                <li style="margin-left:70px;">Identificación oficial del representante legal.</li>
                                                <li style="margin-left:70px;">Acta constitutiva.</li>
                                                <li style="margin-left:70px;">RFC del representante legal.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_27" role="button" aria-expanded="false" aria-controls="collapseExample_27">
                                            <ol type="I" start="2">
                                                <li style="margin-left:-20px;"><b>¿Qué documentación necesito para eliminar un beneficiario preferente?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_27">
                                            <ol type="1">
                                                <li style="margin-left:35px;">Carta de no adeudo del beneficiario preferente.</li>
                                                <li style="margin-left:35px;">Carta petición del cliente.</li>
                                                <li style="margin-left:35px;">Credencial oficial del cliente (INE o pasaporte).</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- SINIESTROS -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion4" href="#collapse_Four">
                            <button class="collapsible">
                                <img class="icono" src="img/Siniestros x4.png">
                                Siniestros
                            </button>
                        </a>
                    </h4>
                </div>

                <div id="collapse_Four" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <h3>Gastos Médicos Mayores</h3>
                        <div class="panel-group" id="accordion4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion4" href="#collapse_Four_One">
                                            <ul>
                                                <li>Preguntas frecuentes reembolsos</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Four_One" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_28" role="button" aria-expanded="false" aria-controls="collapseExample_28">
                                            <ol type="I">
                                                <li style="margin-left: -20px;"><b>¿Qué documentación necesito para ingresar un reembolso?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_28">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Formato de solicitud de reembolso.</li>
                                                <li style="margin-left: 35px;">Aviso de accidente y/o enfermedad.</li>
                                                <li style="margin-left: 35px;">Formato único de información bancaria.</li>
                                                <li style="margin-left: 35px;">Identificación oficial vigente.</li>
                                                <li style="margin-left: 35px;">Estado de cuenta donde sea visible cuenta CLAVE (no mayor a 3 meses).</li>
                                                <li style="margin-left: 35px;">Informe médico.</li>
                                                <li style="margin-left: 35px;">Recetas médicas.</li>
                                                <li style="margin-left: 35px;">Estudios que confirmen el diagnóstico.</li>
                                                <li style="margin-left: 35px;">Facturas a nombre del asegurado afectado o titular (en caso de ser menor de edad).</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_29" role="button" aria-expanded="false" aria-controls="collapseExample_29">
                                            <ol type="I" start="2">
                                                <li style="margin-left: -20px;"><b>¿Cuánto tiempo puede pasar para ingresar un gasto de reembolso?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_29">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Hasta 2 años una vez emitida la factura.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 3 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_30" role="button" aria-expanded="false" aria-controls="collapseExample_30">
                                            <ol type="I" start="3">
                                                <li style="margin-left: -20px;"><b>¿En qué tiempo se debe actualizar la información médica?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_30">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Recetas médicas: Cada 3 meses.</li>
                                                <li style="margin-left: 35px;">Informe médico: Cada 6 meses.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 4 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_31" role="button" aria-expanded="false" aria-controls="collapseExample_31">
                                            <ol type="I" start="4">
                                                <li style="margin-left: -20px;"><b>¿Qué pasa si una factura no fue cubierta por tener forma de pago 99?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_31">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Será necesario adjuntar un complemento de pago emitido por el SAT o solicitar la emisión de una nueva factura.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 5 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_32" role="button" aria-expanded="false" aria-controls="collapseExample_32">
                                            <ol type="I" start="5">
                                                <li style="margin-left: -20px;"><b>¿A nombre de quien debe salir la factura?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_32">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Las facturas deben salir a nombre del afectado o titular (en caso de ser menor de edad).</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion4" href="#collapse_Four_Two">
                                            <ul>
                                                <li>Preguntas frecuentes programaciones</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Four_Two" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_33" role="button" aria-expanded="false" aria-controls="collapseExample_33">
                                            <ol type="I">
                                                <li style="margin-left: -20px;"><b>¿Qué se necesita para programar una cirugía?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_33">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Aviso de accidente y/o enfermedad.</li>
                                                <li style="margin-left: 35px;">Informe médico.</li>
                                                <li style="margin-left: 35px;">Estudios que confirmen el diagnóstico.</li>
                                                <li style="margin-left: 35px;">Identificación oficial vigente.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_34" role="button" aria-expanded="false" aria-controls="collapseExample_34">
                                            <ol type="I" start="2">
                                                <li style="margin-left: -20px;"><b>¿Qué servicios se pueden programar?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_34">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Cirugía.</li>
                                                <li style="margin-left: 35px;">Terapias físicas.</li>
                                                <li style="margin-left: 35px;">Medicamentos.</li>
                                                <li style="margin-left: 35px;">Servicios de enfermería.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 3 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_35" role="button" aria-expanded="false" aria-controls="collapseExample_35">
                                            <ol type="I" start="3">
                                                <li style="margin-left: -20px;"><b>¿Puedo programar con un proveedor que esté en convenio?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_35">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">No.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion4" href="#collapse_Four_Three">
                                            <ul>
                                                <li>Preguntas frecuentes tabuladores y hospitales</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Four_Three" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_36" role="button" aria-expanded="false" aria-controls="collapseExample_36">
                                            <ol type="I">
                                                <li style="margin-left: -20px;"><b>¿Dónde puedo consultar los tabuladores?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_36">
                                            <ol type="a">
                                                <li style="margin-left: 35px;"><a target="_black" href="https://intermediarios.gnp.com.mx/tabuladoresgmm/">https://intermediarios.gnp.com.mx/tabuladoresgmm/</a></li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_37" role="button" aria-expanded="false" aria-controls="collapseExample_37">
                                            <ol type="I" start="2">
                                                <li style="margin-left: -20px;"><b>¿Cuál es la liga para conocer los hospitales y médicos en convenio?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_37">
                                            <ol type="a">
                                                <li style="margin-left: 35px;"><a target="_black" href="https://www.gnp.com.mx/directorio-proveedores-medicos#!/gnp/directorios">https://www.gnp.com.mx/directorio-proveedores-medicos#!/gnp/directorios</a></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion4" href="#collapse_Four_Four">
                                            <ul>
                                                <li>Preguntas frecuentes maternidad</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Four_Four" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_38" role="button" aria-expanded="false" aria-controls="collapseExample_38">
                                            <ol type="I">
                                                <li style="margin-left: -20px;"><b>Ayuda por maternidad</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_38">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Para solicitar la ayuda por maternidad antes del nacimiento se debe ingresar dentro de las semanas 33 a la 37, la documentación que necesitan ingresar es la siguiente:</li>
                                            </ol>

                                            <ol type="I">
                                                <li style="margin-left: 70px;">Formato de Notificación de parto.</li>
                                                <li style="margin-left: 70px;">Formato único de información bancaria./li>
                                                <li style="margin-left: 70px;">Identificación oficial vigente.</li>
                                                <li style="margin-left: 70px;">Estado de cuenta donde sea visible la cuenta CLABE (no mayor a 3 meses).</li>
                                                <li style="margin-left: 70px;">Último ultrasonido.</li>
                                            </ol>

                                            <ol type="a" start="2">
                                                <li style="margin-left: 35px;">Para solicitar la indemnización posterior al nacimiento, se debe ingresar la siguiente documentación:</li>
                                            </ol>

                                            <ol type="I">
                                                <li style="margin-left: 70px;">Formato de Notificación de parto.</li>
                                                <li style="margin-left: 70px;">Formato único de información bancaria./li>
                                                <li style="margin-left: 70px;">Identificación oficial vigente.</li>
                                                <li style="margin-left: 70px;">Estado de cuenta donde sea visible la cuenta CLABE (no mayor a 3 meses).</li>
                                                <li style="margin-left: 70px;">Acta de nacimiento o certificado de alumbramiento.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_39" role="button" aria-expanded="false" aria-controls="collapseExample_39">
                                            <ol type="I" start="2">
                                                <li style="margin-left: -20px;"><b>¿En qué semana hacen el pago de la indemnización por maternidad?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_39">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Durante la semana 38.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion4" href="#collapse_Five_Four">
                                            <ul>
                                                <li>Preguntas frecuentes seguimiento a mis trámites</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Five_Four" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_40" role="button" aria-expanded="false" aria-controls="collapseExample_40">
                                            <ol type="I">
                                                <li style="margin-left: -20px;"><b>¿Cuál es el tiempo de respuesta de un siniestro?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_40">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Reembolso: De 5 a 7 días hábiles.</li>
                                                <li style="margin-left: 35px;">Programación: De 3 a 5 días hábiles.</li>
                                            </ol>
                                        </div>


                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_41" role="button" aria-expanded="false" aria-controls="collapseExample_41">
                                            <ol type="I" start="2">
                                                <li style="margin-left: -20px;"><b>¿Dónde le puedo dar seguimiento a mis trámites?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_41">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Dentro del portal de intermediarios en:</li>
                                            </ol>

                                            <ol type="I">
                                                <li style="margin-left: 70px;">Expediente digital.</li>
                                                <li style="margin-left: 70px;">Siniestros.</li>
                                            </ol>

                                            <ol type="a" start="2">
                                                <li style="margin-left: 35px;">Call center: 55-52-27-90-00</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion4" href="#collapse_Six_Four">
                                            <ul>
                                                <li>Preguntas frecuentes renovación a respuestas GNP</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Six_Four" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_42" role="button" aria-expanded="false" aria-controls="collapseExample_42">
                                            <ol type="I">
                                                <li style="margin-left: -20px;"><b>¿Qué puedo hacer para solicitar una revaloración de una respuesta con la que no estoy de acuerdo?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_42">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Puedes ingresar tu petición a la liga: <a target="_black" href="https://aclaracionesqr-siniestros.gnp.com.mx/">https://aclaracionesqr-siniestros.gnp.com.mx/</a>.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <h3>Autos</h3>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion4" href="#collapse_Seven_Four">
                                            <ul>
                                                <li>Preguntas frecuentes siniestros autos</li>
                                            </ul>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_Seven_Four" class="panel-collapse collapse">
                                    <!-- PREGUNTA 1 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_43" role="button" aria-expanded="false" aria-controls="collapseExample_43">
                                            <ol type="I">
                                                <li style="margin-left: -20px;"><b>¿Cuál es la documentación necesaria para ingresar una petición por perdida total por colisión?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_43">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Convenio Finiquito 7-1.</li>
                                                <li style="margin-left: 35px;">Póliza</li>
                                                <li style="margin-left: 35px;">Factura endosada a favor de nuestro asegurado.</li>
                                                <li style="margin-left: 35px;">Comprobante de domicilio no mayor a 3 meses.</li>
                                                <li style="margin-left: 35px;">Identificación oficial vigente (INE, Pasaporte o Cedula Profesional).</li>
                                                <li style="margin-left: 35px;">RFC.</li>
                                                <li style="margin-left: 35px;">CURP.</li>
                                                <li style="margin-left: 35px;">Estado de Cuenta no mayor a 3 meses.</li>
                                                <li style="margin-left: 35px;">Formato de Información Bancaria.</li>
                                                <li style="margin-left: 35px;">Baja de Placas o Carta Deslinde.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 2 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_44" role="button" aria-expanded="false" aria-controls="collapseExample_44">
                                            <ol type="I" start="2">
                                                <li style="margin-left: -20px;"><b>¿Cuál es la documentación necesaria para ingresar una petición por perdida total por robo?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_44">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Convenio Finiquito 7-1.</li>
                                                <li style="margin-left: 35px;">Póliza.</li>
                                                <li style="margin-left: 35px;">Acta de robo y acreditación de propiedad certificados por el MP (ROBO Y ROBO RECUPERADO).</li>
                                                <li style="margin-left: 35px;">Baja de Placas o Carta Deslinde.</li>
                                                <li style="margin-left: 35px;">Ultimas 5 tenencias (Opcional).</li>
                                                <li style="margin-left: 35px;">Llaves de la Unidad (Robo Estacionado).</li>
                                                <li style="margin-left: 35px;">Oficio de Liberación (Robo Recuperado).</li>
                                                <li style="margin-left: 35px;">Acta Constitutiva (Persona Moral).</li>
                                                <li style="margin-left: 35px;">Poder de facultamiento del representante legal.</li>
                                                <li style="margin-left: 35px;">Factura con respectivos endosos.</li>
                                                <li style="margin-left: 35px;">Comprobante de domicilio no mayor a 3 meses.</li>
                                                <li style="margin-left: 35px;">Identificación oficial vigente (INE, Pasaporte o Cedula Profesional).</li>
                                                <li style="margin-left: 35px;">RFC.</li>
                                                <li style="margin-left: 35px;">CURP.</li>
                                                <li style="margin-left: 35px;">Estado de Cuenta no mayor a 3 meses.</li>
                                                <li style="margin-left: 35px;">Formato de Información Bancaria</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 3 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_45" role="button" aria-expanded="false" aria-controls="collapseExample_45">
                                            <ol type="I" start="3">
                                                <li style="margin-left: -20px;"><b>¿Cuántos días pueden pasar para solicitar un pase médico?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_45">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Hasta 5 días y será necesario adjuntar un cuestionario médico.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 4 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_46" role="button" aria-expanded="false" aria-controls="collapseExample_46">
                                            <ol type="I" start="4">
                                                <li style="margin-left: -20px;"><b>¿Quién es auto online?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_46">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Es un proveedor externo que utiliza GNP, para poder realizar un predictamen de los siniestros.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 5 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_47" role="button" aria-expanded="false" aria-controls="collapseExample_47">
                                            <ol type="I" start="5">
                                                <li style="margin-left: -20px;"><b>¿Cuál es la vigencia de una guía de DHL?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_47">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">5 días naturales.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 6 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_48" role="button" aria-expanded="false" aria-controls="collapseExample_48">
                                            <ol type="I" start="6">
                                                <li style="margin-left: -20px;"><b>¿Cuándo se puede hacer un auto ajuste?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_48">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Cuando el asegurado llama a cabina e indica que dentro de un siniestro no hubo lesionados, sin daños a terceros, ni a la nación y el vehículo puede circular.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 7 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_49" role="button" aria-expanded="false" aria-controls="collapseExample_49">
                                            <ol type="I" start="7">
                                                <li style="margin-left: -20px;"><b>¿Por qué un siniestro se va a verificaciones?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_49">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Porque el ajustador detecta inconsistencias dentro de lo declarado vs con los hechos. El tiempo de respuesta es de 12 días hábiles.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 8 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_50" role="button" aria-expanded="false" aria-controls="collapseExample_50">
                                            <ol type="I" start="8">
                                                <li style="margin-left: -20px;"><b>¿Qué gasto no cubre GNP?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_50">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">Días de estancia en el corralón.</li>
                                                <li style="margin-left: 35px;">Primer traslado del vehículo.</li>
                                                <li style="margin-left: 35px;">Multas.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- PREGUNTA 9 -->
                                    <div class="panel-body">
                                        <a data-toggle="collapse" href="#collapseExample_51" role="button" aria-expanded="false" aria-controls="collapseExample_51">
                                            <ol type="I" start="9">
                                                <li style="margin-left: -20px;"><b>¿Puedo hacer cambio de taller a agencia si el modelo de mi vehículo es mayor a 2 años?</b></li>
                                            </ol>
                                        </a>

                                        <div class="collapse" id="collapseExample_51">
                                            <ol type="a">
                                                <li style="margin-left: 35px;">No.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</body>

</html>

<!-- Script que ayuda a expandir o colapsar el contenido de cada seccion -->
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
        });
    }
</script>