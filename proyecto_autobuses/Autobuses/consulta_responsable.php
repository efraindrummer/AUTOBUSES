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
		<title>CONSULTA RESPONSABLE</title>
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
			<h3>RESPONSABLE</h3>
			</div>
		</header>

		<section>
			<table class="col-md-12">
            
            <table width=\"100%\" border=\"1\">
				<tr class="bg-primary">
					<th class="pad-basic">CLAVE DE LA PERSONA</th>
					<th class="pad-basic">NOMBRE</th>
                    <th class="pad-basic">APELLIDO</th>
                    <th class="pad-basic">NUMERO DE FAULTAD AL QUE PERTENECE</th>
				<tr>

				<?php
				$query="SELECT * FROM responsable";
				$consulta=$conexion->query($query);
				while ($fila=$consulta->fetch(PDO::FETCH_ASSOC))
					{
                        echo'
                        <tr>
						<td>'.$fila['CVE_PERSONA'].'</td>
                        <td>'.$fila['NOM_PERSONA'].'</td>
                        <td>'.$fila['APE_PERSONA'].'</td>
                        <td>'.$fila['ID_FACULTAD'].'</td>
                        </tr>
                        
						';
					}
				?>
			</table>
		</section>
		<center>
		<br><br>
		<input type="button" value="REGRESAR" class="btn btn-primary" onclick="location.href='responsable.php' "name="atras"/>
	    </center>
</body>
</html>