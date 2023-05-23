<?php

error_reporting(0);
require 'Classes/PHPExcel.php';
include 'app/conexion.php';
$conexion = conexion();

// Consulta de los parametros seleccionados - Consulta 1
$sql = "SELECT * FROM folios_s WHERE fecha BETWEEN '2022-01-01 00:00:00.000000' AND '2023-12-31 23:59:59.000000' ORDER BY id";
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
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'T_AGENTE');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'AGENTE');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'LINEA_S');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'TIPO_SOL');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'TOTAL');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'GASTOS');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'MONTO');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'CONTRATANTE');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'AFECTADO');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'N_POLIZA');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'N_SINIESTRO');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'N_QR');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'N_RECLAMACION');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'N_FOLIO');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'ESTADO');
$objPHPExcel->getActiveSheet()->setCellValue('S1', 'FECHA TERMINO');
$objPHPExcel->getActiveSheet()->setCellValue('T1', 'USUARIO');
$objPHPExcel->getActiveSheet()->setCellValue('U1', 'ARCHIVOS');
$objPHPExcel->getActiveSheet()->setCellValue('V1', 'GDD');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
$objPHPExcel->getActiveSheet()->getStyle('A1:V1')->applyFromArray($boldArray);


// Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(58);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(37);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(87);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(43);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(31);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(29);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(66);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(22);


while ($row = $resultado->fetch_assoc()) {

	$id = $row['id_agente'];
	$folio = $row['id'];
	$tipo = $row['tipo_sol'];
	$usuario = $row['usuario'];

	$sql1 = "select nombre, id_tipo_agente, gdd from datos_agente where id = '$id'";
	$resultado1 = mysqli_query($conexion, $sql1);
	while ($row1 = $resultado1->fetch_assoc()) {
		$tipo = $row1['id_tipo_agente'];
		$gdd = $row1['gdd'];

		$sql2 = "select tipo from tipo_agente where id = '$tipo'";
		$resultado2 = mysqli_query($conexion, $sql2);
		while ($row2 = $resultado2->fetch_assoc()) {

			$sql4 = "SELECT COUNT(id) FROM archivos_s WHERE fk_folio ='$folio;'";
			$resultado4 = mysqli_query($conexion, $sql4);
			while ($row4 = $resultado4->fetch_assoc()) {

				$objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['id']);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['fecha']);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row2['tipo']);
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row1['nombre']);
				$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['linea_s']);
				$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['tipo_sol']);
				$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['total']);
				$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['gastos_no']);
				$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['monto_pro']);
				$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['contratante']);
				$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['afectado']);
				$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['n_poliza']);
				$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['n_siniestro']);
				$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['n_qr']);
				$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['n_reclamacion']);
				$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['n_folio']);
				$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['descripcion']);
				$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row['estado']);
				$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row['fecha_cam_estado']);

				if ($row['usuario'] == 0) {
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, '-');
				} else {
					//Query muestra el nombre de la primera persona que le dio ingreso - 0 es el agente
					$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$usuario'";
					$resultado3 = mysqli_query($conexion, $sql3);
					while ($row3 = $resultado3->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row3['nombre']);
					}
				}
				$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row4['COUNT(id)']);

				//Muestra el nombre del gdd
				$sql5 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
				$resultado5 = mysqli_query($conexion, $sql5);
				while ($row5 = $resultado5->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row5['nombre']);
				}
			} // row4
		} // row2

	} // row1

	$fila++;
} // row

// Cabeceras para guardar y descargar en el navegador
header('Content-Type: application/vnd.ms-excel');
// Nombre del archivo
header('Content-Disposition: attachment;filename="FoliosSiniestros.xls"');
// Control de la cache
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// Funcion guardada y descarga
$objWriter->save('php://output');
