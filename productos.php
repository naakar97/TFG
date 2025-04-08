<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Bootstrap core CSS -->
    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- estilo para modal sweetalert2 -->
    <script src="js/sweetalert2.all.min.js"></script>


</head>

<body class="bg-light">

    <div class="card-body" style="padding: 1rem 1.25rem;">
    <div class="wrapper">
        <div class="container">
            <?php include("nav.html"); ?>
        </div>
        <?php require_once("conectar.php"); ?>
        <!-- Contenido principal -->

        <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-primary">Productos</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaempresa">
                    <i class="fas fa-plus"></i> Nueva Producto
                </button>
            </div>

            <!-- Barra de búsqueda -->
            <div class="input-group mb-3">
                <div class="col-md-6 col-lg-4">
                    <input type="search" class="form-control" id="searchbox" placeholder="Buscar productos..."> 
                 </div>
                 <button class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
            <div class="card shadow">
            <div class="card-body">
            <table id="productosTabla" class="table table-striped " style="width:100%; border: 1px solid black;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $datos = $dbh->prepare("SELECT * FROM productos");
                    $datos->execute();
                    $dat = $datos->fetchAll();
                    foreach ($dat as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><img src="imagenes/<?php echo $row["imagen"]; ?>" class="img-thumbnail" alt="Imagen del producto" width="100"></td>
                            <td><?php echo $row['descripcion']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
   
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productosTabla').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                dom: 'rtip',
                order: [
                    [0, "desc"]
                ]
            });
        });
    </script>
    <!-- Footer -->
    <body class="bg-light">
    <div class="container">
        <!-- Contenido principal de la página -->
    </div>
    <?php include 'footer.html'; ?>
</body>
</body>

</html>