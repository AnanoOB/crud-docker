<?php
$conn = new mysqli("mysql-db", "admin", "secreto", "miapp");
$id       = intval($_POST['id']);
$nombre   = $conn->real_escape_string($_POST['nombre']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$email    = $conn->real_escape_string($_POST['email']);
$conn->query("UPDATE contactos SET nombre='$nombre', telefono='$telefono', email='$email' WHERE id=$id");
header("Location: index.php");
exit;