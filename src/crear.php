<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("mysql-db", "admin", "secreto", "miapp");
    $nombre   = $conn->real_escape_string($_POST['nombre']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $email    = $conn->real_escape_string($_POST['email']);
    $conn->query("INSERT INTO contactos (nombre, telefono, email) VALUES ('$nombre','$telefono','$email')");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Nuevo Contacto</title></head>
<body>
  <h1>Nuevo Contacto</h1>
  <form method="POST">
    <label>Nombre: <input type="text" name="nombre" required></label><br><br>
    <label>Teléfono: <input type="text" name="telefono" required></label><br><br>
    <label>Email: <input type="email" name="email" required></label><br><br>
    <button type="submit">Guardar</button>
    <a href="index.php">Cancelar</a>
  </form>
</body>
</html>