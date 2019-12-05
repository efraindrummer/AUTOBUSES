<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PRESTAMO</title>
    <style>
        body{
            background-image: url("autobus.png");
        }
    </style>
</head>
<body>
<div class="row">
  	<div class="col-md-4"></div>
  	<div class="col-md-5">
  	<center><h2>Responsable</h2></center>

  	<form method="POST" action="prestamo.php" class="form-inline">
  		
  	<center>
  		<br>
  		<div class="form-group">
      		<label for="NO_AUTOBUS">NO_AUTOBUS:</label>
			<input type="text" placeholder="Introduce el numero de autobus..." name="NO_AUTOBUS" class="form-control" id="NO_AUTOBUS" size="65px">
		</div>
		<br>
		<div class="form-group">
      		<label for="F_PRESTAMO">FECHA DE PRESTAMO:</label>
			<input type="date" name="F_PRESTAMO" class="form-control" id="F_PRESTAMO">
		</div>
        <br>
  		<div class="form-group">
      		<label for="F_INICIO">FECHA__DE__INICIO:</label>
			<input type="date" name="F_INICIO" class="form-control" id="F_INICIO">
		</div>
		<br>
		<div class="form-group">
      		<label for="HORA_INICIO">-------HORA__DE_INICIO:</label>
			<input type="time" name="HORA_INICIO" class="form-control" id="HORA_INICIO">
		</div>
        <br>
        <div class="form-group">
      		<label for="F_FIN">------------FECHA_FIN:</label>
			<input type="date" name="F_FIN" class="form-control" id="F_FIN">
		</div>
        <br>
        <div class="form-group">
      		<label for="HORA_FIN">---------HORA FIN:</label>
			<input type="time" name="HORA_FIN" class="form-control" id="HORA_FIN">
		</div>
        <br>
        <div class="form-group">
      		<label for="ORIGEN">ORIGEN:</label>
			<input type="text" placeholder="introduce el origen de procedencia...." name="ORIGEN" class="form-control" id="ORIGEN" size="72px">
		</div>
        <br>
        <div class="form-group">
      		<label for="DESTINO">DESTINO:</label>
			<input type="text" placeholder="Introduce el destino al ir..." name="DESTINO" class="form-control" id="DESTINO" size="71px">
		</div>
        <br>
        <div class="form-group">
      		<label for="CVE_PERSONA">CLAVE DE LA PERSONA:</label>
			<input type="text" placeholder="Introduce la clave de la persona..." name="CVE_PERSONA" class="form-control" id="CLAVE_PERSONA" size="55px">
		</div>
  		</center>

  		<center>
  			<br><br>
  			<input type="submit" value="ENVIAR" class="btn btn-primary" name="btn_enviar">
			<input type="button" value="CONSULTA" class="btn btn-info" onclick="location.href='consulta_prestamo.php' "name="tabla"/> 
  		</center>
  	</form>

	<?php
		
		if(isset($_POST['btn_enviar'])){

            include("conexion.php");

            $NO_AUTOBUS = $_POST['NO_AUTOBUS'];
            $F_PRESTAMO = $_POST['F_PRESTAMO'];
            $F_INICIO = $_POST['F_INICIO'];
			$HORA_INICIO = $_POST['HORA_INICIO'];
			$F_FIN = $_POST['F_FIN'];
			$HORA_FIN = $_POST['HORA_FIN'];
			$ORIGEN = $_POST['ORIGEN'];
			$DESTINO = $_POST['DESTINO'];
			$CVE_PERSONA = $_POST['CVE_PERSONA'];

            $conexion->query("INSERT INTO $prestamo (NO_AUTOBUS,F_PRESTAMO,F_INICIO,HORA_INICIO,F_FIN,HORA_FIN,ORIGEN,DESTINO,CVE_PERSONA) values ('$NO_AUTOBUS','$F_PRESTAMO','$F_INICIO','$HORA_INICIO','$F_FIN','$HORA_FIN','$ORIGEN','$DESTINO','$CVE_PERSONA')");
            echo "LOS DATOS FUERON ENVIADOS CORRECTAMENTE";

            include("cerrar.php");
        }
	
	?>  
    
</body>
</html>