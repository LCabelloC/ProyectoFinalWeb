<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CROWDFUNDHUB</title>

    <link rel="stylesheet" href="../css/main-page.css">
    <link rel="stylesheet" href="../css/comun-for-all.css">
</head>

<body>
    <?php if (!isset($_SESSION["user"])){ ?>
        <div class="top-bar">
            <img src="../assets/crowdfundhubLogo.svg" alt="Logo de crowdfundhub">
            <a href="./login-page.php">Iniciar sesion</a>
        </div>
    <?php }else{ ?>
        <div class="top-bar">
                <img src="../assets/crowdfundhubLogo.svg" alt="Logo de crowdfundhub">
                <form action="./../php-functions/cerrar_sesion.php"> <input type="submit" value="Cerrar sesion" id="cerrar-sesion-button"></form>
        </div>
    <?php } ?>
    <section id="home-section">
        <div class="initial-content">
            <h1>Transforma sueños en logros</h1>
            <p>Bienvenido a nuestro proyecto, donde los sueños se convierten en realidad con tu ayuda. Cada contribución
                es un paso hacia adelante en la creación de algo extraordinario. Únete a nosotros en este viaje
                emocionante y sé parte del cambio que queremos lograr. ¡Gracias por ser parte de este sueño hecho
                realidad!</p>
        </div>
        <?php
            $servername = "localhost"; // Nombre del servidor MySQL
            $username = "root"; // Nombre de usuario de MySQL
            $password = ""; // Contraseña de MySQL
            $database = "crowdfunding"; // Nombre de la base de datos

            $conn = new mysqli($servername, $username, $password, $database);
            $consulta = "SELECT COUNT(DISTINCT idUsuario) AS numero_usuarios,
            COUNT(DISTINCT idProyecto) AS numero_proyectos,
            SUM(donacion) AS suma_donaciones
             FROM donaciones;
            ";
            $result = $conn->query($consulta);
            $row = $result->fetch_assoc();
        ?>
        <div class="cards-data">
            <div class="default-card">
                <p class="card-text">Personas ayudadas
                    <span><?php echo $row["numero_proyectos"]?></span>
                </p>
                <div class="circle-decoration circle-help-card"></div>
            </div>
            <div class="total-money">
                <p class="card-text">Hemos ayudado con un total de:
                    <span><?php echo number_format($row["suma_donaciones"], 0, '', '.')?>€</span>
                </p>
                <div class="total-money-info-text">
                    <img src="../assets/dinero.png" alt="Dolar logo">
                    <p class="money-info">Dinero recaudado</p>
                </div>
            </div>
            <div class="default-card">
                <p class="card-text">Contribuyentes
                    <span><?php echo $row["numero_usuarios"]?></span>
                </p>
                <div class="circle-decoration group"></div>
            </div>
        </div>
    </section>
    <section id="explora-los-proyectos">
        <div class="initial-content proyectos-info">
            <h2>Explora los proyecos</h2>
            <p>Sumérgete en la diversidad de nuestras iniciativas inspiradoras. Explora los proyectos que forman parte
                de nuestra misión, cada uno contando una historia única de impacto y transformación. Desde
                contribuciones comunitarias hasta proyectos innovadores, descubre cómo estamos haciendo una diferencia
                positiva en diversas áreas. ¡Encuentra la causa que resuena contigo y únete a nosotros para crear un
                cambio significativo juntos!</p>
        </div>
        <div class="proyectos-grid">
            <?php
                $servername = "localhost"; // Nombre del servidor MySQL
                $username = "root"; // Nombre de usuario de MySQL
                $password = ""; // Contraseña de MySQL
                $database = "crowdfunding"; // Nombre de la base de datos
    
                $conn = new mysqli($servername, $username, $password, $database);
                $sql = "SELECT
                    p.id,
                    p.titulo,
                    p.descripcion,
                    p.ruta_foto,
                    p.goal,
                    COALESCE(SUM(d.donacion), 0) as suma_donaciones
                FROM
                    proyectos p
                LEFT JOIN
                    donaciones d ON p.id = d.idProyecto
                GROUP BY
                    p.id, p.titulo, p.descripcion, p.ruta_foto, p.goal;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Recorrer los resultados y mostrarlos
                    while ($row = $result->fetch_assoc()) {
                        $porcentaje = ($row["goal"] > 0) ? ($row["suma_donaciones"] / $row["goal"]) * 100 : 0;
                        $porcentaje_limitado = min($porcentaje, 100);
                        $porcentaje_formateado = number_format($porcentaje_limitado, 2) . '%';

                        echo ' <div class="card-proyecto" project-id='.$row["id"].'>
                        <img src="'.$row["ruta_foto"].'" alt="'.$row["titulo"].'">
                        <div class="card-proyecto-info">
                            <h3>'.$row["titulo"].'</h3>
                            <p>'.$row["descripcion"].'</p>
                            <p>'.$row["suma_donaciones"].'€/'.$row["goal"].'€</p>
                            <div class="progress">
                                <div class="progress-bar" style="width:'.$porcentaje_formateado.';">
                                    <span class="progress-bar-text">'.$porcentaje_formateado.'</span>
                                </div>
                            </div>
                            <button class="donate-button"
                            onclick="openButton(' . $row["id"] . ', \'' . $row["titulo"] . '\', \'' . $row["ruta_foto"] . '\')">Donar</button>
                        </div>
                    </div>';
                    }
                }

                $conn->close();
            ?>
            <div class="card-proyecto">
                <p class="add-project-title">Añade tu proyecto</p>
                <button class="add-project" onclick="createProject()"></button>
            </div>
        </div>

    </section>
    <div id="blur-color-1">
        <form id="donation-form" method="post" action="./../php-functions/donar.php">
            <h2>Donación</h2>
            <img id="project-img" src="" alt="">
            <p>Realizando donación a: <br><span id='title-project'></span></p>
            <p>A continuación, ingrese el dinero que quiere donar:</p>
            <input type="number" min="1" name="money-entry" class="money-entry" required>
            <input name="project-id" id="project-id" type="hidden">

            <button type="button" onclick="closeButton()" class='close-pop-up'>X</button>
            <button class="donate-button">Confirmar</button>
        </form>
    </div>

    <div id="blur-color-2">
        <form id="create-project" method="post" action="./../php-functions/crear_proyecto.php" enctype="multipart/form-data">
            <h2>Crear proyecto</h2>

            <label for="project-title">Título del proyecto:</label>
            <input type="text" id="project-title" placeholder="Ingrese el título del proyecto" name="project-title" required> 

            <label for="project-description">Descripción del proyecto (máx. 100 caracteres):</label>
            <textarea id="project-description" maxlength="100" name="project-description" required></textarea>

            <label for="project-image">Imagen del proyecto:</label>
            <input type="file" id="project-image" name="project-image" accept="image/*" onchange="previewImage()" required>

            <img id="image-preview" alt="Vista previa de la imagen" style="max-width: 100%; max-height: 200px;">


            <label for="project-amount">Valor a recaudar:</label>
            <input type="number" id="project-amount" name="project-amount" placeholder="Ingrese el valor a recaudar" min="100000" required>

            <button type="button" onclick="closeCreateProject()" class='close-pop-up'>X</button>
            <button class="donate-button">Confirmar</button>

        </form>
    </div>

    <script src='../js/functions.js'></script>
</body>

</html>