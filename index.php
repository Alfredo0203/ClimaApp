<?php
include "conexion.php";

$conn = conectar();


// Comprobar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta SQL
$sql = "SELECT * FROM dht22";
$resultado = mysqli_query($conn, $sql);




// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $fecha = $_POST["fecha"];
    $humedad = $_POST["humedad"];
    $temperatura = $_POST["temperatura"];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO dht22 (fecha, humedad, temperatura) VALUES ('$fecha', '$humedad', '$temperatura')";
    if (mysqli_query($conn, $sql)) {
        echo "Registro agregado correctamente.";
		header('Location: /climaapp/');
		
	
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilo.css">
	<title>Tabla dht22</title>
	<style type="text/css">
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		th {
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>
<body>

	<h2>Tabla dht22</h2>

	<table>
		<tr>
			<th>ID</th>
			<th>Fecha</th>
			<th>Humedad</th>
			<th>Temperatura</th>
		</tr>
		<?php
		// Mostrar los datos de la consulta
		while ($fila = mysqli_fetch_assoc($resultado)) {
		    echo "<tr><td>" . $fila["id"] . "</td><td>" . $fila["fecha"] . "</td><td>" . $fila["humedad"] . "</td><td>" . $fila["temperatura"] . "</td></tr>";
		}
		?>
	</table>

	<div class="container mt-5">
		<h2>Formulario de Inserción</h2>
		<form method="post" >
			<div class="form-group">
				<label for="fecha">Fecha:</label>
				<input type="date" class="form-control" id="fecha" name="fecha" required>
			</div>
			<div class="form-group">
				<label for="humedad">Humedad:</label>
				<input type="text" class="form-control" id="humedad" name="humedad" required>
			</div>
			<div class="form-group">
				<label for="temperatura">Temperatura:</label>
				<input type="text" class="form-control" id="temperatura" name="temperatura" required>
			</div>
			<button type="submit" class="btn btn-primary">Agregar</button>
		</form>
	</div>

	<script src="script.js"></script>
</body>
</html>

	<!-- Importar jQuery y Popper.js -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	<!-- Importar Bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
mysqli_close($conn);
?>
