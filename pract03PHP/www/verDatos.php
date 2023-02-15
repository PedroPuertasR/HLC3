<?php  
include 'conexionbd.php';
session_start();
//isset — Determina si una variable está definida y no es null
if (isset($_SESSION['masControl']))
{
	if($_SESSION['sesionJuego']==true)
	{
		echo "<script>
				var peticion=confirm('Sesion correcta ¿continuas?');
				console.log(peticion);
				if(peticion){
					console.log(peticion);
				}     			
			</script>";
	}
	$con=conexion();
	$sql="SELECT * FROM USUARIOS WHERE EMAIL='" . $_SESSION['email'] . "';";
	$resultado=mysqli_query($con, $sql);

	mysqli_close($con);
}
else
{
	session_destroy();
	header("location:./index.php");
}
?>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Ver datos</title>
	</head>
	<body class="bg-primary">
		<div class="d-flex flex-column">
			<div class="datos_usuario">
				<h1 class="text-center m-5">
					<?php echo ' ' .$_SESSION['nombre'] . ' ' . $_SESSION['apellido'];?>
				</h1> 
			</div>
			<div class="d-flex justify-content-center flex-row text-center mt-5">
				<?php

					echo '<p class="mx-5 text-light">Intentos</p>';
					echo '<br/>';
					echo '<p class="mx-5 text-light">Fecha del record</p>';
				?>
			</div>
			<div class="d-flex justify-content-center flex-row text-center mt-5">
				
				<p class="mx-5 text-white"><?php echo $_SESSION['intentos'];?></p>
				<br/>
				<p class="mx-5 text-white"><?php echo $_SESSION['record'];?></p>
			</div>
			<div class="d-flex justify-content-center flex-row text-center mt-5">
				<a class="btn btn-success mx-5" href="./juego.php">Jugar</a>
				<a class="btn btn-warning mx-5" href="./index.php">Volver</a>
			</div>
		</div>	
	</body>
</html> 
