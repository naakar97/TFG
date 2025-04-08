<?php
require_once("conectar.php");


$borrar = $_GET["borrar"] ?? "false";
$editar = $_GET["editar"] ?? "false";
if ($editar == "true") {
    $contacto_id = $_POST['id'];
    // $empresa_id = $_GET['id_empresa'];
    $nombre = $_POST['nombre'];
    $nif = $_POST['nif'];
    $email = $_POST['email'];
    $telefono = $_POST['tlf'];

    try {
        // editar la relación entre el contacto y la empresa
        $editar = $dbh->prepare("UPDATE FROM agenda SET nombre = :nombre, nif = :nif, tlf = :tlf, email = :email WHERE id_agenda = :id");
        $editar->bindParam(':contacto_id', $contacto_id);
        // $editar->bindParam(':empresa_id', $empresa_id);
        $editar->bindParam(':nombre', $nombre);
        $editar->bindParam('nif', $nif);
        $editar->bindParam(':tlf', $telefono);
        $editar->bindParam(':email', $email);
        $editar->execute();

        // Redirigir con éxito
        header("Location: editar_empresa.php?id=$empresa_id&r=3");
        exit;
    } catch (PDOException $e) {
        // Redirigir con mensaje de error
        header("Location: editar_empresa.php?id=$empresa_id&r=2");
        exit;
    }
}


if ($borrar == "true") {
    $contacto_id = $_GET['id_contacto'];
    $empresa_id = $_GET['id_empresa'];

    try {
        // Eliminar la relación entre el contacto y la empresa
        $eliminar = $dbh->prepare(" DELETE FROM contactos_empresa WHERE id_agenda = :id_contacto AND id_empresa = :id_empresa");
        $eliminar->bindParam(':id_contacto', $contacto_id, PDO::PARAM_INT);
        $eliminar->bindParam(':id_empresa', $empresa_id, PDO::PARAM_INT);
        $eliminar->execute();

        // Redirigir con éxito
        header("Location: editar_empresa.php?id=$empresa_id&r=1");
        exit;
    } catch (PDOException $e) {
        // Redirigir con mensaje de error
        header("Location: editar_empresa.php?id=$empresa_id&r=2");
        exit;
    }
}
