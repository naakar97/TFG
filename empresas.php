<!-- filepath: c:\xampp\htdocs\pratt\empresas.php -->
<!DOCTYPE html> 
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>

    <!-- Carga de Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- estilo para modal sweetalert2 -->
    <script src="js/sweetalert2.all.min.js"></script>
</head>

<body class="bg-light">

    <div class="card-body" style="padding: 1rem 1.25rem;">
        <?php

        if (isset($_GET['r']) && $_GET['r'] == 1) {
            echo "  <script>
                                    Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: 'Registro grabado correctamente',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }).then(() => {
                                    const currentUrl = new URL(window.location.href);
                                    currentUrl.searchParams.delete('r');
                                    window.history.pushState({}, '', currentUrl);
                                    });
                                    </script>";
        }

        if (isset($_GET['r']) && $_GET['r'] == 0) {
            echo "  <script>
                                        Swal.fire({
	  					                position: 'center',
	  					                icon: 'error',
	  					                title: 'Error...',
	  					                text: 'Algo ha ido mal, consulte a su administrador !',
	  					                showConfirmButton: true
                                        }).then(() => {
                                        const currentUrl = new URL(window.location.href);
                                        currentUrl.searchParams.delete('r');
                                        window.history.pushState({}, '', currentUrl);
                                        });
                                        </script>";
        }
        if (isset($_GET['r']) && $_GET['r'] == 3) {
            echo "  <script>
                                    Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: 'Contacto modificado correctamente',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }).then(() => {
                                    const currentUrl = new URL(window.location.href);
                                    currentUrl.searchParams.delete('r');
                                    window.history.pushState({}, '', currentUrl);
                                    });
                                    </script>";
        }

        ?>
    
    <!-- Menú de navegación -->
    <?php require_once("conectar.php"); ?>
    <header>
        <div class="container">
            <?php include("nav.html"); ?>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Empresas</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaempresa">
                <i class="fas fa-plus"></i> Nueva Empresa
            </button>
        </div>

        <!-- Barra de búsqueda -->
        <!-- Barra de búsqueda -->
        <div class="input-group mb-3">
                <div class="col-md-6 col-lg-4">
                    <input type="search" class="form-control" id="searchbox" placeholder="Buscar empresas..."> 
                 </div>
                 <button class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>

        <!-- Tabla de empresas -->
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="empresaTabla" class="table table-striped " style="width:100%; border: 1px solid black;">
                        <thead>
                            <tr">
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>NIF</th>
                                <th>Tipo</th>
                                <th>Modalidad</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php
                            $datos = $dbh->prepare("SELECT * FROM empresas");
                            $datos->execute();
                            $dat = $datos->fetchAll();
                            foreach ($dat as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><a href="editar_empresa.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row["nombre"]); ?></a></td>
                                    <td><?php echo $row['nif']; ?></td>
                                    <td><?php echo $row['tipo']; ?></td>
                                    <td><?php echo $row['modalidad']; ?></td>
                                    <td><?php echo $row['tlf']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </main>
    
                        </div>
    <body class="bg-light">
        <div class="container">
            <!-- Contenido principal de la página -->
        </div>
        <?php include 'footer.html'; ?>
    </body>

    <!-- Modal para nueva empresa -->
    <?php include('crear-empresa.php'); ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#empresaTabla').DataTable({
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

            // Filtro de búsqueda personalizado
            var dataTable = $('#empresaTabla').dataTable();
            $("#searchbox").keyup(function() {
                dataTable.fnFilter(this.value);
            });
        });
    </script>

</body>

</html>