<?php
session_start();

if(isset($_SESSION["user"])){
    $projectId = $_POST["project-id"];
    $amount = $_POST["money-entry"];
    
    // Conectarse a la base de datos (reemplaza con tus propias credenciales)
    $servername = "localhost"; // Nombre del servidor MySQL
    $username = "root"; // Nombre de usuario de MySQL
    $password = ""; // Contraseña de MySQL
    $database = "crowdfunding"; // Nombre de la base de datos
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }
    
    // Realizar operaciones necesarias con $projectId y $amount
    // Por ejemplo, insertar en la tabla de donaciones
    $sqlUsuario = 'SELECT id, usuario FROM usuarios WHERE usuario = "'.$_SESSION["user"].'";';
    $result = $conn->query($sqlUsuario);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idUsuario = $row["id"];
    }
        
    $sqlDonar = "INSERT INTO donaciones (idUsuario, idProyecto, donacion) VALUES ('$idUsuario','$projectId', '$amount')";
    if ($conn->query($sqlDonar) === TRUE) {
        // Envía una respuesta al cliente
        echo '<script>alert("Se ha donado correctamente");</script>';
    } else {
        // Si hay un error en la consulta SQL
        echo 'Error en la consulta SQL: ' . $conn->error;
    }
    
    $conn->close();
    header("Location: ./../pages/main-page.php");
}else{
    header("Location: ./../pages/login-page.php");
}
