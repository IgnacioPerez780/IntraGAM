<?php


	function conexion()
	{
		$servidor="localhost";
		$usuario="gamse627_sistema";
		$password="SdbS8GzT780";
		$bd="gamse627_ventanasis";
		//Abre la conexion al servidor que ejecuta el equipo anfitrion 
		$conexion=mysqli_connect($servidor,$usuario,$password,$bd ) or die("error");
		//Establece el conjunto de caracteres predeterminado del cliente
		$conexion->set_charset("utf8");
		return $conexion;
	}
?>
<?php
	function conexion2()
	{
		$servidor2="localhost";
		$usuario2="root";
		$password2="";
		$bd2="entrevista";
		$conexion2=mysqli_connect($servidor2,$usuario2,$password2,$bd2)or die("error");

		return $conexion2;
	}
?>
