<?php
error_reporting(0);
require 'Classes/PHPExcel.php';
include 'app/conexion.php';
$conexion = conexion();

// Consulta de los parametros seleccionados - Consulta 1
$sql = "SELECT * FROM folios WHERE id >= 20001 and fecha BETWEEN '2022-01-01 00:00:00.000000' AND '2023-12-31 23:59:59.000000' ORDER BY id";
// Ejecutamos la consulta
$resultado = mysqli_query($conexion, $sql);

// En que fila se inicia a escribir el reporte
$fila = 2;

// Inicia el phpExcel
$objPHPExcel = new PHPExcel();
// Propiedades basicas - getProperties-quien lo creo/setDescription-descripcion 
$objPHPExcel->getProperties()->setCreator("REPORTE INTRAGAM")->setDescription("REPORTE TOTAL");
// En que pestania estaremos trabajando
$objPHPExcel->setActiveSheetIndex(0);
// Establecemos titulo de la pestania
$objPHPExcel->getActiveSheet()->setTitle("FOLIOS");

// Encabezados para el reporte
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'FOLIO');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'FECHA DE SOLICITUD');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'F_GNP');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'T_AGENTE');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'AGENTE');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'NEGOCIO');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'SOLICITUD');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'POLIZA');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'MOVIMIENTO');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'CONTRATANTE');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'ESTADO');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'POLIZA');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'MONEDAP');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'MONEDA');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'PRIMA');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'PRODUCTO');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'RANGO');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'MONTO');
$objPHPExcel->getActiveSheet()->setCellValue('S1', 'PRIORIDAD');
$objPHPExcel->getActiveSheet()->setCellValue('T1', 'COMENTARIOS');
$objPHPExcel->getActiveSheet()->setCellValue('U1', 'USUARIO');
$objPHPExcel->getActiveSheet()->setCellValue('V1', 'ARCHIVOS');
$objPHPExcel->getActiveSheet()->setCellValue('W1', 'FECHA INICIO');
$objPHPExcel->getActiveSheet()->setCellValue('X1', 'FECHA TERMINO');
$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'DIAS ESTANDAR');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray($boldArray);

// Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(23);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(58);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(58);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(66);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(14);


//Imprimimos resultados de la primera consulta
while ($row = $resultado->fetch_assoc()) {

	$id = $row['id_agente'];
	$folio = $row['id'];
	$rango = $row['rango'];
	$movi = $row['movimiento'];
	$idu = $row['usuario'];

	// Query muestra el nombre del agente y el id que le pertenece
	$sql1 = "SELECT nombre, id_tipo_agente FROM datos_agente WHERE id = '$id'";
	$resultado1 = mysqli_query($conexion, $sql1);


	while ($row1 = $resultado1->fetch_assoc()) {

		$tipo = $row1['id_tipo_agente'];

		// Query muestra si es consolidado o novel el agente
		$sql2 = "SELECT tipo FROM tipo_agente WHERE id = '$tipo'";
		$resultado2 = mysqli_query($conexion, $sql2);

		while ($row2 = $resultado2->fetch_assoc()) {


			//Query muestra cuantos archivos hay en cada folio
			$sql4 = "SELECT COUNT(id) FROM archivos WHERE fk_folio ='$folio'";
			$resultado4 = mysqli_query($conexion, $sql4);

			while ($row4 = $resultado4->fetch_assoc()) {

				//Query muestra la fecha en la que se cambio de estado enviado a cualquiera estado menos terminado o terminado/p
				$sql5 = "SELECT fechaest FROM promesa WHERE folio='$folio'";
				$resultado5 = mysqli_query($conexion, $sql5);

				while ($row5 = $resultado5->fetch_assoc()) {

					if ($row['estado'] == "TERMINADO" || $row['estado'] == "TERMINADO CON POLIZA") {

						//Query que muestra la fecha del cambio de estado de los estados terminado o terminado/p
						$sql6 = "SELECT cd_estado FROM cam_estado WHERE folio = '$folio'";
						$resultado6 = mysqli_query($conexion, $sql6);

						while ($row6 = $resultado6->fetch_assoc()) {

							$objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['id']); //Folio
							$objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['fecha']);
							$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row['fgnp']);
							$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row2['tipo']); // Tipo de Agente (consolido-novel)
							$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row1['nombre']); // Agente
							$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['negocio']);
							$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['t_solicitud']);
							$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['poliza']);
							$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['movimiento']);
							$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['contratante']);
							$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['estado']);
							$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['fgnp']);
							$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['moneda']);
							$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['monedap']);
							$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['prima']);
							$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['producto']);
							$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['rango']);
							$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row['monto']);
							$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row['prioridad']);
							$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row['comentarios']);
							if ($row['usuario'] == 0) {
								$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, '-');
							} else {
								$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
								$resultado3 = mysqli_query($conexion, $sql3);
								while ($row3 = $resultado3->fetch_assoc()) {
									$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row3['nombre']);
								}
							}
							$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row4['COUNT(id)']); // Cuantos archivos hay en el folio
							$objPHPExcel->getActiveSheet()->setCellValue('W' . $fila, $row5['fechaest']); // Fecha Inicio
							$objPHPExcel->getActiveSheet()->setCellValue('X' . $fila, $row6['cd_estado']);
							if ($row['t_solicitud'] == "ALTA DE POLIZA") {
								$sql7 = "SELECT d_promesar FROM rango WHERE tiporan = '$rango'";
								$resultado7 = mysqli_query($conexion, $sql7);

								while ($row7 = $resultado7->fetch_assoc()) {
									$objPHPExcel->getActiveSheet()->setCellValue('Y' . $fila, $row7['d_promesar']);
								}
							} else {
								$sql8 = "SELECT d_promesa FROM producto WHERE producto = '$movi'";
								$resultado8 = mysqli_query($conexion, $sql8);

								while ($row8 = $resultado8->fetch_assoc()) {
									$objPHPExcel->getActiveSheet()->setCellValue('Y' . $fila, $row8['d_promesa']);
								}
							}
						} // row6
					} else if ($row['estado'] == "PROCESO" or $row['estado'] == "REPROCESO" or $row['estado'] == "ACTIVADO FLT" or $row['estado'] == "ACTIVADO MED" or $row['estado'] == "ACTIVADO GNP") {

						$objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['id']); //Folio
						$objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['fecha']);
						$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row['fgnp']);
						$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row2['tipo']); // Tipo de Agente (consolido-novel)
						$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row1['nombre']); // Agente
						$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['negocio']);
						$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['t_solicitud']);
						$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['poliza']);
						$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['movimiento']);
						$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['contratante']);
						$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['estado']);
						$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['fgnp']);
						$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['moneda']);
						$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['monedap']);
						$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['prima']);
						$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['producto']);
						$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['rango']);
						$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row['monto']);
						$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row['prioridad']);
						$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row['comentarios']);
						if ($row['usuario'] == 0) {
							$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, '-');
						} else {
							$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
							$resultado3 = mysqli_query($conexion, $sql3);
							while ($row3 = $resultado3->fetch_assoc()) {
								$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row3['nombre']);
							}
						}
						$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row4['COUNT(id)']); // Cuantos archivos hay en el folio
						$objPHPExcel->getActiveSheet()->setCellValue('W' . $fila, $row5['fechaest']); // Fecha Inicio
						$objPHPExcel->getActiveSheet()->setCellValue('X' . $fila, '-');
						if ($row['t_solicitud'] == "ALTA DE POLIZA") {
							$sql7 = "select d_promesar from rango where tiporan ='$rango'";
							$resultado7 = mysqli_query($conexion, $sql7);

							while ($row7 = $resultado7->fetch_assoc()) {
								$objPHPExcel->getActiveSheet()->setCellValue('Y' . $fila, $row7['d_promesar']);
							}
						} else {
							$sql8 = "select d_promesa from producto where producto = '$movi'";
							$resultado8 = mysqli_query($conexion, $sql8);

							while ($row8 = $resultado8->fetch_assoc()) {
								$objPHPExcel->getActiveSheet()->setCellValue('Y' . $fila, $row8['d_promesa']);
							}
						}
					}
				} // row5

				if ($row['estado'] == "ENVIADO") {

					$objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['id']); //Folio
					$objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['fecha']);
					$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row['fgnp']);
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row2['tipo']); // Tipo de Agente (consolido-novel)
					$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row1['nombre']); // Agente
					$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['negocio']);
					$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['t_solicitud']);
					$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['poliza']);
					$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['movimiento']);
					$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['contratante']);
					$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['estado']);
					$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['fgnp']);
					$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['moneda']);
					$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['monedap']);
					$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['prima']);
					$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['producto']);
					$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['rango']);
					$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row['monto']);
					$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row['prioridad']);
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row['comentarios']);
					if ($row['usuario'] == 0) {
						$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, '-');
					} else {
						$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
						$resultado3 = mysqli_query($conexion, $sql3);
						while ($row3 = $resultado3->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row3['nombre']);
						}
					}
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row4['COUNT(id)']); // Cuantos archivos hay en el folio
					$objPHPExcel->getActiveSheet()->setCellValue('W' . $fila, 'ENVIADO');
					$objPHPExcel->getActiveSheet()->setCellValue('X' . $fila, '-');
					if ($row['t_solicitud'] == "ALTA DE POLIZA") {
						$sql7 = "select d_promesar from rango where tiporan ='$rango'";
						$resultado7 = mysqli_query($conexion, $sql7);

						while ($row7 = $resultado7->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('Y' . $fila, $row7['d_promesar']);
						}
					} else {
						$sql8 = "select d_promesa from producto where producto = '$movi'";
						$resultado8 = mysqli_query($conexion, $sql8);

						while ($row8 = $resultado8->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('Y' . $fila, $row8['d_promesa']);
						}
					}
				} else if ($row['estado'] == "CANCELADO") {

					$objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['id']); //Folio
					$objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['fecha']);
					$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row['fgnp']);
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row2['tipo']); // Tipo de Agente (consolido-novel)
					$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row1['nombre']); // Agente
					$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['negocio']);
					$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['t_solicitud']);
					$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['poliza']);
					$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['movimiento']);
					$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['contratante']);
					$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['estado']);
					$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['fgnp']);
					$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['moneda']);
					$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['monedap']);
					$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['prima']);
					$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['producto']);
					$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['rango']);
					$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row['monto']);
					$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row['prioridad']);
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row['comentarios']);
					if ($row['usuario'] == 0) {
						$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, '-');
					} else {
						$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
						$resultado3 = mysqli_query($conexion, $sql3);
						while ($row3 = $resultado3->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row3['nombre']);
						}
					}
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row4['COUNT(id)']); // Cuantos archivos hay en el folio
					$objPHPExcel->getActiveSheet()->setCellValue('W' . $fila, 'CANCELADO');
					$objPHPExcel->getActiveSheet()->setCellValue('X' . $fila, '-');
					if ($row['t_solicitud'] == "ALTA DE POLIZA") {
						$sql7 = "select d_promesar from rango where tiporan ='$rango'";
						$resultado7 = mysqli_query($conexion, $sql7);

						while ($row7 = $resultado7->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('Y' . $fila, $row7['d_promesar']);
						}
					} else {
						$sql8 = "select d_promesa from producto where producto = '$movi'";
						$resultado8 = mysqli_query($conexion, $sql8);

						while ($row8 = $resultado8->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('Y' . $fila, $row8['d_promesa']);
						}
					}
				}
			} // row4
		} // row2
	} // row1  

	$fila++;
} // row



// Cabeceras para guardar y descargar en el navegador
header('Content-Type: application/vnd.ms-excel');
// Nombre del archivo
header('Content-Disposition: attachment;filename="Folios.xls"');
// Control de la cache
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// Funcion guardada y descarga
$objWriter->save('php://output');
