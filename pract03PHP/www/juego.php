<?php  
    include 'conexionbd.php';
    session_start();

    if (isset($_SESSION['masControl']))
    {
        $con=conexion();
        $sql="UPDATE USUARIOS SET INTENTOS=" . $_SESSION['intentos'] .", FECHA_RECORD=" . $_SESSION['fecha_record'] . " WHERE EMAIL='" . $_SESSION['email'] . "';";
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
    <title>Adivina el número</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/juego.css">
</head>
<body>
    <main>
        <div class="d-flex flex-column justify-content-center mx-auto align-items-center">
        
            <h1 class="text-white">Adivinar el número</h1>

            <?php

            $sumar = 0;
            $fecha_actual = date("Y-m-d");

            if (!isset($_POST["respuesta"]) || isset($_POST["reset"])) {
                
                $numero_a_adivinar = random_int(1, 100);
                echo "<script>console.log('Variable: ', ".json_encode($numero_a_adivinar).");</script>";
                $limite_inferior = 1;
                $limite_superior = 100;
                $intentos = 1;
            } else {
                $numero_a_adivinar = $_POST["numero_a_adivinar"];
                echo "<script>console.log('Variable: ', ".json_encode($numero_a_adivinar).");</script>";
                $limite_inferior = $_POST["limite_inferior"];
                $limite_superior = $_POST["limite_superior"];
                $intentos = $_POST["intentos"];

                $respuesta = (int) $_POST["respuesta"];

                if ($respuesta == $numero_a_adivinar) {
                    echo '<h3 class="text-center text-warning">¡Felicidades, has adivinado el número en ' . $intentos . ' intentos!</h3>';
                    echo '<form class="d-flex flex-row" action="juego.php" method="post">';
                    echo '<input class="mx-3 btn btn-success" type="submit" name="reset" value="Jugar de nuevo">';
                    echo '<a class="btn btn-warning mx-3" href="./index.php">Volver</a>';
                    echo '</form>';

                    $con=conexion();
                    $sql="UPDATE USUARIOS SET INTENTOS = " . $intentos . ", FECHA_RECORD = '" . $fecha_actual . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
                    $resultado=mysqli_query($con, $sql);
                    mysqli_close($con);

                    exit;
                } else{
                    echo "<p>Número incorrecto</p>";
                    $sumar = random_int(1, 15);
                    $limite_inferior = $numero_a_adivinar - $sumar;
                    if($limite_inferior < 1){
                        $limite_inferior = 1;
                    }
                    $sumar = random_int(1, 15);
                    $limite_superior = $numero_a_adivinar + $sumar;
                    if($limite_superior > 100){
                        $limite_superior = 100;
                    }
                }

                $intentos++;
            }
            ?>
        </div>

        <div class="d-flex justify-content-center align-items-center mt-5">
            <form action="juego.php" method="post">
                <input type="hidden" name="numero_a_adivinar" value="<?php echo $numero_a_adivinar; ?>">
                <input type="hidden" name="limite_inferior" value="<?php echo $limite_inferior; ?>">
                <input type="hidden" name="limite_superior" value="<?php echo $limite_superior; ?>">
                <input type="hidden" name="intentos" value="<?php echo $intentos; ?>">
                <h3 class="text-center text-warning">
                    Adivine un número entre <?php echo $limite_inferior; ?> y <?php echo $limite_superior; ?>:
                </h3>
                <div class="d-flex justify-content-center">
                    <input type="number" name="respuesta" size="7">
                    <input class="btn btn-success mx-3" type="submit" value="Adivinar">
                    <a class="btn btn-warning" href="./index.php">Volver</a>
                </div>
            </form>
        </div>

    </main>
    
</body>
</html>
