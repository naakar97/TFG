

<script src="js/sweetalert2.all.min.js"></script>
<?php
						if (isset($_GET['r']) && $_GET['r'] == 1) {
							echo "<script>
							Swal.fire({
									position: 'top-center',
									icon: 'success',
									title: 'Registro grabado correctamente',
									showConfirmButton: false,
									timer: 1000
								})
								</script>";
							} 
// EL r=1 es el ok cada vez que haces el header location
                                header("Location:editar-empresa.php?id=$idc&r=1")


								//MEJOR FORMA
								
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

		

						?>