<?php
	session_start();
	session_destroy();
?>

<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="./css/lista.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
		<title>Home</title>
	</head>
	<body>
		<header>
			<ul class="nav nav-tabs d-flex">
				<li class="nav-item flex-fill text-center">
					<a class="nav-link text-black font-weight-bold active" data-bs-toggle="tab" href="#info">Info</a>
				</li>
				<li class="nav-item flex-fill text-center">
					<a class="nav-link text-black font-weight-bold" data-bs-toggle="tab" href="#menu1">Iniciar sesión</a>
				</li>
				<li class="nav-item flex-fill text-center">
					<a class="nav-link text-black font-weight-bold" href="./alta.php">Registrarse</a>
				</li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane container active text-center m-5" id="info">
					<h1>Autor: Pedro Puertas Rodríguez</h1>
					<h1>Curso: 2ºDAM</h1>

					<div class="container mt-3 p-5">
						<h2 class="mb-4">Tabla de records</h2>
						<table class="table table-bordered border-light text-center text-light">
							<thead>
							<tr>
								<th>Nombre</th>
								<th>Apellidos</th>
								<th>Intentos</th>
								<th>Fecha record</th>
							</tr>
							</thead>
							<tbody>
								<?php

								include 'consultasTablaUsuarios.php';

								$jugadores=obtenerTodosUsuarios();

								foreach($jugadores as $jugador)
								{
									echo '<tr>';
									echo '<td>' . $jugador['nombre'] . '</td>';
									echo '<td>' . $jugador['apellido'] . '</td>';
									echo '<td>' . $jugador['inten'] . '</td>';
									echo '<td>' . $jugador['fecha_record'] . '</td>';
									echo '</tr>';
								}
														
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane container fade d-flex justify-content-center mt-5" id="menu1">
					<?php

					foreach($jugadores as $jugador)
					{
						$segundosEdadUsuario=strtotime($jugador['fecha_nacimiento']);
						$segundosFechaActual=time();
						$edad=floor(($segundosFechaActual-$segundosEdadUsuario)/31536000);
						$envioJugador = $jugador['email'];
						

						echo '<a class="enlace" href="iniciarSesion.php?datosJugador=' .$envioJugador. '">';
						echo '<table><tr><td class="td_imagen"><figure><img class="imagen" src="./imagenes/jugador.png"></figure></td></tr><tr><td><h1 class="titulo">';
						echo $jugador['nombre'] . ' ' . $jugador['apellido'] . ' ' . $edad . ' años';
						echo '</td></tr></table></a>';
					}
											
					?>
				</div>
			</div>
		</header>
		<main id="main">
			
		</main>
		<script>			
			function filtrar() {
				var input, filter, ul, h1, a, i, txtValue;
				input = document.getElementById("busqueda");
				filter = input.value.toUpperCase();
				a = document.getElementsByClassName("enlace");
				for (i = 0; i < a.length; i++) {
					h1 = a[i].getElementsByTagName("h1")[0];
					txtValue = h1.textContent || h1.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						a[i].style.display = "";
					} else {
						a[i].style.display = "none";
					}
				}
			}
		</script>
	</body>
</html> 
