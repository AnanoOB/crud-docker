<?php
$conn = new mysqli("mysql-db", "admin", "secreto", "miapp");
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM contactos WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Editar Contacto</title></head>
<body>
  <h1>Editar Contacto</h1>
  <form method="POST" action="actualizar.php">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($row['nombre']) ?>" required></label><br><br>
    <label>Teléfono: <input type="text" name="telefono" value="<?= htmlspecialchars($row['telefono']) ?>" required></label><br><br>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required></label><br><br>
    <button type="submit">Actualizar</button>
    <a href="index.php">Cancelar</a>
  </form>
</body>
</html>