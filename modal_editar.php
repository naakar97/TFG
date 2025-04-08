<div class="modal fade" id="editarModal_<?php echo $contacto['id']; ?>" tabindex="-1" aria-labelledby="editarModalLabel_<?php echo $contacto['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"></div>
            <h1 class="text-center mb-4">Editar Contacto</h1>
            <form role="form" action="modificaciones_contacto.php?editar=true" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
                <!-- Campo oculto para enviar el ID de la empresa -->
                <input type="hidden" name="id" value="<?php echo $contacto['id']; ?>">
                <input type="hidden" name="id_empresa" value="<?php echo $id; ?>">
                <input type="hidden" name="id_agenda" value="<?php echo $id; ?>">


                <!-- NIF -->
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="nif">DNI:</label>
                        <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF/CIF" value="<?php echo $contacto['nif']; ?>" autocomplete="off">
                    </div>
                </div>


                <div class="row mt-3">
                    <!-- Nombre de la empresa -->
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="nombre">Nombre del contacto:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Empresa" value="<?php echo $contacto['nombre']; ?>" autocomplete="off">
                        </div>
                    </div>

                    <!-- Teléfono móvil -->
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="tlf">Teléfono móvil:</label>
                            <input type="text" class="form-control" id="tlf" name="tlf" placeholder="Teléfono Móvil" value="<?php echo $contacto['tlf']; ?>" autocomplete="off">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" value="<?php echo $contacto['email']; ?>" autocomplete="off">
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="mt-4 text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"> Modificar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="datosCorporativosModal_<?php echo $contacto['id']; ?>" tabindex="-1" aria-labelledby="datosCorporativosModalLabel_<?php echo $contacto['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">            
                <h1 class="text-center">Editar Datos Corporativos</h1>
            </div>
            <div class="modal-body">
             
            <form role="form" action="modificaciones_contacto.php?editarCorporativo=true" method="POST" enctype="multipart/form-data">
                <!-- Campo oculto para enviar el ID de la empresa -->
                <input type="hidden" name="id_empresa" value="<?php echo $contacto['id_empresa']; ?>">
                <input type="hidden" name="id_agenda" value="<?php echo $contacto['id']; ?>">

                <div class="row mt-3">
                    <!-- Cargo de la empresa -->
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="cargo">Cargo:</label>
                            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo Empresa" value="<?php echo $contacto['cargo']; ?>" autocomplete="off">
                        </div>
                    </div>

                    
                    <!-- Departamento -->
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="dpto">Departamento:</label>
                            <input type="text" class="form-control" id="dpto" name="dpto" placeholder="Departamento" value="<?php echo $contacto['dpto']; ?>" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <!-- Email Corporativo -->
                    <div class="col-sm-12 col-md-8 col-lg-7">
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="email">Email Corporativo:</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Corporativo" value="<?php echo $contacto['email_corporativo']; ?>" autocomplete="off">
                        </div>
                    </div>

                    <!-- Telefono Corporativo -->
                    <div class="col-sm-12 col-md-4 col-lg-5">
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="tlfC">Telefono Corporativo:</label>
                            <input type="text" class="form-control" id="tlfC" name="tlfC" placeholder="tlf Corporativo" value="<?php echo $contacto['tlf_corporativo']; ?>" autocomplete="off">
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"> Modificar Cambios</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>