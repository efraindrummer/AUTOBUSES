<?php

	$host = "localhost";
	$basededatos = "autobuses";
	$usuariodb = "autobuses";
	$clavedb = "12345";
    
    try{
        $conexion = new PDO('mysql:host='.$host.';dbname='.$basededatos, $usuariodb, $clavedb);
    }catch (PDOException $e){
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }

?>

<html lang="es">
	<head> 
		<title>CONSULTA DE AUTOBUSES</title>
		<style>
		body{
			background-image: url("fondo1.jpg");
		}
		</style>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
	</head>
	<body>
		<header>
			<div class="alert alert-info">
			<h3>AUTOBUSES</h3>
			</div>
		</header>

		<section>
			<table class="col-md-12">
            
            <table width=\"100%\" border=\"1\">
				<tr class="bg-primary">
					<th class="pad-basic">NUMERO AUTOBUS</th>
					<th class="pad-basic">MARCA</th>
					<th class="pad-basic">TIPO</th>
					<th class="pad-basic">PLAZAS</th>
				<tr>

				<?php
				$query="SELECT * FROM autobuses";
				$consulta=$conexion->query($query);
				while ($fila=$consulta->fetch(PDO::FETCH_ASSOC))
					{
                        echo'
                        
                        <tr>
						<td>'.$fila['NO_AUTOBUS'].'</td>
						<td>'.$fila['MARCA'].'</td>
						<td>'.$fila['TIPO'].'</td>
						<td>'.$fila['PLAZAS'].'</td>
                        </tr>
                        
						';
					}
				?>
			</table>
		</section>
		<center>
		<br><br>
		<input type="button" value="REGRESAR" class="btn btn-primary" onclick="location.href='autobuses.php' "name="atras"/>
	    </center>
</body>
</html>