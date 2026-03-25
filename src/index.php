<?php
$conn = new mysqli("mysql-db", "admin", "secreto", "miapp");
if ($conn->connect_error) die("Error: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM contactos");
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>CRUD Contactos</title></head>
<body>
  <h1>Contactos</h1>
  <a href="crear.php">+ Nuevo contacto</a>
  <table border="1">
    <tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Email</th><th>Acciones</th></tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['nombre']) ?></td>
      <td><?= htmlspecialchars($row['telefono']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td>
        <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
        <a href="eliminar.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>