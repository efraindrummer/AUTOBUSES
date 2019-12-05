<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Autobuses</title>
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
  	<center><h2>Autobuses</h2></center>

  	<form method="POST" action="autobuses.php" class="form-inline">
  		
  	<center>
  		<br>
  		<div class="form-group">
      		<label for="NO_AUTOBUS">NUMERO DE AUTOBUS:</label>
			<input type="text" placeholder="Introduce el numero de autobus..." name="NO_AUTOBUS" class="form-control" id="NO_AUTOBUS" size="40px">
		</div>
		<br>
		<div class="form-group">
      		<label for="MARCA">MARCA:</label>
			<input type="text" placeholder="Introduce la marca..."  name="MARCA" class="form-control" id="MARCA" size="56px">
		</div>
		<br>
		<div class="form-group">
      		<label for="TIPO">TIPO:</label>
			<input type="text" placeholder="Introduce el tipo..." name="TIPO" class="form-control" id="TIPO" size="60px">
		</div>
		<br>
		<div class="form-group">
      		<label for="PLAZAS">PLAZA:</label>
			<input type="text" placeholder="Introduce la plaza..." name="PLAZAS" class="form-control" id="PLAZAS" size="58px">
		</div>
  		</center>

  		<center>
  			<br><br>
  			<input type="submit" value="ENVIAR" class="btn btn-primary" name="btn_enviar">
			<input type="submit" value="ACTUALIZAR" class="btn btn-primary" name="btn_actualizar">
			<input type="submit" value="ELIMINAR" class="btn btn-danger" name="btn_eliminar">
			<input type="button" value="CONSULTA" class="btn btn-info" onclick="location.href='consulta_autobuses.php' "name="tabla"/> 
  		</center>
  	</form>
    
    <?php

    if(isset($_POST['btn_enviar'])){

        include("conexion.php");

        $NO_AUTOBUS = $_POST['NO_AUTOBUS'];
        $MARCA      = $_POST['MARCA'];
        $TIPO       = $_POST['TIPO'];
        $PLAZAS	    = $_POST['PLAZAS'];

        $conexion->query("INSERT INTO $autobuses (NO_AUTOBUS,MARCA,TIPO,PLAZAS) values ('$NO_AUTOBUS','$MARCA','$TIPO','$PLAZAS')");

        echo "LOS DATOS FUERON ENVIADOS CORRECTAMENTE";

        include("cerrar.php");
    }

    if (isset($_POST['btn_actualizar'])) {

        include("conexion.php");

        $NO_AUTOBUS = $_POST['NO_AUTOBUS'];
        $MARCA      = $_POST['MARCA'];
        $TIPO       = $_POST['TIPO'];
        $PLAZAS	    = $_POST['PLAZAS'];

        if($NO_AUTOBUS == "" || $MARCA == "" || $TIPO == "" || $PLAZAS == ""){

            echo "LOS CAMPOS SON OBLIGATORIOS PARA PODER ACTUALIZAR EL CAMPO";

        }else{

            $existe=0;

            $resultados = mysqli_query($conexion,"SELECT * FROM $autobuses WHERE NO_AUTOBUS = '$NO_AUTOBUS'");
            while($consulta = mysqli_fetch_array($resultados)){

                $existe++;
            }
            if($existe==0){

                  echo "El NUMERO DE AUTOBUS NO EXISTE, FAVOR DE REGISTRAR UNO";

            }else{

            //ACTUALIZAR 
            $_UPDATE_SQL="UPDATE $autobuses Set NO_AUTOBUS = '$NO_AUTOBUS', MARCA = '$MARCA', TIPO = '$TIPO', PLAZAS = '$PLAZAS' WHERE NO_AUTOBUS ='$NO_AUTOBUS'"; 

            mysqli_query($conexion,$_UPDATE_SQL); 

            echo "ACTUALIZACION CON EXITO FAVOR DE CONSULTARLA";
              
            }
        } 

        include("cerrar.php");   
    }

    if (isset($_POST['btn_eliminar'])) {

        include("conexion.php");

        $NO_AUTOBUS = $_POST['NO_AUTOBUS'];
        $existe=0;

        if($NO_AUTOBUS == ""){

            echo "EL NUMERO DE AUTOBUS ES OBLIGATORIO";

        }else{

            $resultados = mysqli_query($conexion,"SELECT * FROM $autobuses WHERE NO_AUTOBUS = '$NO_AUTOBUS'");
            while($consulta = mysqli_fetch_array($resultados)){

            $existe++;
          }
          if($existe==0){

              echo "EL NUMERO DE AUTOBUS NO EXISTE";

          }else{
              //ELIMINAR
            $_DELETE_SQL = "DELETE FROM $autobuses WHERE NO_AUTOBUS = '$NO_AUTOBUS'";
            mysqli_query($conexion,$_DELETE_SQL); 
            echo "LOS DATOS SE ELIMINARON CORRECTAMENTE";
            }
        }
    }

    ?>



</body>
</html>