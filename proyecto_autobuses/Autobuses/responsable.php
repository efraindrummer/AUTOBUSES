<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RESPONSABLE</title>
    <style>
        body{
            background-image: url("fondo2.jpg");
        }
    </style>
</head>
<body>
<div class="row">
  	<div class="col-md-4"></div>
  	<div class="col-md-5">
  	<center><h2>Responsable</h2></center>

  	<form method="POST" action="responsable.php" class="form-inline">
  		
  	<center>
  		<br>
  		<div class="form-group">
      		<label for="CVE_PERSONA">CLAVE DE LA PERSONA RESPONSABLE:</label>
			<input type="text" placeholder="Introduce la clave de la persona..." name="CVE_PERSONA" class="form-control" id="CVE_PERSONA" size="50px">
		</div>
		<br>
		<div class="form-group">
      		<label for="NOM_PERSONA">NOMBRE:</label>
			<input type="text" placeholder="Introduce el nombre..."  name="NOM_PERSONA" class="form-control" id="NOM_PERSONA" size="82px">
		</div>
        <br>
  		<div class="form-group">
      		<label for="APE_PERSONA">APELLIDO:</label>
			<input type="text" placeholder="Introduce el apellido..." name="APE_PERSONA" class="form-control" id="APE_PERSONA" size="81px">
		</div>
		<br>
		<div class="form-group">
      		<label for="ID_FACULTAD">NUMERO DE FACULTAD:</label>
			<input type="text" placeholder="Introduce el numero de la facultad..."  name="ID_FACULTAD" class="form-control" id="ID_FACULTAD" size="66px">
		</div>
  		</center>

  		<center>
  			<br><br>
  			<input type="submit" value="ENVIAR" class="btn btn-primary" name="btn_enviar">
			<input type="submit" value="ACTUALIZAR" class="btn btn-primary" name="btn_actualizar">
			<input type="submit" value="ELIMINAR" class="btn btn-danger" name="btn_eliminar">
			<input type="button" value="CONSULTA" class="btn btn-info" onclick="location.href='consulta_responsable.php' "name="tabla"/> 
  		</center>
  	</form>
    <?php
        
        if(isset($_POST['btn_enviar'])){

            include("conexion.php");

            $CVE_PERSONA = $_POST['CVE_PERSONA'];
            $NOM_PERSONA = $_POST['NOM_PERSONA'];
            $APE_PERSONA = $_POST['APE_PERSONA'];
            $ID_FACULTAD = $_POST['ID_FACULTAD'];

            $conexion->query("INSERT INTO $responsable (CVE_PERSONA,NOM_PERSONA,APE_PERSONA,ID_FACULTAD) values ('$CVE_PERSONA','$NOM_PERSONA','$APE_PERSONA','$ID_FACULTAD')");
            echo "LOS DATOS FUERON ENVIADOS CORRECTAMENTE";

            include("cerrar.php");
        }

        if (isset($_POST['btn_actualizar'])) {

            include("conexion.php");
    
            $CVE_PERSONA = $_POST['CVE_PERSONA'];
            $NOM_PERSONA = $_POST['NOM_PERSONA'];
            $APE_PERSONA = $_POST['APE_PERSONA'];
            $ID_FACULTAD = $_POST['ID_FACULTAD'];
    
            if($CVE_PERSONA == "" || $NOM_PERSONA == "" || $APE_PERSONA == "" || $ID_FACULTAD == ""){
                echo "LOS CAMPOS SON OBLIGATORIOS PARA PODER ACTUALIZAR EL CAMPO";
            }else{
                $existe=0;
    
                $resultados = mysqli_query($conexion,"SELECT * FROM $responsable WHERE CVE_PERSONA = '$CVE_PERSONA'");
                while($consulta = mysqli_fetch_array($resultados)){
    
                    $existe++;
                }
                if($existe==0){
                    echo "LA CLAVE DE LA PERSONA NO EXISTE, FAVOR DE REGISTRAR UNO";
                }else{
                
                    $_UPDATE_SQL="UPDATE $responsable Set CVE_PERSONA = '$CVE_PERSONA', NOM_PERSONA = '$NOM_PERSONA', APE_PERSONA = '$APE_PERSONA', ID_FACULTAD = '$ID_FACULTAD' WHERE CVE_PERSONA ='$CVE_PERSONA'";   
                    mysqli_query($conexion,$_UPDATE_SQL); 
                    echo "ACTUALIZACION CON EXITO FAVOR DE CONSULTARLA";
                }
            } 
    
            include("cerrar.php");   
        }

        if (isset($_POST['btn_eliminar'])) {

            include("conexion.php");
    
            $CVE_PERSONA = $_POST['CVE_PERSONA'];
            $existe=0;
    
            if($CVE_PERSONA == ""){
                echo "LA CLAVE DE LA PERSONA ES OBLIGATORIO";
            }else{
                $resultados = mysqli_query($conexion,"SELECT * FROM $responsable WHERE CVE_PERSONA = '$CVE_PERSONA'");
                while($consulta = mysqli_fetch_array($resultados)){
    
                $existe++;
            }
            if($existe==0){
                echo "EL CVE PERSONA NO EXISTE";
            }else{
                //ELIMINAR
                $_DELETE_SQL = "DELETE FROM $responsable WHERE CVE_PERSONA = '$CVE_PERSONA'";
                mysqli_query($conexion,$_DELETE_SQL); 
                echo "LOS DATOS SE ELIMINARON CORRECTAMENTE";
            }
            }
        }

    ?>
    
</body>
</html>