<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Advanced Security - PHP MySQL Register/Login System">
    <meta name="author" content="Milos Stojanovic (@loshmis)">
    <title>Login | WEBSITE_NAME</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/app.css" type="text/css" media="all" />
</head>

<body>
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

    // Manejar inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = $dbh->prepare("SELECT * FROM usuarios WHERE usuario = :username AND passwd = :password");
        $sql->bindParam(':username', $username);
        $sql->bindParam(':password', $password);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Usuario o contraseña incorrectos</div>";
        }
    }
    ?>

</body>

</html>