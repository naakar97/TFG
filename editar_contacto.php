<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="js/sweetalert2.all.min.js"></script>

    <title>Editar Contacto</title>
</head>
<body class="bg-light">
    <div class="wrapper">
        <?php include("nav.html"); ?>
        <div class="container py-5">
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
<?php
$id = $_GET['id'];
require_once("conectar.php");

// Consulta para obtener los datos de la empresa
$datos = $dbh->prepare("SELECT * FROM agenda WHERE id = :id LIMIT 1");
$datos->bindValue(':id', $id, PDO::PARAM_INT);
$datos->execute();
$row = $datos->fetch();
$datos = null;

// Asignar los valores de la empresa a variables
$nom = $row['nombre'] ?? '';
$documento = $row['nif'] ?? '';
$tel1 = $row['tlf'] ?? '';
$email = $row['email'] ?? '';
?>

<div class="bg-white p-4 rounded shadow">
    <h1 class="text-center mb-4">Editar Contacto</h1>
   
    <form role="form" action="grabar-pcontacto-agenda.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded">
        <!-- Campo oculto para enviar el ID de la empresa -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row mt-3">

             <!-- Nombre de la empresa -->
             <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label class="form-label font-weight-bold" for="nombre">Nombre del contacto:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Empresa" value="<?php echo $nom; ?>" autocomplete="off">
                </div>
            </div>

            <!-- NIF -->
            <div class="col-sm-12 col-md-3 col-lg-2">
                <div class="form-group">
                    <label class="form-label font-weight-bold" for="nif">DNI:</label>
                    <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF/CIF" value="<?php echo $documento; ?>" autocomplete="off">
                </div>
            </div>
            
        </div>
        

        <div class="row mt-3">
           

            <!-- Teléfono móvil -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label class="form-label font-weight-bold" for="tlf">Teléfono móvil:</label>
                    <input type="text" class="form-control" id="tlf" name="tlf" placeholder="Teléfono Móvil" value="<?php echo $tel1; ?>" autocomplete="off">
                </div>
            </div>

            <!-- Email -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label class="form-label font-weight-bold" for="email">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" value="<?php echo $email; ?>" autocomplete="off">
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="mt-4 text-end">
            <a href="agenda.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" name="Guardar" class="btn btn-primary">Modificar cambios</button>
        </div>
    </form>
</div>
    </div>
</div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>