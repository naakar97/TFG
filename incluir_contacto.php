<?php
require_once("conectar.php");

if (isset($_POST['contacto_id']) && isset($_POST['empresa_id'])) {
    $contacto_id = $_POST['contacto_id'];
    $empresa_id = $_POST['empresa_id'];

    try {
        // Verificar si ya existe la relación entre el contacto y la empresa
        $verificar = $dbh->prepare("
            SELECT COUNT(*) as total
            FROM contactos_empresa
            WHERE id_agenda = :contacto_id AND id_empresa = :empresa_id
        ");
        $verificar->bindParam(':contacto_id', $contacto_id, PDO::PARAM_INT);
        $verificar->bindParam(':empresa_id', $empresa_id, PDO::PARAM_INT);
        $verificar->execute();
        $resultado = $verificar->fetch(PDO::FETCH_ASSOC);

        if ($resultado['total'] == 0) {
            // Insertar la relación en la tabla contactos_empresa
            $insertar = $dbh->prepare("
                INSERT INTO contactos_empresa (id_agenda, id_empresa)
                VALUES (:contacto_id, :empresa_id)
            ");
            $insertar->bindParam(':contacto_id', $contacto_id, PDO::PARAM_INT);
            $insertar->bindParam(':empresa_id', $empresa_id, PDO::PARAM_INT);
            $insertar->execute();

            // Redirigir con éxito
            header("Location: editar_empresa.php?id=$empresa_id&r=1");
            exit;
        } else {
            // Redirigir con mensaje de error (ya asociado)
            header("Location: editar_empresa.php?id=$empresa_id&r=0");
            exit;
        }
    } catch (PDOException $e) {
        // Redirigir con mensaje de error
        header("Location: editar_empresa.php?id=$empresa_id&r=2");
        exit;
    }
} else {
    // Redirigir si faltan datos
    header("Location: editar_empresa.php?id=$empresa_id&r=3");
    exit;
}
?>