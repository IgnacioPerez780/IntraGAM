<?php

error_reporting(0);
require 'Classes/PHPExcel.php';
include 'app/conexion.php';
$conexion = conexion();

// Consulta de los parametros seleccionados - Consulta 1
$sql = "SELECT * FROM folios_g WHERE fecha BETWEEN '2022-01-01 00:00:00.000000' AND '2023-12-31 23:59:59.000000' ORDER BY id";
// Ejecutamos la consulta
$resultado = mysqli_query($conexion, $sql);

// En que fila se inicia a escribir el reporte
$fila = 2;

// Inicia el phpExcel
$objPHPExcel = new PHPExcel();
// Propiedades basicas - getProperties-quien lo creo/setDescription-descripcion 
$objPHPExcel->getProperties()->setCreator("REPORTE INTRAGAM")->setDescription("REPORTE TOTAL");
// En que pestania staremos trabajando
$objPHPExcel->setActiveSheetIndex(0);
// Establecemos titulo de la pestania
$objPHPExcel->getActiveSheet()->setTitle("FOLIOS");

// Encabezados para el reporte
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'FOLIO');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'FECHA DE SOLICITUD');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'T_AGENTE');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'AGENTE');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'NEGOCIO');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'SOLICITUD');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'PRODUCTO');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'POLIZA');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'FGNP');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'PRIMA');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'CONTRATANTE');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'PRIORIDAD');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'MOTIVO');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'COMENTARIO');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'ESTADO');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'USUARIO');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'ARCHIVOS');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'FECHA INICIO');
$objPHPExcel->getActiveSheet()->setCellValue('S1', 'FECHA TERMINO');
$objPHPExcel->getActiveSheet()->setCellValue('T1', 'DIAS ESTANDAR');
$objPHPExcel->getActiveSheet()->setCellValue('U1', 'GDD');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray($boldArray);

// Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(26);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(36);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(65);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(66);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(23);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(34);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(25);

//Imprimimos resultados de la primera consulta
while ($row = $resultado->fetch_assoc()) {

	$id = $row['agente'];
	$folio = $row['id'];
	$usuario = $row['usuario'];

	//Query muestra cuantos archivos hay en cada folio
	$sql4 = "SELECT COUNT(id) FROM archivos_g WHERE fk_folio ='$folio;'";
	$resultado4 = mysqli_query($conexion, $sql4);
	while ($row4 = $resultado4->fetch_assoc()) {

		//Query muestra la fecha en la que se cambio de estado enviado a cualquiera estado menos terminado o terminado/p
		$sql5 = "SELECT fechaest FROM promesa_g WHERE folio='$folio;'";
		$resultado5 = mysqli_query($conexion, $sql5);
		while ($row5 = $resultado5->fetch_assoc()) {

			if ($row['estado'] == "TERMINADO" or $row['estado'] == "TERMINADO CON POLIZA") {

				//Query que muestra la fecha del cambio de estado de los estados terminado o terminado/p
				$sql6 = "SELECT cd_estado_g FROM cam_estado_g WHERE folio_g = '$folio;' ";
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
					$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['negocio']);
					$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['t_solicitud']);
					$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['producto']);
					$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['poliza']);
					$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['fgnp']);
					$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['prima']);
					$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['contratante']);
					$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['prioridad']);
					$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['motivo']);
					$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['comentario']);
					$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['estado']);
					if ($row['usuario'] == 0) {
						$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, '-');
					} else {
						$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
						$resultado3 = mysqli_query($conexion, $sql3);
						while ($row3 = $resultado3->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row3['nombre']);
						}
					}
					$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row4['COUNT(id)']);
					$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row5['fechaest']);
					$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, $row6['cd_estado_g']);
					if ($row['t_solicitud'] == "ALTA POLIZA NACIONAL") {
						$sql7 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 1";
						$resultado7 = mysqli_query($conexion, $sql7);
						while ($row7 = $resultado7->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row7['d_promesa']);
						}
					} else if ($row['t_solicitud'] == "ALTA POLIZA INTERNACIONAL") {
						$sql8 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 2";
						$resultado8 = mysqli_query($conexion, $sql8);
						while ($row8 = $resultado8->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row8['d_promesa']);
						}
					} else {
						$sql9 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 3";
						$resultado9 = mysqli_query($conexion, $sql9);
						while ($row9 = $resultado9->fetch_assoc()) {
							$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row9['d_promesa']);
						}
					}
					$sql10 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
					$resultado10 = mysqli_query($conexion, $sql10);
					while ($row10 = $resultado10->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row10['nombre']);
					}
				}
			} else if ($row['estado'] == "PROCESO" or $row['estado'] == "REPROCESO" or $row['estado'] == "ACTIVADO FLT" or $row['estado'] == "ACTIVADO MED" or $row['estado'] == "ACTIVADO GNP" or $row['estado'] == "CASO ESPECIAL") {

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
				$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['negocio']);
				$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['t_solicitud']);
				$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['producto']);
				$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['poliza']);
				$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['fgnp']);
				$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['prima']);
				$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['contratante']);
				$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['prioridad']);
				$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['motivo']);
				$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['comentario']);
				$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['estado']);
				if ($row['usuario'] == 0) {
					$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, '-');
				} else {
					$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
					$resultado3 = mysqli_query($conexion, $sql3);
					while ($row3 = $resultado3->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row3['nombre']);
					}
				}
				$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row4['COUNT(id)']);
				$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, $row5['fechaest']);
				$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, '-');
				if ($row['t_solicitud'] == "ALTA POLIZA NACIONAL") {
					$sql7 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 1";
					$resultado7 = mysqli_query($conexion, $sql7);
					while ($row7 = $resultado7->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row7['d_promesa']);
					}
				} else if ($row['t_solicitud'] == "ALTA POLIZA INTERNACIONAL") {
					$sql8 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 2";
					$resultado8 = mysqli_query($conexion, $sql8);
					while ($row8 = $resultado8->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row8['d_promesa']);
					}
				} else {
					$sql9 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 3";
					$resultado9 = mysqli_query($conexion, $sql9);
					while ($row9 = $resultado9->fetch_assoc()) {
						$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row9['d_promesa']);
					}
				}

				$sql10 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
				$resultado10 = mysqli_query($conexion, $sql10);
				while ($row10 = $resultado10->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row10['nombre']);
				}
			}
		}

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
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['negocio']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['t_solicitud']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['producto']);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['poliza']);
			$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['fgnp']);
			$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['prima']);
			$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['contratante']);
			$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['prioridad']);
			$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['motivo']);
			$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['comentario']);
			$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['estado']);
			if ($row['usuario'] == 0) {
				$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, '-');
			} else {
				$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
				$resultado3 = mysqli_query($conexion, $sql3);
				while ($row3 = $resultado3->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row3['nombre']);
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row4['COUNT(id)']);
			$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, '-');
			$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, '-');
			if ($row['t_solicitud'] == "ALTA POLIZA NACIONAL") {
				$sql7 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 1";
				$resultado7 = mysqli_query($conexion, $sql7);
				while ($row7 = $resultado7->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row7['d_promesa']);
				}
			} else if ($row['t_solicitud'] == "ALTA POLIZA INTERNACIONAL") {
				$sql8 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 2";
				$resultado8 = mysqli_query($conexion, $sql8);
				while ($row8 = $resultado8->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row8['d_promesa']);
				}
			} else {
				$sql9 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 3";
				$resultado9 = mysqli_query($conexion, $sql9);
				while ($row9 = $resultado9->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row9['d_promesa']);
				}
			}

			$sql10 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
			$resultado10 = mysqli_query($conexion, $sql10);
			while ($row10 = $resultado10->fetch_assoc()) {
				$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row10['nombre']);
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
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['negocio']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['t_solicitud']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['producto']);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['poliza']);
			$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['fgnp']);
			$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['prima']);
			$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['contratante']);
			$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['prioridad']);
			$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['motivo']);
			$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['comentario']);
			$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['estado']);
			if ($row['usuario'] == 0) {
				$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, '-');
			} else {
				$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$usuario'";
				$resultado3 = mysqli_query($conexion, $sql3);
				while ($row3 = $resultado3->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row3['nombre']);
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row4['COUNT(id)']);
			$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, '-');
			$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, '-');
			if ($row['t_solicitud'] == "ALTA POLIZA NACIONAL") {
				$sql7 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 1";
				$resultado7 = mysqli_query($conexion, $sql7);
				while ($row7 = $resultado7->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row7['d_promesa']);
				}
			} else if ($row['t_solicitud'] == "ALTA POLIZA INTERNACIONAL") {
				$sql8 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 2";
				$resultado8 = mysqli_query($conexion, $sql8);
				while ($row8 = $resultado8->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row8['d_promesa']);
				}
			} else {
				$sql9 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 3";
				$resultado9 = mysqli_query($conexion, $sql9);
				while ($row9 = $resultado9->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row9['d_promesa']);
				}
			}

			$sql10 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
			$resultado10 = mysqli_query($conexion, $sql10);
			while ($row10 = $resultado10->fetch_assoc()) {
				$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row10['nombre']);
			}
		} else if ($row['estado'] == "RECHAZO DE SUSCRIPCION") {

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
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['negocio']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['t_solicitud']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['producto']);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['poliza']);
			$objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['fgnp']);
			$objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['prima']);
			$objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['contratante']);
			$objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['prioridad']);
			$objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['motivo']);
			$objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['comentario']);
			$objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['estado']);
			if ($row['usuario'] == 0) {
				$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, '-');
			} else {
				$sql3 = "SELECT nombre FROM datos_operativos WHERE id = '$idu'";
				$resultado3 = mysqli_query($conexion, $sql3);
				while ($row3 = $resultado3->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row3['nombre']);
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row4['COUNT(id)']);
			$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, '-');
			$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila, '-');
			if ($row['t_solicitud'] == "ALTA POLIZA NACIONAL") {
				$sql7 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 1";
				$resultado7 = mysqli_query($conexion, $sql7);
				while ($row7 = $resultado7->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row7['d_promesa']);
				}
			} else if ($row['t_solicitud'] == "ALTA POLIZA INTERNACIONAL") {
				$sql8 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 2";
				$resultado8 = mysqli_query($conexion, $sql8);
				while ($row8 = $resultado8->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row8['d_promesa']);
				}
			} else {
				$sql9 = "SELECT d_promesa FROM producto_gmm WHERE tipo_solicitud = 3";
				$resultado9 = mysqli_query($conexion, $sql9);
				while ($row9 = $resultado9->fetch_assoc()) {
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila, $row9['d_promesa']);
				}
			}

			$sql10 = "SELECT nombre FROM datos_operativos WHERE id = '$gdd'";
			$resultado10 = mysqli_query($conexion, $sql10);
			while ($row10 = $resultado10->fetch_assoc()) {
				$objPHPExcel->getActiveSheet()->setCellValue('U' . $fila, $row10['nombre']);
			}
		}
	} // row4


	$fila++;
} // row

// Cabeceras para guardar y descargar en el navegador
header('Content-Type: application/vnd.ms-excel');
// Nombre del archivo
header('Content-Disposition: attachment;filename="FoliosGMM.xls"');
// Control de la cache
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// Funcion guardada y descarga
$objWriter->save('php://output');
