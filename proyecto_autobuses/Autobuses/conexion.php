<?php
	//parametors para la conexion a la base de datos
	$host = "localhost";
	$basededatos = "autobuses";
	$usuariodb = "autobuses";
	$clavedb = "12345";

	//tablas de la base de datos
	$autobuses = "autobuses";
	$facultad = "facultad";
	$prestamo = "prestamo";
	$responsable = "responsable";

	error_reporting(0);

	$conexion =  new mysqli($host,$usuariodb,$clavedb,$basededatos);

	if ($conexion->connect_errno) {
		echo "LA CONEXION EXPERIMENTA FALLOS";
		exit();
	}

?>