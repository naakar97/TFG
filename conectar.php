<?php
$pass = "";
$user = "root";
$dsn = "mysql:host=localhost;dbname=pruebamiradigital;charset=UTF8";

try {
    
    $dbh = new PDO($dsn, $user, $pass);
    // Establecer el modo de error de PDO a excepción
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa";
} catch (PDOException $e) {
    error_log("Error de conexión: " . $e->getMessage());
    return null;
}
?>