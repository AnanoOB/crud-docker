<?php
$conn = new mysqli("mysql-db", "admin", "secreto", "miapp");
$id = intval($_GET['id']);
$conn->query("DELETE FROM contactos WHERE id=$id");
header("Location: index.php");
exit;