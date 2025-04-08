<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Advanced Security - PHP MySQL Register/Login System">
    <meta name="author" content="Advanced Security">
    <meta name="keywords" content="PHP, MySQL, Register, Login, System">
    <title>Mira Digital</title>
    <link rel="stylesheet" href="css/style_index.css">
    <!-- Carga de Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <!-- <link rel="stylesheet" href="css/main.css" type="text/css"> -->
    <!-- <link href="css/app.css" rel="stylesheet"> -->


</head>

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once 'conectar.php';

try {

    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

    
        

        <div class="wrapper">
        <body class="bg-light">


    <div class="container">
        <?php include("nav.html"); ?>

    </div>
        <section class="banner">
            <!-- Imagen de fondo -->
            <img src="imagenes/mira_digital_cover.jpg" alt="Banner de tienda" class="banner-image">

            <!-- Contenido del banner -->
            <h1>Bienvenido a Mira Digital</h1>
            <p>Explora nuestros productos audiovisuales</p>
            <a href="/tienda" class="cta-button">Ver tienda</a>
        </section>
            <!-- Productos destacados -->
            <section class="productos">
                <h2>Productos Destacados</h2>

                <div class="productos-container">
                    <div class="producto-card">
                        <img src="imagenes/camara.jpg" alt="Producto 1">
                        <h2>Sony</h2>
                        <h3>AZG800</h3>
                        <p>1505€</p>
                        <a href="https://www.adidas.es/zapatilla-gazelle-indoor/JI2062.html" class="btn-ver">Ver producto</a>
                    </div>
                    <div class="producto-card">
                        <img src="imagenes/microfono_sony.jpg" alt="Producto 2">
                        <h2>Takstar</h2>
                        <h3>SGC-600</h3>
                        <p>300€</p>
                        <a href="https://www.ripndipclothing.com/?adscale=1&campaign_id=16638285497&creativeId=687688838541&device=c&gad_source=1&gclid=EAIaIQobChMIzea3vNeqigMV9mVBAh3hjgGKEAAYASAAEgJYUPD_BwE&network=g&utm_campaign=&utm_medium=cpc&utm_source=google&utm_term=ripndip" class="btn-ver">Ver producto</a>
                    </div>
                    <div class="producto-card">
                        <img src="imagenes/tripode.jpg" alt="Producto 3">
                        <h2>Leofoto</h2>
                        <h3>MT-04</h3>
                        <p>120</p>
                        <a href="/producto/zapatillas-xtreme" class="btn-ver">Ver producto</a>
                    </div>
                </div>
            </section>
            <body class="bg-light">
    <div class="container">
        <!-- Contenido principal de la página -->
    </div>
    <?php include 'footer.html'; ?>
</body>
            
        <?php
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        die();
    }

    // Manejar cierre de sesión
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
        ?>
 

        <!-- Include Bootstrap and Popper.js scripts -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>