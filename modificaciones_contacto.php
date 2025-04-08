<?php
require_once("conectar.php");


$borrar = $_GET["borrar"] ?? "false";
$editar = $_GET["editar"] ?? "false";
$editarCorporativo = $_GET["editarCorporativo"] ?? "false";
if ($editar == "true") {
    $contacto_id = $_POST['id'];
    $empresa_id = $_POST['id_empresa'];
    $nombre = $_POST['nombre'];
    $nif = $_POST['nif'];
    $email = $_POST['email'];
    $telefono = $_POST['tlf'];

    // echo 'nombre: ' . $nombre . '<br>';
    // echo 'nif: ' . $nif . '<br>';
    // echo 'tlf:'. $telefono . '<br>';
    // echo 'id:'. $contacto_id .'<br>';
    // echo 'email:'. $email . '<br>';

    try {
        // editar la relación entre el contacto y la empresa
        $editar = $dbh->prepare("UPDATE agenda SET nombre = :nombre, nif = :nif, tlf = :tlf, email = :email WHERE id = :contacto_id"); 
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
        $eliminar = $dbh->prepare("DELETE FROM contactos_empresa WHERE id_agenda = :contacto_id AND id_empresa = :empresa_id");
        $eliminar->bindParam(':contacto_id', $contacto_id);
        $eliminar->bindParam(':empresa_id', $empresa_id);
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


if ($editarCorporativo == "true") {
    $contacto_id = $_POST['id_agenda'];
    $empresa_id = $_POST['id_empresa'];
    $cargo = $_POST['cargo'];
    $dpto = $_POST['dpto'];
    $email = $_POST['email'];
    $telefono = $_POST['tlfC'];
    

    // echo 'cargo: ' . $cargo . '<br>';
    // echo 'dpto: ' . $dpto . '<br>';
    // echo 'empresa:'. $empresa_id . '<br>';
    // echo 'contacto:'. $contacto_id .'<br>';


    try {
        // editar la relación entre el contacto y la empresa
        $editar = $dbh->prepare("UPDATE contactos_empresa SET cargo = :cargo, dpto = :dpto, email_corporativo = :email, tlf_corporativo = :tlfc WHERE id_agenda = :contacto_id AND id_empresa = :empresa_id"); 
        $editar->bindParam(':contacto_id', $contacto_id);
        $editar->bindParam(':empresa_id', $empresa_id);
        $editar->bindParam(':email', $email);
        $editar->bindParam(':tlfc', $telefono);
        $editar->bindParam(':cargo', $cargo);
        $editar->bindParam(':dpto', $dpto);
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