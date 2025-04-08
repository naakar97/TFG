<!-- /// MODAL NUEVO CONTACTO  ///-->
<div class="modal fade" id="nuevaagenda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Crear nuevo contacto en la agenda</h3>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form role="form" action="grabar-pcontacto-agenda.php" method="POST" id="nuevaagenda" enctype="multipart/form-data">

				<div class="modal-body mt-0 pt-2">
					<div class="card-body mt-0 pt-0"><!-- Card-1 -->

						<h4 class="form-label font-weight-bold mt-2">Datos del contacto:</h4>
						<div class="row "><!-- Bloque row-1 -->
							<div class="col-md-12">

								<div class="row"><!-- row-1 -->
									<div class="col-6">
										<div class="form-group">
											<label class="form-label font-weight-bold" for="nombre">Nombre y Apellidos:</label>
											<input id="nombre" class="form-control" type="text" name="nombre" required>
										</div>
										<div class="col-6">
											<label class="form-label font-weight-bold" for="nombre">DNI:</label>
											<input id="nombre" class="form-control" type="text" name="nif" required>
										</div>
									</div>

									<div class="col-12">
										<div class="form-group">
											<label class="form-label font-weight-bold" for="telefono2">Telefono:</label>
											<input type="text" class="form-control" id="tlf" name="tlf" placeholder="Movíl">
										</div>
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label class="form-label font-weight-bold" for="email2">Email:</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Email">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
									<button type="submit" name="Guardar" class="btn btn-primary">Guardar Contacto</button>
								</div>
							</div><!-- Fin de Bloque row-1 -->
			</form>