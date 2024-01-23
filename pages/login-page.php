<?php
session_start(); // Iniciar o reanudar la sesión

// Si la sesión ya está iniciada, redirige a main-page.php
if (isset($_SESSION["user"])) {
    header('Location: main-page.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CROWDFUNDHUB</title>

    <link rel="stylesheet" href="../css/comun-for-all.css">
    <link rel="stylesheet" href="../css/login-page.css">

</head>

<body>
    <div class="top-bar">
        <img src="../assets/crowdfundhubLogo.svg" alt="Logo de crowdfundhub">
        <a href="./main-page.php">Volver</a>
    </div>
    <form action="" method="post" class="login-form">
        <h1>Iniciar Sesion</h1>
        <p>Inicia sesión y accede a nuestra comunidad comprometida para brindar apoyo a proyectos significativos. Al
            iniciar sesión con tu cuenta, tendrás la oportunidad de explorar diversas iniciativas y contribuir con
            causas que resuenen contigo.</p>

        <label for="username">Nombre de usuario</label>
        <input type="text" name='username' id='username' required>

        <label for="password">Contraseña</label>
        <input type="password" name='password' id='password' required>

        <button type="submit">Iniciar Sesion</button>
        <a href="./register-page.php">¿No tienes cuenta? Regístrate</a>

    </form>
    <?php
        // Insertar datos en la base de datos cuando se envía el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost"; // Nombre del servidor MySQL
            $username = "root"; // Nombre de usuario de MySQL
            $password = ""; // Contraseña de MySQL
            $database = "crowdfunding"; // Nombre de la base de datos

            $conn = new mysqli($servername, $username, $password, $database);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Error en la conexión a la base de datos: " . $conn->connect_error);
            }
            
            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM usuarios WHERE usuario = '$username';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Usuario encontrado, verifica la contraseña
                $row = $result->fetch_assoc();
                $hashed_password = $row["contrasena"];
        
                if (password_verify($password, $hashed_password)) {
                    // Contraseña válida, inicia sesión y redirige
                    $_SESSION["user"] = $username;
                    header('Location: main-page.php');
                    exit();
                }else{
                    echo '<script>alert("dwadwadwa");</script>';
                }
            } else {
                // Usuario no encontrado
                echo '<script>alert("Datos de inicio de sesión incorrectos");</script>';
            }
            
            $conn->close(); 
        }
    ?>

</body>

</html>