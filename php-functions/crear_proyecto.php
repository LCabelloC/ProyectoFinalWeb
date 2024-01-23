<?php

session_start();

$servername = "localhost"; // Nombre del servidor MySQL
$username = "root"; // Nombre de usuario de MySQL
$password = ""; // Contraseña de MySQL
$database = "crowdfunding"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

$titulo = $_POST["project-title"];
$descripcion = $_POST["project-description"];
$cantidad = $_POST["project-amount"];

// Procesar la imagen
$imagen_nombre = $_FILES["project-image"]["name"];
$imagen_extension = pathinfo($imagen_nombre, PATHINFO_EXTENSION);

// Generar un nombre único para la imagen usando la marca de tiempo
$nombre_unico = "imagen_" . time() . "." . $imagen_extension;

$imagen_temp = $_FILES["project-image"]["tmp_name"];
$carpeta_destino = "./../assets/project-images/";

// Mover la imagen al servidor con el nombre único
move_uploaded_file($imagen_temp, $carpeta_destino . $nombre_unico);

$ruta_imagen = $carpeta_destino . $nombre_unico;

$sql = "INSERT INTO proyectos(titulo, descripcion, ruta_foto, goal) VALUES('$titulo', '$descripcion', '$ruta_imagen', $cantidad)";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Proyecto insertado correctamente");</script>';
} else {
    echo '<script>alert("Error al insertar los datos: ' . $conn->error . '");</script>';
}

$conn->close();

header("Location: ./../pages/main-page.php");