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
		<title>CONSULTA PRESTAMO</title>
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
			<h3>PRESTAMO</h3>
			</div>
		</header>

		<section>
			<table class="col-md-12">
            
            <table width=\"100%\" border=\"1\">
				<tr class="bg-primary">
					<th class="pad-basic">NUMERO DE AUTOBUS</th>
					<th class="pad-basic">FECHA_PRESTAMO</th>
                    <th class="pad-basic">FECHA_INICIO</th>
                    <th class="pad-basic">HORA_INICIO</th>
                    <th class="pad-basic">FECHA_FIN</th>
                    <th class="pad-basic">HORA_FIN</th>
                    <th class="pad-basic">ORIGEN</th>
                    <th class="pad-basic">DESTINO</th>
                    <th class="pad-basic">CLAVE DE LA PERSONA</th>
				<tr>

				<?php
				$query="SELECT * FROM prestamo";
				$consulta=$conexion->query($query);
				while ($fila=$consulta->fetch(PDO::FETCH_ASSOC))
					{
                        echo'
                        <tr>
						<td>'.$fila['NO_AUTOBUS'].'</td>
                        <td>'.$fila['F_PRESTAMO'].'</td>
                        <td>'.$fila['F_INICIO'].'</td>
                        <td>'.$fila['HORA_INICIO'].'</td>
                        <td>'.$fila['F_FIN'].'</td>
                        <td>'.$fila['HORA_FIN'].'</td>
                        <td>'.$fila['ORIGEN'].'</td>
                        <td>'.$fila['DESTINO'].'</td>
                        <td>'.$fila['CVE_PERSONA'].'</td>
                        </tr>
                        
						';
					}
				?>
			</table>
		</section>
		<center>
		<br><br>
		<input type="button" value="REGRESAR" class="btn btn-primary" onclick="location.href='prestamo.php' "name="atras"/>
	    </center>
</body>
</html>