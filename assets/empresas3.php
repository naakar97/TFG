<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="canonical" href="https://demo.adminkit.io/tables-datatables-buttons.html">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <!-- <link href="css/app.css" rel="stylesheet"> -->
  <!-- <link rel="stylesheet" href="css/productos.css"> -->
  <link href="css/rms.css" rel="stylesheet">
</head>
<body>
<main>



</div>
        <div class="wrapper">
        <?php include("nav.html"); ?>
        <?php require_once("conectar.php"); ?>
            <div class="container text-center bg-white">
                <h1>Empresas</h1>
                <table id="EmpresasTabla" class="table table-striped display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Nif</th>
                            <th>Tipo</th>
                            <th>Modalidad</th>
                            <th>Telefono</th>
                            <th>E-mail</th>
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
                                <td><span><?php echo $row['id']; ?></span></td>
                                <td><span><?php echo $row['nombre']; ?></span></td>
                                <td><span><?php echo $row['nif']; ?></span></td>
                                <td><span><?php echo $row['tipo']; ?></span></td>
                                <td><span><?php echo $row['modalidad']; ?></span></td>
                                <td><span><?php echo $row['tlf']; ?></span></td>
                                <td><span><?php echo $row['e-mail']; ?></span></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
            
        </main>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#EmpresasTabla').DataTable({
                paging: false,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: true,
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
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                columnDefs: [{
                    width: '20%',
                    targets: [0, 1, 2, 3] // Ajustado a las columnas existentes
                }],
                dom: 'rtip',
                order: [
                    [0, "desc"]
                ]
            });
        });
    </script>
</body>
</html>