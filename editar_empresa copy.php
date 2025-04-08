<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="js/sweetalert2.all.min.js"></script>
    <title>Editar Empresa</title>
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
    </div>
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

                        <form role="form" action="grabar-empresa.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded">
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
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Agregar persona de contacto</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="container-fluid">
                                        <!-- Botón para abrir el modal de crear nuevo contacto -->
                                        <div style="margin: 10px;">
                                            <button id="btnCrearNewContacto" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaagenda">
                                                <i class="fas fa-plus"></i> Añadir
                                            </button>
                                        </div>

                                        <!-- Bloque de "Comprueba si ya existe" -->
                                        <div id="busquedaTipoForm" class="row mb-4">
                                            <div class="col-md-12">
                                                <div class="form-group p-3 border rounded shadow-sm" style="background-color: #f9f9f9;">
                                                    <label for="autocompletepcontacto2" class="form-label fw-semibold" style="color: #555;">
                                                        Comprueba si ya existe:
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" id="autocompletepcontacto2" class="form-control" placeholder="Buscar cliente..." style="padding: 0.5rem; border-radius: 0.25rem; border: 1px solid #ddd;">
                                                        <button id="mostrarFormularioBtn" class="btn btn-primary ms-2" style="padding: 0.5rem 1rem;">
                                                            <i class="fas fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                    <!-- Contenedor para los resultados del autocomplete -->
                                                    <ul id="autocompleteResults" class="list-group mt-2" style="display: none;"></ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fin del bloque -->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal para crear un nuevo contacto sin el comprobar si existe -->
                        <!-- <div class="modal fade" id="nuevaagenda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Crear nuevo contacto</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <form role="form" action="grabar-pcontacto-agenda.php" method="POST" id="nuevaagendaForm" enctype="multipart/form-data">
                                        <div class="modal-body mt-0 pt-2">
                                            <div class="card-body mt-0 pt-0">
                                                <h4 class="form-label font-weight-bold mt-2">Datos del contacto:</h4>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label font-weight-bold" for="nombre">Nombre:</label>
                                                            <input id="nombre" class="form-control" type="text" name="nombre" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label font-weight-bold" for="nif">DNI:</label>
                                                            <input id="nif" class="form-control" type="text" name="nif" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label font-weight-bold" for="tlf">Teléfono:</label>
                                                            <input type="text" class="form-control" id="tlf" name="tlf" placeholder="Móvil">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label font-weight-bold" for="email">Email:</label>
                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" name="Guardar" class="btn btn-primary">Guardar Contacto</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->


                        <!-- Modal para crear un nuevo contacto -->
                        <div class="modal fade" id="nuevaagenda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Crear nuevo contacto</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form role="form" action="grabar-pcontacto-agenda.php" method="POST" id="nuevaagendaForm" enctype="multipart/form-data">
                                        <input type="hidden" name="empresa_id" value="<?php echo $id; ?>">
                                        <div class="modal-body mt-0 pt-2">


                                            <div class="card-body mt-0 pt-0">
                                                <h4 class="form-label font-weight-bold mt-2">Datos del contacto:</h4>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label font-weight-bold" for="nombre">Nombre:</label>
                                                            <input id="nombre" class="form-control" type="text" name="nombre" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label font-weight-bold" for="nif">DNI:</label>
                                                            <input id="nif" class="form-control" type="text" name="nif" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label font-weight-bold" for="tlf">Teléfono:</label>
                                                            <input type="text" class="form-control" id="tlf" name="tlf" placeholder="Móvil">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label font-weight-bold" for="email">Email:</label>
                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" name="Guardar" class="btn btn-primary">Guardar Contacto</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


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

                                        try {
                                            $consultaContactos = $dbh->prepare("
                                              SELECT a.id, a.nombre, a.nif, a.tlf, a.email, e.id as id_empresa, ca.cargo, ca.dpto, ca.tlf_corporativo, ca.email_corporativo
                                              FROM contactos_empresa ca
                                              INNER JOIN agenda a ON ca.id_agenda = a.id
                                              INNER JOIN empresas e ON ca.id_empresa = e.id
                                              WHERE ca.id_empresa = :id_empresa
                                          ");
                                            $consultaContactos->bindParam(':id_empresa', $id, PDO::PARAM_INT);
                                            $consultaContactos->execute();
                                            $contactos = $consultaContactos->fetchAll(PDO::FETCH_ASSOC);

                                            if ($contactos) {
                                                foreach ($contactos as $contacto) {
                                                    echo "<tr>
                                                    <td><a href='#datosCorporativosModal_" . $contacto['id'] . "' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#datosCorporativosModal_" . $contacto['id'] . "'>" . htmlspecialchars($contacto['nombre']) . "</a></td>   
                                                    <td>" . $contacto['nif'] . "</td>
                                                    <td>" . $contacto['tlf'] . "</td>
                                                    <td>" . $contacto['email'] . "</td>
                                                      <td style='width:5%;'>
                                                          <div class='dropdown'>
                                                              <button class='btn btn-secondary' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                  <i class='fa-solid fa-ellipsis-vertical'></i>
                                                              </button>
                                                              <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                                  <li><a href='#editarModal_{$contacto['id']}' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#editarModal_{$contacto['id']}'>Editar</a></li>
                                                                  <li>
                                                                      <a href='#desvincularModal_{$contacto['id']}' class='dropdown-item text-danger' data-bs-toggle='modal' data-bs-target='#desvincularModal_{$contacto['id']}'>
                                                                          Desvincular
                                                                      </a>
                                                                  </li>
                                                              </ul>
                                                          </div>
                                                      </td>
                                                  </tr>";
                                                    include("modal_desvincular.php");
                                                    include("modal_editar.php");
                                                }
                                            } else {
                                                echo "<tr><td colspan='5' class='text-center'>No hay contactos asociados.</td></tr>";
                                            }
                                        } catch (PDOException $e) {
                                            echo "<tr><td colspan='5' class='text-center text-danger'>Error al cargar los contactos: {$e->getMessage()}</td></tr>";
                                        }

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <body class="d-flex flex-column min-vh-100">
                <div class="container flex-grow-1">
                    <!-- Contenido principal de la página -->
                </div>
                <?php include 'footer.html'; ?>
            </body>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


            <!-- SCRIPT PARA EL DATATABLE -->
            <script>
                $(document).ready(function() {
                    $('#personasdecontacto').DataTable({
                        paging: false,
                        searching: true,
                        ordering: true,
                        info: false,
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
                        dom: 'lfrtip',
                        order: [
                            [0, "desc"]
                        ]
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    var dataTable = $('#personasdecontacto').dataTable();
                    $("#searchbox").keyup(function() {
                        dataTable.fnFilter(this.value);
                    });
                });
            </script>

            <!-- SCRIPT PARA EL AUTOCOMPLETE DE BUSCAR CONTACTO -->
            <script>
                $(document).ready(function() {
                    // Capturar el evento keyup en el campo de texto
                    $('#autocompletepcontacto2').on('keyup', function() {
                        let term = $(this).val(); // Obtener el valor del campo de texto

                        if (term.length > 2) { // Buscar solo si hay más de 2 caracteres
                            $.ajax({
                                url: 'buscar_contacto.php', // Endpoint PHP
                                method: 'GET',
                                data: {
                                    term: term
                                }, // Enviar el término de búsqueda
                                dataType: 'json',
                                success: function(data) {
                                    let dropdown = $('#autocompleteResults');
                                    dropdown.empty(); // Limpiar resultados anteriores

                                    if (data.length > 0) {
                                        // Mostrar cada resultado en el dropdown
                                        data.forEach(function(contacto) {
                                            dropdown.append(`
                                    <li class="list-group-item list-group-item-action" data-id="${contacto.id}" data-nombre="${contacto.nombre}" data-nif="${contacto.nif}" data-email="${contacto.email}">
                                        <strong>${contacto.nombre}</strong> - ${contacto.nif} - ${contacto.email}
                                    </li>
                                `);
                                        });
                                        dropdown.show();
                                    } else {
                                        dropdown.hide();
                                    }
                                },
                                error: function() {
                                    console.error('Error al buscar contactos.');
                                }
                            });
                        } else {
                            $('#autocompleteResults').hide(); // Ocultar el dropdown si no hay suficiente texto
                        }
                    });

                    // Manejar la selección de un contacto
                    $('#autocompleteResults').on('click', 'li', function() {
                        let id = $(this).data('id');
                        let nombre = $(this).data('nombre');
                        let nif = $(this).data('nif');
                        let email = $(this).data('email');

                        // Mostrar los datos seleccionados en el campo de texto o en otro lugar
                        $('#autocompletepcontacto2').val(nombre); // Mostrar el nombre en el campo de texto
                        $('#contactoEncontrado').val(id); // Guardar el ID del contacto en un campo oculto

                        // Opcional: Ocultar el dropdown después de seleccionar
                        $('#autocompleteResults').hide();
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    // Capturar el evento keyup en el campo de texto
                    $('#autocompletepcontacto2').on('keyup', function() {
                        let term = $(this).val(); // Obtener el valor del campo de texto

                        if (term.length > 2) { // Buscar solo si hay más de 2 caracteres
                            $.ajax({
                                url: 'buscar_contacto.php', // Endpoint PHP
                                method: 'GET',
                                data: {
                                    term: term
                                }, // Enviar el término de búsqueda
                                dataType: 'json',
                                success: function(data) {
                                    let dropdown = $('#autocompleteResults');
                                    dropdown.empty(); // Limpiar resultados anteriores

                                    if (data.length > 0) {
                                        // Mostrar cada resultado en el dropdown
                                        data.forEach(function(contacto) {
                                            dropdown.append(`
                                    <li class="list-group-item list-group-item-action" data-id="${contacto.id}" data-nombre="${contacto.nombre}" data-nif="${contacto.nif}" data-email="${contacto.email}">
                                        <strong>${contacto.nombre}</strong> - ${contacto.nif} - ${contacto.email}
                                    </li>
                                `);
                                        });
                                        dropdown.show();
                                    } else {
                                        dropdown.hide();
                                    }
                                },
                                error: function() {
                                    console.error('Error al buscar contactos.');
                                }
                            });
                        } else {
                            $('#autocompleteResults').hide(); // Ocultar el dropdown si no hay suficiente texto
                        }
                    });

                    // Manejar la selección de un contacto
                    $('#autocompleteResults').on('click', 'li', function() {
                        let contacto_id = $(this).data('id');
                        let nombre = $(this).data('nombre');
                        let nif = $(this).data('nif');
                        let email = $(this).data('email');
                        let empresa_id = <?php echo $id; ?>; // ID de la empresa actual

                        // Mostrar el nombre seleccionado en el campo de texto
                        $('#autocompletepcontacto2').val(nombre); // Mostrar el nombre en el campo de texto
                        $('#contactoEncontrado').val(contacto_id); // Guardar el ID del contacto en un campo oculto

                        // Enviar el contacto seleccionado al servidor para asociarlo a la empresa
                        $.ajax({
                            url: 'incluir_contacto.php',
                            method: 'POST',
                            data: {
                                contacto_id: contacto_id,
                                empresa_id: empresa_id
                            },
                            success: function(response) {
                                window.location.href = 'editar_empresa.php?id=' + empresa_id + '&r=1';
                            },
                            error: function() {
                                window.location.href = 'editar_empresa.php?id=' + empresa_id + '&r=2';
                            }
                        });

                        // Ocultar el dropdown después de seleccionar
                        $('#autocompleteResults').hide();
                    });
                });
            </script>
            <!-- <script>
            $(document).ready(function() {
                // Manejar el clic en el botón "Desvincular"
                $('.desvincular-contacto').on('click', function(e) {
                    e.preventDefault(); // Evitar el comportamiento predeterminado del enlace

                    let contacto_id = $(this).data('contacto-id'); // Obtener el ID del contacto
                    let empresa_id = $(this).data('empresa-id'); // Obtener el ID de la empresa

                    // Confirmar la acción con el usuario
                    if (confirm('¿Estás seguro de que deseas desvincular este contacto?')) {
                        // Enviar la solicitud AJAX para desvincular el contacto
                        $.ajax({
                        url: 'modificaciones_contacto.php',
                        method: 'POST',
                        data: {
                            contacto_id: contacto_id,
                            empresa_id: empresa_id
                        },
                        success: function(response) {
                            window.location.href = 'editar_empresa.php?id=' + empresa_id + '&r=1';
                        },
                        error: function() {
                            window.location.href = 'editar_empresa.php?id=' + empresa_id + '&r=2';
                        }
                    });
                    }
                });
            });
        </script> -->
</body>

</html>