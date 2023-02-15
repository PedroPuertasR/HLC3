<?php
    include 'conexionbd.php';
    session_start();
    if (isset($_GET['datosJugador'])) {
        echo($email);
        $email = $_GET['datosJugador'];

        $error = comprobar_sql_injection($email);

        if ($error == TRUE)
        {
            header("location:./index.php");
        }
        else
        {
            $con=conexion();
            $sql="select count(*) as total from USUARIOS where email='" . $email ."';";
            $resultado=mysqli_query($con, $sql);
            $datos=mysqli_fetch_assoc($resultado);
            $cantidad = $datos['total'];
            mysqli_close($con);

            if ($cantidad > 0)
            {
                $jug = obtener_datos_usuario($email);
                $_SESSION['nombre']=$jug['NOMBRE'];
                $_SESSION['email']=$jug['EMAIL'];
                $_SESSION['apellido']=$jug['APELLIDO'];
				$_SESSION['intentos']=$jug['INTENTOS'];
				$_SESSION['record']=$jug['FECHA_RECORD'];
                $_SESSION['jugando']=false;
                $_SESSION['sesionJuego']=true;
                header("location:./testSesion.php");
            }
            else
            {
                header("location:./index.php");
            }            
        }

        
    }
    else
    {
        header("location:./index.php");
    }

                

    

    function obtener_datos_usuario($email)
	{
		$con=conexion();

		$sql="select * from USUARIOS where email = '" . $email . "';";
		$resultado=mysqli_query($con, $sql);
        $datos=mysqli_fetch_assoc($resultado);
        
		mysqli_close($con);
		
		return $datos;
	}
    

    function comprobar_sql_injection($valor)
	{
		$error = FALSE;
		if (strpos($valor, "'") == TRUE) {
			$error = TRUE;
		}
		else if (strpos($valor, '"') == TRUE)
		{
			$error = TRUE;
		}
		else if (strpos($valor, ';') == TRUE)
		{
			$error = TRUE;
		}
		else if (strpos($valor, '<') == TRUE)
		{
			$error = TRUE;
		}
		else if (strpos($valor, '>') == TRUE)
		{
			$error = TRUE;
		}
		else if (strpos($valor, '/') == TRUE)
		{
			$error = TRUE;
		}
		else if (strpos($valor, '&') == TRUE)
		{
			$error = TRUE;
		}
		else if (strpos($valor, '--') == TRUE)
		{
			$error = TRUE;
		}
		else if (strpos($valor, '/*') == TRUE)
		{
			$error = TRUE;
		}
		else if (strpos($valor, '*/') == TRUE)
		{
			$error = TRUE;
		}
		return $error;
	}

?>
