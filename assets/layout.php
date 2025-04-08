<!-- filepath: c:\xampp\htdocs\nuevo\layout.php -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- Barra lateral -->
    <?php include("nav.html"); ?>

    <!-- Contenido principal -->
    <div class="main-content" style="margin-left: 250px; padding: 20px;">
        <?php
        // Cargar el contenido dinámico
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $allowed_pages = ['empresas', 'productos', 'agenda']; // Lista de páginas permitidas
            if (in_array($page, $allowed_pages)) {
                include("$page.php");
            } else {
                echo "<h1>Página no encontrada</h1>";
            }
        } else {
            echo "<h1>Bienvenido al Dashboard</h1>";
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</body>

</html>