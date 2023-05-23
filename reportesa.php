<?php

error_reporting(0);
require 'Classes/PHPExcel.php';
include 'app/conexion.php';
$conexion = conexion();

// Consulta de los parametros seleccionados - Consulta 1
$sql = "SELECT * FROM folios_a WHERE fecha BETWEEN '2022-01-01 00:00:00.000000' AND '2023-12-31 23:59:59.000000' ORDER BY id";
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
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'TELEFONO');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'NEGOCIO');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'SOLICITUD');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'PRODUCTO');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'N_RESOLUCION');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'CONTRATANTE');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'POLIZA');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'FGNP');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'PRIORIDAD');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'MOTIVO');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'DESRIPCION DE MOTIVO');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'COMENTARIO');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'ESTADO');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'USUARIO');
$objPHPExcel->getActiveSheet()->setCellValue('S1', 'ARCHIVOS');
$objPHPExcel->getActiveSheet()->setCellValue('T1', 'FECHA INICIO');
$objPHPExcel->getActiveSheet()->setCellValue('U1', 'FECHA TERMINO');
$objPHPExcel->getActiveSheet()->setCellValue('V1', 'DIAS ESTANDAR');
$objPHPExcel->getActiveSheet()->setCellValue('W1', 'GDD');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray($boldArray);

// Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(41);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(62);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(66);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(66);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25);


while ($row = $resultado->fetch_assoc()) {

	$id = $row['agente'];
	$idu = $row['usuario'];
	$folio = $row['id'];

	//Query muestra cuantos archivos hay en cada folio
	$sql4 = "SELECT COUNT(id) FROM archivos_a WHERE fk_folio ='$folio'";
	$resultado4 = mysqli_query($conexion, $sql4);
	while ($row4 = $resultado4->fetch_assoc()) {

		//Query muestra la fecha en la que se cambio de estado enviado a cualquiera estado menos terminado o terminado/p
		$sql5 = "select fechaest from promesa_a where folio = '$folio'";
		$resultado5 = mysqli_query($conexion, $sql5);

		while ($row5 = $resultado5->fetch_assoc()) {

			if ($row['estado'] == "TERMINADO") {

				//Query que muestra la fecha del cambio de estado de los estados terminado o terminado/p
				$sql6 = "SELECT cd_estado_a FROM cam_estado_a where folio_a = '$folio' ";
				$resultado6 = mysqli_query($conexion, $sql6);

				while ($row6 = $resultado6->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['id']);
					$objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['fecha']);
					if ($row['agente'] == 0) {
						$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, '-');
						$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, '-');
					} else {
						//Query muestra el nombre, si el agente es 1-2 y el gdd que tiene el agente
						$sql1 = "SELECT nombre, id_tipo_agente, gdd FROM datos_agente WHERE id = '$id'";
						$resultado1 = mysqli_query($conexion, $sql1);
						while ($row1 = $resultado1->fetch_assoc()) {
							$tipo = $row1['id_tipo_agente'];
							$gdd = $row1['gdd'];

							//Query muestra los tipos que hay de agente novel (1) - consolidado (2)
							$sql2 = "SELECT tipo FROM tipo_agente WHERE id = '$tipo'";
							$resultado2 = mysqli_query($conexion, $sql2);
							while ($row2 = $resultado2->fetch_assoc()) {
								$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row2['tipo']);
							} // row2
							$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row1['nombre']);
						} // row1
					}
					$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['telefono']);
					$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['negocio']);
					$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['t_solicitud']);
					$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['producto']);
					$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['n_resolucion']);
					$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['contratante']);
					$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['poliza']);
					$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['fgnp']);
					$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['prioridad']);
					$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['motivo']);
					$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['descripcion']);
					$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['comentarios']);
					$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['estado']);
					if ($row['usuario'] == 0) {
						$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, '-');
					} else {
						$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
						$resultado3 = mysqli_query($conexion, $sql3);
						while ($row3 = $resultado3->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row3['nombre']);
						} // row3
					}
					$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row4['COUNT(id)']);
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row5['fechaest']);
					$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row6['cd_estado_a']);

					if ($row['t_solicitud'] == "NUEVO NEGOCIO") {
						$sql7 = "SELECT d_promesa FROM producto_autos WHERE tipo_solicitud = 1";
						$resultado7 = mysqli_query($conexion, $sql7);
						while ($row7 = $resultado7->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row7['d_promesa']);
						}
					} else {
						$sql8 = "SELECT d_promesa FROM producto_autos WHERE tipo_solicitud = 2";
						$resultado8 = mysqli_query($conexion, $sql8);
						while ($row8 = $resultado8->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row8['d_promesa']);
						}
					}

					$sql9 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
					$resultado9 = mysqli_query($conexion, $sql9);
					while ($row9 = $resultado9->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('W' . $fila, $row9['nombre']);
					} // row9

				} // row6
			} else if ($row['estado'] == "PROCESO") {
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['id']);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['fecha']);
				if ($row['agente'] == 0) {
					$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, '-');
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, '-');
				} else {
					//Query muestra el nombre, si el agente es 1-2 y el gdd que tiene el agente
					$sql1 = "SELECT nombre, id_tipo_agente, gdd FROM datos_agente WHERE id = '$id'";
					$resultado1 = mysqli_query($conexion, $sql1);
					while ($row1 = $resultado1->fetch_assoc()) {
						$tipo = $row1['id_tipo_agente'];
						$gdd = $row1['gdd'];

						//Query muestra los tipos que hay de agente novel (1) - consolidado (2)
						$sql2 = "SELECT tipo FROM tipo_agente WHERE id = '$tipo'";
						$resultado2 = mysqli_query($conexion, $sql2);
						while ($row2 = $resultado2->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row2['tipo']);
						} // row2
						$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row1['nombre']);
					} // row1
				}
				$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['telefono']);
				$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['negocio']);
				$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['t_solicitud']);
				$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['producto']);
				$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['n_resolucion']);
				$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['contratante']);
				$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['poliza']);
				$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['fgnp']);
				$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['prioridad']);
				$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['motivo']);
				$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['descripcion']);
				$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['comentarios']);
				$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['estado']);
				if ($row['usuario'] == 0) {
					$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, '-');
				} else {
					$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
					$resultado3 = mysqli_query($conexion, $sql3);
					while ($row3 = $resultado3->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row3['nombre']);
					} // row3
				}
				$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row4['COUNT(id)']);
				$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row5['fechaest']);
				$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, '-');
				if ($row['t_solicitud'] == "NUEVO NEGOCIO") {
					$sql7 = "SELECT d_promesa FROM producto_autos WHERE tipo_solicitud = 1";
					$resultado7 = mysqli_query($conexion, $sql7);
					while ($row7 = $resultado7->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row7['d_promesa']);
					}
				} else {
					$sql8 = "SELECT d_promesa FROM producto_autos WHERE tipo_solicitud = 2";
					$resultado8 = mysqli_query($conexion, $sql8);
					while ($row8 = $resultado8->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row8['d_promesa']);
					}
				}

				$sql9 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
				$resultado9 = mysqli_query($conexion, $sql9);
				while ($row9 = $resultado9->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('W' . $fila, $row9['nombre']);
				}
			}
		} // row5

		if ($row['estado'] == "ENVIADO") {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['fecha']);
			if ($row['agente'] == 0) {
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, '-');
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, '-');
			} else {
				//Query muestra el nombre, si el agente es 1-2 y el gdd que tiene el agente
				$sql1 = "SELECT nombre, id_tipo_agente, gdd FROM datos_agente WHERE id = '$id'";
				$resultado1 = mysqli_query($conexion, $sql1);
				while ($row1 = $resultado1->fetch_assoc()) {
					$tipo = $row1['id_tipo_agente'];
					$gdd = $row1['gdd'];

					//Query muestra los tipos que hay de agente novel (1) - consolidado (2)
					$sql2 = "SELECT tipo FROM tipo_agente WHERE id = '$tipo'";
					$resultado2 = mysqli_query($conexion, $sql2);
					while ($row2 = $resultado2->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row2['tipo']);
					} // row2
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row1['nombre']);
				} // row1
			}
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['telefono']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['negocio']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['t_solicitud']);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['producto']);
			$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['n_resolucion']);
			$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['contratante']);
			$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['poliza']);
			$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['fgnp']);
			$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['prioridad']);
			$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['motivo']);
			$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['descripcion']);
			$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['comentarios']);
			$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['estado']);
			if ($row['usuario'] == 0) {
				$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, '-');
			} else {
				$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
				$resultado3 = mysqli_query($conexion, $sql3);
				while ($row3 = $resultado3->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row3['nombre']);
				} // row3
			}
			$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row4['COUNT(id)']);
			$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, '-');
			$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, '-');
			if ($row['t_solicitud'] == "NUEVO NEGOCIO") {
				$sql7 = "SELECT d_promesa FROM producto_autos WHERE tipo_solicitud = 1";
				$resultado7 = mysqli_query($conexion, $sql7);
				while ($row7 = $resultado7->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row7['d_promesa']);
				}
			} else {
				$sql8 = "SELECT d_promesa FROM producto_autos WHERE tipo_solicitud = 2";
				$resultado8 = mysqli_query($conexion, $sql8);
				while ($row8 = $resultado8->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row8['d_promesa']);
				}
			}

			$sql9 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
			$resultado9 = mysqli_query($conexion, $sql9);
			while ($row9 = $resultado9->fetch_assoc()) {
				$objPHPExcel->getActiveSheet()->setCellValue('W' . $fila, $row9['nombre']);
			}
		} else if ($row['estado'] == "CANCELADO") {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['fecha']);
			if ($row['agente'] == 0) {
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, '-');
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, '-');
			} else {
				//Query muestra el nombre, si el agente es 1-2 y el gdd que tiene el agente
				$sql1 = "SELECT nombre, id_tipo_agente, gdd FROM datos_agente WHERE id = '$id'";
				$resultado1 = mysqli_query($conexion, $sql1);
				while ($row1 = $resultado1->fetch_assoc()) {
					$tipo = $row1['id_tipo_agente'];
					$gdd = $row1['gdd'];

					//Query muestra los tipos que hay de agente novel (1) - consolidado (2)
					$sql2 = "SELECT tipo FROM tipo_agente WHERE id = '$tipo'";
					$resultado2 = mysqli_query($conexion, $sql2);
					while ($row2 = $resultado2->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row2['tipo']);
					} // row2
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row1['nombre']);
				} // row1
			}
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['telefono']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['negocio']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['t_solicitud']);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['producto']);
			$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['n_resolucion']);
			$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['contratante']);
			$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['poliza']);
			$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['fgnp']);
			$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['prioridad']);
			$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['motivo']);
			$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['descripcion']);
			$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['comentarios']);
			$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['estado']);
			if ($row['usuario'] == 0) {
				$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, '-');
			} else {
				$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
				$resultado3 = mysqli_query($conexion, $sql3);
				while ($row3 = $resultado3->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row3['nombre']);
				} // row3
			}
			$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row4['COUNT(id)']);
			$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, '-');
			$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, '-');
			if ($row['t_solicitud'] == "NUEVO NEGOCIO") {
				$sql7 = "SELECT d_promesa FROM producto_autos WHERE tipo_solicitud = 1";
				$resultado7 = mysqli_query($conexion, $sql7);
				while ($row7 = $resultado7->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row7['d_promesa']);
				}
			} else {
				$sql8 = "SELECT d_promesa FROM producto_autos WHERE tipo_solicitud = 2";
				$resultado8 = mysqli_query($conexion, $sql8);
				while ($row8 = $resultado8->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row8['d_promesa']);
				}
			}
			$sql9 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
			$resultado9 = mysqli_query($conexion, $sql9);
			while ($row9 = $resultado9->fetch_assoc()) {
				$objPHPExcel->getActiveSheet()->setCellValue('W' . $fila, $row9['nombre']);
			}
		} else if ($row['estado'] == "INCOMPLETO") {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['fecha']);
			if ($row['agente'] == 0) {
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, '-');
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, '-');
			} else {
				//Query muestra el nombre, si el agente es 1-2 y el gdd que tiene el agente
				$sql1 = "SELECT nombre, id_tipo_agente, gdd FROM datos_agente WHERE id = '$id'";
				$resultado1 = mysqli_query($conexion, $sql1);
				while ($row1 = $resultado1->fetch_assoc()) {
					$tipo = $row1['id_tipo_agente'];
					$gdd = $row1['gdd'];

					//Query muestra los tipos que hay de agente novel (1) - consolidado (2)
					$sql2 = "SELECT tipo FROM tipo_agente WHERE id = '$tipo'";
					$resultado2 = mysqli_query($conexion, $sql2);
					while ($row2 = $resultado2->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row2['tipo']);
					} // row2
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row1['nombre']);
				} // row1
			}
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['telefono']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['negocio']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['t_solicitud']);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['producto']);
			$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['n_resolucion']);
			$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['contratante']);
			$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['poliza']);
			$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['fgnp']);
			$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['prioridad']);
			$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['motivo']);
			$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['descripcion']);
			$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['comentarios']);
			$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['estado']);
			if ($row['usuario'] == 0) {
				$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, '-');
			} else {
				$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
				$resultado3 = mysqli_query($conexion, $sql3);
				while ($row3 = $resultado3->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row3['nombre']);
				} // row3
			}
			$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row4['COUNT(id)']);
			$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, '-');
			$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, '-');
			if ($row['t_solicitud'] == "NUEVO NEGOCIO") {
				$sql7 = "SELECT d_promesa FROM producto_autos WHERE tipo_solicitud = 1";
				$resultado7 = mysqli_query($conexion, $sql7);
				while ($row7 = $resultado7->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row7['d_promesa']);
				}
			} else {
				$sql8 = "SELECT d_promesa FROM producto_autos WHERE tipo_solicitud = 2";
				$resultado8 = mysqli_query($conexion, $sql8);
				while ($row8 = $resultado8->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $fila, $row8['d_promesa']);
				}
			}
			$sql9 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
			$resultado9 = mysqli_query($conexion, $sql9);
			while ($row9 = $resultado9->fetch_assoc()) {
				$objPHPExcel->getActiveSheet()->setCellValue('W' . $fila, $row9['nombre']);
			}
		}
	} // row4
	$fila++;
} // row


// Cabeceras para guardar y descargar en el navegador
header('Content-Type: application/vnd.ms-excel');
// Nombre del archivo
header('Content-Disposition: attachment;filename="FoliosAutos.xls"');
// Control de la cache
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// Funcion guardada y descarga
$objWriter->save('php://output');
