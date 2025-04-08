<?php
require_once("conectar.php");

if (isset($_POST['Guardar'])) {
    // Recibir los datos del formulario
    $id = $_POST['id']; // ID de la empresa (campo oculto)
    $modalidad = $_POST['modalidad'];
    $documento = $_POST['nif'];
    $rol = $_POST['rolempresa'];
    $nombrejuridico = $_POST['nombre'];
    $tel1 = $_POST['tlfmovil'];
    $em1 = $_POST['email'];

    // echo $id;

    // Verificar si el NIF ya existe en la base de datos
    if (!empty($id)) {
        // Si estamos editando una empresa, excluye la empresa actual de la verificación
        $sqlCheck = "SELECT COUNT(*) FROM empresas WHERE nif = :nif AND id != :id";
        $queryCheck = $dbh->prepare($sqlCheck);
        $queryCheck->bindValue(":nif", $documento);
        $queryCheck->bindValue(":id", $id);
    } else {
        // Si estamos creando una nueva empresa, verifica si el NIF ya existe
        $sqlCheck = "SELECT COUNT(*) FROM empresas WHERE nif = :nif";
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
        // Actualizar la empresa existente
        $sql = "UPDATE empresas 
                SET nombre = :nombre, 
                    nif = :nif, 
                    tipo = :rolempresa, 
                    modalidad = :modalidad, 
                    tlf = :tlfmovil, 
                    email = :email 
                WHERE id = :id";
        $query = $dbh->prepare($sql);
        $query->bindValue(":id", $id);
    } else {
        // Crear una nueva empresa
        $sql = "INSERT INTO empresas (nombre, nif, tipo, modalidad, tlf, email) 
                VALUES (:nombre, :nif, :rolempresa, :modalidad, :tlfmovil, :email)";
        $query = $dbh->prepare($sql);
    }

    $query->bindValue(":modalidad", $modalidad);
    $query->bindValue(":nif", $documento);
    $query->bindValue(":rolempresa", $rol);
    $query->bindValue(":nombre", $nombrejuridico);
    $query->bindValue(":tlfmovil", $tel1);
    $query->bindValue(":email", $em1);

    // Ejecutar la consulta
    if ($query->execute()) {
        header("Location: empresas.php?id=$id&r=1");
        exit;
    } else {
        header("Location: empresas.php?id=$id&r=0");
    }
}
?>