<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="css/app.css" rel="stylesheet">

</head>
<body class="bg-light">
    <div class="wrapper">
        <?php include("nav.html"); ?>
        <?php require_once("conectar.php"); ?>
        <main class="container py-5">
		<div class="col-md-6">


</div>
<div class="container-fluid card p-0">

<div class="row">
	<div class="col-3">

<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#nuevaempresa'>
  Nueva Empresa<i class='fas fa-plus'></i>
</button>
 
										
	<div class="col-6 input-group">
			<input type="search" class="form-control input-sm" id="searchbox" placeholder="Buscar">
					<button class="btn btn-primary"><i class="fas fa-search"></i></button>
			</div>
		</div>
</div>
            <div class="bg-white p-4 rounded shadow">
                <h1 class="text-center mb-4">Empresas</h1>
                <table id="empresaTabla" class="table table-striped table-bordered">
                    <thead class="table-dark">
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
								<td><a href="editar_empresa.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row["nombre"]); ?> </a></td>                                
						  		<td><span><?php echo $row['nif']; ?></span></td>
                                <td><span><?php echo $row['tipo']; ?></span></td>
                                <td><span><?php echo $row['modalidad']; ?></span></td>
                                <td><span><?php echo $row['tlf']; ?></span></td>
                                <td><span><?php echo $row['email']; ?></span></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                
                </div>  
            </div>
			<?php include('crear-empresa.php'); ?>
        </main>
    </div>
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
				dom: 'lrtip',
                order: [
                    [0, "desc"]
                ]
            });
        });
    </script>
	<script>
		$(document).ready(function() {
			var dataTable = $('#empresaTabla').dataTable();
			$("#searchbox").keyup(function() {
				dataTable.fnFilter(this.value);
			});
		});
	</script>
</body>
</html>