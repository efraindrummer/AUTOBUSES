<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facultad</title>
    <style>
    body{
        background-image: url("base.jpg");
    }
    </style>
</head>
<body>
<div class="row">
  	<div class="col-md-4"></div>
  	<div class="col-md-5">
  	<center><h2>Facultad</h2></center>

  	<form method="POST" action="facultad.php" class="form-inline">
  		
  	<center>
  		<br>
  		<div class="form-group">
      		<label for="ID_FACULTAD">NUMERO DE FACULTAD:</label>
			<input type="text" placeholder="Introduce el numero de facultad..." name="ID_FACULTAD" class="form-control" id="ID_FACULTAD" size="59px">
		</div>
		<br>
		<div class="form-group">
      		<label for="NOM_FACULTAD">NOMBRE DE LA FACULTAD:</label>
			<input type="text" placeholder="Introduce el nombre de la facultad..."  name="NOM_FACULTAD" class="form-control" id="NOM_FACULTAD" size="56px">
		</div>
  		</center>

  		<center>
  			<br><br>
  			<input type="submit" value="ENVIAR" class="btn btn-primary" name="btn_enviar">
			<input type="submit" value="ACTUALIZAR" class="btn btn-primary" name="btn_actualizar">
			<input type="submit" value="ELIMINAR" class="btn btn-danger" name="btn_eliminar">
			<input type="button" value="CONSULTA" class="btn btn-info" onclick="location.href='consulta_facultad.php' "name="tabla"/> 
  		</center>
  	</form>

    <?php

        if(isset($_POST['btn_enviar'])){

            include("conexion.php");

            $ID_FACULTAD = $_POST['ID_FACULTAD'];
            $NOM_FACULTAD = $_POST['NOM_FACULTAD'];

            $conexion->query("INSERT INTO $facultad (ID_FACULTAD,NOM_FACULTAD) values ('$ID_FACULTAD','$NOM_FACULTAD')");
            echo "LOS DATOS FUERON ENVIADOS CORRECTAMENTE";

            include("cerrar.php");
        }

        if (isset($_POST['btn_actualizar'])) {

            include("conexion.php");
    
            $ID_FACULTAD = $_POST['ID_FACULTAD'];
            $NOM_FACULTAD = $_POST['NOM_FACULTAD'];
    
            if($ID_FACULTAD == "" || $NOM_FACULTAD == ""){
                echo "LOS CAMPOS SON OBLIGATORIOS PARA PODER ACTUALIZAR EL CAMPO";
            }else{
                $existe=0;
    
                $resultados = mysqli_query($conexion,"SELECT * FROM $facultad WHERE ID_FACULTAD = '$ID_FACULTAD'");
                while($consulta = mysqli_fetch_array($resultados)){
    
                    $existe++;
                }
                if($existe==0){
                    echo "El ID DE FACULTAD NO EXISTE, FAVOR DE REGISTRAR UNO";
                }else{
                //ACTUALIZAR 
                $_UPDATE_SQL="UPDATE $facultad Set ID_FACULTAD = '$ID_FACULTAD', NOM_FACULTAD = '$NOM_FACULTAD' WHERE ID_FACULTAD ='$ID_FACULTAD'";   
                mysqli_query($conexion,$_UPDATE_SQL); 
                echo "ACTUALIZACION CON EXITO FAVOR DE CONSULTARLA";
                }
            } 
    
            include("cerrar.php");   
        }

        if (isset($_POST['btn_eliminar'])) {

            include("conexion.php");
    
            $ID_FACULTAD = $_POST['ID_FACULTAD'];
            $existe=0;
    
            if($ID_FACULTAD == ""){
                echo "EL ID FAULTAD ES OBLIGATORIO";
            }else{
                $resultados = mysqli_query($conexion,"SELECT * FROM $facultad WHERE ID_FACULTAD = '$ID_FACULTAD'");
                while($consulta = mysqli_fetch_array($resultados)){
    
                $existe++;
            }
            if($existe==0){
                echo "EL ID FACULTAD NO EXISTE";
            }else{
                //ELIMINAR
                $_DELETE_SQL = "DELETE FROM $facultad WHERE ID_FACULTAD = '$ID_FACULTAD'";
                mysqli_query($conexion,$_DELETE_SQL); 
                echo "LOS DATOS SE ELIMINARON CORRECTAMENTE";
            }
            }
        }
    ?>
    
</body>
</html>