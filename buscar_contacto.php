<?php
// filepath: c:\xampp\htdocs\nuevo\buscar_contacto.php
require_once("conectar.php");

if (isset($_GET['term'])) {
    $term = $_GET['term'];

    try {
        // Consulta para buscar contactos que coincidan con el término
        $consulta = $dbh->prepare("
            SELECT id, nombre, nif, email
            FROM agenda
            WHERE nombre LIKE :term
            LIMIT 10
        ");
        $consulta->bindValue(':term', '%' . $term . '%', PDO::PARAM_STR);
        $consulta->execute();
        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

        // Devolver los resultados como JSON
        echo json_encode($resultados);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>