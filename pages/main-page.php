<?
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
    <div class="top-bar">
        <img src="../assets/crowdfundhubLogo.svg" alt="Logo de crowdfundhub">
        <a href="./login-page.php">Iniciar Sesión</a>
    </div>
    <section id="home-section">
        <div class="initial-content">
            <h1>Transforma sueños en logros</h1>
            <p>Bienvenido a nuestro proyecto, donde los sueños se convierten en realidad con tu ayuda. Cada contribución
                es un paso hacia adelante en la creación de algo extraordinario. Únete a nosotros en este viaje
                emocionante y sé parte del cambio que queremos lograr. ¡Gracias por ser parte de este sueño hecho
                realidad!</p>
        </div>
        <div class="cards-data">
            <div class="default-card">
                <p class="card-text">Personas ayudadas
                    <span>1058</span>
                </p>
                <div class="circle-decoration circle-help-card"></div>
            </div>
            <div class="total-money">
                <p class="card-text">Hemos ayudado con un total de:
                    <span>10000 $</span>
                </p>
                <div class="total-money-info-text">
                    <img src="../assets/dinero.png" alt="Dolar logo">
                    <p class="money-info">Dinero recaudado</p>
                </div>
            </div>
            <div class="default-card">
                <p class="card-text">Contribuyentes
                    <span>1058</span>
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
            <div class="card-proyecto" project-id=1>
                <img src="../assets/motor-bike.webp" alt="Nuevo circuito de motos">
                <div class="card-proyecto-info">
                    <h3>Nuevo circuito de motos</h3>
                    <p>Ayudanos a crear nuestero circuito de motocross y llevarlo a lo más alto</p>
                    <p>565800/700000</p>
                    <div class="progress">
                        <div class="progress-bar" style="width:75%;">
                            <span class="progress-bar-text">75%</span>
                        </div>
                    </div>
                    <button class="donate-button"
                        onclick="openButton(1, 'Nuevo circuito de motos', '../assets/motor-bike.webp')">Donar</button>
                </div>
            </div>
            <div class="card-proyecto">
                <p class="add-project-title">Añade tu proyecto</p>
                <button class="add-project" onclick="createProject()"></button>
            </div>
        </div>

    </section>
    <div id="blur-color-1">
        <form id="donation-form">
            <h2>Donación</h2>
            <img id="project-img" src="" alt="">
            <p>Realizando donación a: <br><span id='title-project'></span></p>
            <input type="hidden" id="project-id" name="project-id">
            <p>A continuación, ingrese el dinero que quiere donar:</p>
            <input type="number" min="1" class="money-entry">

            <button type="button" onclick="closeButton()" class='close-pop-up'>X</button>
            <button class="donate-button">Confirmar</button>

        </form>
    </div>

    <div id="blur-color-2">
        <form id="create-project">
            <h2>Crear proyecto</h2>

            <label for="project-title">Título del proyecto:</label>
            <input type="text" id="project-title" placeholder="Ingrese el título del proyecto">

            <label for="project-description">Descripción del proyecto (máx. 100 caracteres):</label>
            <textarea id="project-description" maxlength="100"></textarea>

            <label for="project-image">Imagen del proyecto:</label>
            <input type="file" id="project-image" accept="image/*" onchange="previewImage()">

            <img id="image-preview" alt="Vista previa de la imagen" style="max-width: 100%; max-height: 200px;">


            <label for="project-amount">Valor a recaudar:</label>
            <input type="number" id="project-amount" placeholder="Ingrese el valor a recaudar" min="100000">

            <button type="button" onclick="closeCreateProject()" class='close-pop-up'>X</button>
            <button class="donate-button">Confirmar</button>

        </form>
    </div>

    <script src='../js/functions.js'></script>
</body>

</html>