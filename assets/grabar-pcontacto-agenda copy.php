<?php
require_once("conectar.php");

if (isset($_POST['Guardar'])) {
    // Recibir los datos del formulario
    $id = $_POST['id'] ?? null; // ID del contacto (campo oculto)
    $nombre = $_POST['nombre'];
    $documento = $_POST['nif'];
    $tel = $_POST['tlf'];    
    $em1 = $_POST['email'];

    // Verificar si el NIF ya existe en la base de datos
    if (!empty($id)) {
        // Si estamos editando un contacto, excluye el contacto actual de la verificación
        $sqlCheck = "SELECT COUNT(*) FROM agenda WHERE nif = :nif AND id != :id";
        $queryCheck = $dbh->prepare($sqlCheck);
        $queryCheck->bindValue(":nif", $documento);
        $queryCheck->bindValue(":id", $id);
    } else {
        // Si estamos creando un nuevo contacto, verifica si el NIF ya existe
        $sqlCheck = "SELECT COUNT(*) FROM agenda WHERE nif = :nif";
        $queryCheck = $dbh->prepare($sqlCheck);
        $queryCheck->bindValue(":nif", $documento);
    }

    $queryCheck->execute();
    $nifExists = $queryCheck->fetchColumn();

    if ($nifExists > 0) {
        // Si el NIF ya existe, muestra un mensaje de error
        echo "<script>alert('El NIF ya existe en la base de datos. Por favor, introduce un NIF diferente.');</script>";
        echo "<script>window.history.back();</script>"; // Redirige al formulario anterior
        exit;
    }

    // Si el NIF no existe, procede a guardar o actualizar
    if (!empty($id)) {
        // Actualizar el contacto existente
        $sql = "UPDATE agenda SET nombre = :nombre, nif = :nif, tlf = :tlf, email = :email WHERE id = :id"; 
        $query = $dbh->prepare($sql);
        $query->bindValue(":id", $id);
    } else {
        // Crear un nuevo contacto
        $sql = "INSERT INTO agenda (nombre, nif, tlf, email) 
                VALUES (:nombre, :nif, :tlf, :email)";
        $query = $dbh->prepare($sql);
    }

    $query->bindValue(":nombre", $nombre);
    $query->bindValue(":nif", $documento);
    $query->bindValue(":tlf", $tel);
    $query->bindValue(":email", $em1);

    // Ejecutar la consulta
    if ($query->execute()) {
        header("Location: agenda.php"); // Redirige a la lista de contactos
        exit;
    } else {
        echo "Error al guardar los datos.";
    }
}


?>