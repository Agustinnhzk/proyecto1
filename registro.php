<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usa el usuario de tu base de datos
$password = ""; // Tu contraseña de base de datos
$dbname = "nombre_base_datos"; // El nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recoger los datos del formulario
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $correo = $_POST['correo'];
  $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Para almacenar la contraseña de manera segura
  $dni = $_POST['dni'];
  $celular = $_POST['celular'];
  $rol = $_POST['rol'];

  // Insertar los datos en la base de datos
  $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, dni, celular, rol)
  VALUES ('$nombre', '$apellido', '$correo', '$contrasena', '$dni', '$celular', '$rol')";

  if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso!";
    // Redirigir a la página de inicio de sesión o perfil
    header("Location: login.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>

<!-- Aquí estaría el formulario HTML, igual que el que ya tienes -->
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Registro</title>
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center">Formulario de Registro</h2>
    <form action="procesar_registro.php" method="POST">
      <!-- Nombre y Apellido -->
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="apellido" class="form-label">Apellido</label>
          <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
      </div>

      <!-- Correo electrónico -->
      <div class="mb-3">
        <label for="correo" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="correo" name="correo" required>
      </div>

      <!-- Contraseña -->
      <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
      </div>

      <!-- DNI -->
      <div class="mb-3">
        <label for="dni" class="form-label">DNI</label>
        <input type="text" class="form-control" id="dni" name="dni" required>
      </div>

      <!-- Número de celular -->
      <div class="mb-3">
        <label for="celular" class="form-label">Número de celular</label>
        <input type="tel" class="form-control" id="celular" name="celular" required>
      </div>

      <!-- Botón de Google -->
      <div class="mb-3">
        <button type="button" class="btn btn-danger w-100">Ingresar con Google</button>
      </div>

      <!-- Selección de rol -->
      <div class="mb-3">
        <label for="rol" class="form-label">Selecciona tu rol</label>
        <select class="form-select" id="rol" name="rol" required>
          <option value="alumno">Alumno/a</option>
          <option value="profesor">Profesor/a</option>
        </select>
      </div>

      <!-- Botón de registro -->
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Registrar</button>
      </div>
    </form>
  </div>
</body>

</html>