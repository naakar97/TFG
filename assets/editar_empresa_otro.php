<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Editar Empresa</title>
</head>
<body class="bg-light">
    <div class="wrapper">
        <?php include("nav.html"); ?>
        <div class="container py-5">
            <!-- *************** TABS EMPRESAS *************************** -->
            <div class="card shadow-sm">
                <ul class="nav nav-tabs nav-fill rounded-top bg-light" id="myTab" role="tablist">
                    <!-- Tab 1: Datos -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-top" id="datos-tab" data-bs-toggle="tab" data-bs-target="#tab_1" type="button" role="tab" aria-controls="tab_1" aria-selected="true">
                            Datos
                        </button>
                    </li>
                    <!-- Tab 2: Contactos -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-top" id="traza-tab" data-bs-toggle="tab" data-bs-target="#tab_2" type="button" role="tab" aria-controls="tab_2" aria-selected="false">
                            Contactos <span class="badge rounded-pill bg-primary" style="font-size: 70%; vertical-align: super;"></span>
                        </button>
                    </li>
                </ul>

                <!-- Contenido de los tabs -->
                <div class="tab-content p-3 bg-white rounded-bottom">
                    <!-- Contenido del Tab 1: Datos -->
                    <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="datos-tab">
                        <h5 class="mb-3">Información de la Empresa</h5>
                        <?php
                        $id = $_GET['id'];
                        require_once("conectar.php");

                        // Consulta para obtener los datos de la empresa
                        $datos = $dbh->prepare("SELECT * FROM empresas WHERE id = :id LIMIT 1");
                        $datos->bindValue(':id', $id, PDO::PARAM_INT);
                        $datos->execute();
                        $row = $datos->fetch();
                        $datos = null;

                        // Asignar los valores de la empresa a variables
                        $nomemp = $row['nombre'] ?? '';
                        $tel1 = $row['tlf'] ?? '';
                        $documento = $row['nif'] ?? '';
                        $email = $row['email'] ?? '';
                        ?>

                        <form role="form" action="grabar-empresa.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
                            <!-- Campo oculto para enviar el ID de la empresa -->
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <div class="row">
                                <!-- Tipo de empresa -->
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <legend class="font-weight-bold">Tipo de empresa:</legend>
                                    <label class="form-check form-check-inline">
                                        <span class="form-check-label">Cliente</span>
                                        <input class="form-check-input" type="radio" name="rolempresa" value="Cliente" <?php echo ($row['tipo'] == 'Cliente') ? 'checked' : ''; ?>>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <span class="form-check-label">Proveedor</span>
                                        <input class="form-check-input" type="radio" name="rolempresa" value="Proveedor" <?php echo ($row['tipo'] == 'Proveedor') ? 'checked' : ''; ?>>
                                    </label>
                                </div>

                                <!-- Modalidad -->
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <legend class="font-weight-bold">Modalidad:</legend>
                                    <label class="form-check form-check-inline">
                                        <span class="form-check-label">Empresa</span>
                                        <input class="form-check-input" type="radio" name="modalidad" value="Empresa" <?php echo ($row['modalidad'] == 'Empresa') ? 'checked' : ''; ?>>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <span class="form-check-label">Autónomo</span>
                                        <input class="form-check-input" type="radio" name="modalidad" value="Autónomo" <?php echo ($row['modalidad'] == 'Autónomo') ? 'checked' : ''; ?>>
                                    </label>
                                </div>

                                <!-- NIF -->
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label font-weight-bold" for="nif">NIF:</label>
                                        <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF/CIF" value="<?php echo $documento; ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <!-- Nombre de la empresa -->
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label font-weight-bold" for="nombre">Nombre Empresa:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Empresa" value="<?php echo $nomemp; ?>" autocomplete="off">
                                    </div>
                                </div>

                                <!-- Teléfono móvil -->
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label font-weight-bold" for="tlfmovil">Teléfono móvil:</label>
                                        <input type="text" class="form-control" id="tlfmovil" name="tlfmovil" placeholder="Teléfono Móvil" value="<?php echo $tel1; ?>" autocomplete="off">
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
                                <a href="empresas.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" name="Guardar" class="btn btn-primary">Modificar cambios</button>
                            </div>
                        </form>
                    </div>

                    <!-- Contenido del Tab 2: Contactos -->
                    <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="traza-tab">
                        <h5 class="mb-3">Contactos</h5>
                        <!-- Botón para abrir el modal -->
                        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#buscarpcontacto_<?php echo $id; ?>'>
                            <i class='fas fa-plus'></i> Añadir contacto asociado
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="buscarpcontacto_<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <?php
                            // Consulta para obtener los datos de la empresa
                            $datos = $dbh->prepare("SELECT * FROM empresas WHERE id = :id LIMIT 1");
                            $datos->bindValue(':id', $id, PDO::PARAM_INT);
                            $datos->execute();
                            $row = $datos->fetch();
                            $nom = $row['nombre'];
                            ?>
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Agregar persona de contacto para la empresa: <strong><?php echo $nom; ?></strong></h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="container-fluid">
                                        <div style="margin: 10px;">
                                            <button id="btnCrearNewContacto" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaagenda">
                                                <i class="fas fa-plus"></i> Añadir
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de contactos -->
                        <div class="card-body pt-3">
                            <div class="row">
                                <table id="personasdecontacto" class="table table-responsive table-striped display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>DNI</th>
                                            <th>Teléfono</th>
                                            <th>Email</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Código PHP para cargar los contactos
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>