<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

	<title>Document</title>
</head>

<body>

	<!-- /// MODAL NUEVA EMPRESA  ///-->
	<div class="modal fade" id="nuevaempresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLabel">Nueva Empresa</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form role="form" action="grabar-empresa.php" method="POST" id="nuevaempresa" enctype="multipart/form-data">
					
					

					<div class="modal-body mt-0 pt-2">

						<body class="card-body mt-0 pt-0"><!-- Card-1 -->

							<form class="row "><!-- Bloque row-1 -->
								<div class="col-md-12">
									<!--h4 class="form-label font-weight-bold mt-1">Datos corporativos:</h4-->
									<div class="row"><!-- row-1 -->
										<div class="col-sm-6 col-md-6 col-lg-6">
											<legend class="font-weight-bold">Tipo de empresa:&nbsp</legend>
											<label class="form-check form-check-inline">
												<span class="form-check-label">
													Cliente
												</span>
												<input class="form-check-input" type="radio" name="rolempresa" checked="checked" value="Cliente">

											</label>
											<label class="form-check form-check-inline">
												<span class="form-check-label">
													Proveedor
												</span>
												<input class="form-check-input" type="radio" name="rolempresa" value="Proveedor">
											</label>
										</div>

										<div class="col-sm-6 col-md-6 col-lg-3">
											<legend class="font-weight-bold">Modalidad:&nbsp</legend>
											<label class="form-check form-check-inline">
												<span class="form-check-label">
													Empresa
												</span>
												<input class="form-check-input" type="radio" name="modalidad" checked="checked" value="Empresa">
											</label>
											<label class="form-check form-check-inline">
												<span class="form-check-label">
													Autónomo
												</span>
												<input class="form-check-input" type="radio" name="modalidad" value="Autónomo">
											</label>
										</div>

										<div class="col-sm-12 col-md-6 col-lg-3">
											<div class="form-group">
												<label class="form-label font-weight-bold" for="nif">NIF:</label>
												<input id="nif" class="form-control" type="text" name="nif" autocomplete="off" required>
											</div>
										</div>

									</div>

									<div class="row "><!-- Bloque row-2 -->

										<div class="col-sm-12 col-md-12 col-lg-12">
											<div class="form-group">
												<label class="form-label font-weight-bold" for="nombrejuridico">Nombre Empresa:</label>
												<input id="nombrejuridico" class="form-control" type="text" name="nombre" autocomplete="off" required>
											</div>
										</div>


										<div class="col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label class="form-label font-weight-bold" for="nif">Tlfno móvil:</label>
												<input id="tlfmovil" class="form-control" type="text" name="tlfmovil" autocomplete="off">
											</div>
										</div>

										<div class="col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label class="form-label font-weight-bold" for="nif">E-mail:</label>
												<input id="tlffijo" class="form-control" type="text" name="email" autocomplete="off">
											</div>
										</div>
									</div>
								</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
										<button type="submit" name="Guardar" class="btn btn-primary">Guardar empresa</button>
									</div>
							</form>
						</body>