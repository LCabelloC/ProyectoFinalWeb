<?php
session_start();
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
    <link rel="stylesheet" href="../css/register-page.css">

</head>

<body>
    <div class="top-bar">
        <img src="../assets/crowdfundhubLogo.svg" alt="Logo de crowdfundhub">
        <a href="./main-page.php">Volver</a>
    </div>
    <form action="" method="post" class="register-form">
        <h1>Registro</h1>
        <p>Regístrate ahora para formar parte de nuestra comunidad solidaria. Al crear tu cuenta, podrás descubrir
            proyectos inspiradores y contribuir a causas significativas. Conecta con otros defensores y sigue de cerca
            el impacto que logramos juntos. Únete a nosotros, regístrate y haz la diferencia hoy.</p>


        <label for="name">Nombre y apellidos</label>
        <input type="text" id='name' name='name' required>

        <label for="username">Nombre de usuario</label>
        <input type="text" id='username' name='username' required>

        <label for="email">Correo electrónico</label>
        <input type="email" id='email' name='email' required>

        <label for="password">Contraseña</label>
        <input type="password" id='password' name='password' required>

        <button type="submit">Registrarse</button>
        <a href="./login-page.php">Volver al login</a>

    </form>
    <?php
        // Insertar datos en la base de datos cuando se envía el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost"; // Nombre del servidor MySQL
            $username = "root"; // Nombre de usuario de MySQL
            $password = ""; // Contraseña de MySQL
            $database = "crowdfunding"; // Nombre de la base de datos
    
            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Error en la conexión a la base de datos: " . $conn->connect_error);
            }

            $name = $_POST["name"];
            $user = $_POST["username"];
            $email = $_POST["email"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash de la contraseña

            $sql = "SELECT * FROM usuarios WHERE usuario = '$user'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Usuario encontrado, puedes hacer algo aquí si es necesario
                echo '<script>alert("¡Error! El nombre de usuario ya existe.");</script>';
            }else{
                $sql = "INSERT INTO usuarios(nombre, usuario, contrasena, correo)
                VALUES('$name','$user','$password','$email')";

                if ($conn->query($sql) === TRUE) {
                    $_SESSION["user"] = $user;
                    header('Location: main-page.php');
                } else {
                    echo '<script>alert("Erro al insertar los datos");</script>';
                }
            }            

            $conn->close();
        }
    ?>

</body>

</html>