<?php
session_start();
if (empty($_SESSION['Codigo'])) {
    header("location:Login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Administrador.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</head>

<body>
    <section class="layout">
        <div class="header">
            <img src="./img/logoUnprg.png" alt="Logo" id="logo">
            <h1>Soporte Técnico</h1>
            <ul class="nav justify-content-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <?php
                        echo $_SESSION['Nombres'] . " " . $_SESSION['Apellidos'];
                        ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Mi perfil</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Cambiar de Cuenta</a></li>
                        <li><a class="dropdown-item" href="../Controller/Usuario/ValCerrarSesion.php">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="leftSide">
            <ul>
                <a href="http://localhost/MVCHISTORIALEQUIPO/Controller/Ambiente/MostrarAmbiente.php" target="miiframe">Ambientes</a>
            </ul>
            <ul>
                <a href="http://localhost/MVCHISTORIALEQUIPO/Controller/Equipo/MostrarEquipo.php" target="miiframe">Equipos</a>
            </ul>
            <ul>
                <a href="http://localhost/MVCHISTORIALEQUIPO/Controller/Responsable/MostrarResponsable.php" target="miiframe">Responsable</a>
            </ul>
            <ul>
                <a href="../Controller/Personal/MostrarPersonal.php" target="miiframe">Personal Soporte</a>
            </ul>
        </div>
        <div class="body">
            <article>
                <iframe name="miiframe" src="http://localhost/MVCHISTORIALEQUIPO/Controller/Ambiente/MostrarAmbiente.php"></iframe>
            </article>
        </div>

        <div class="footer">

            <p>@copyright Soporte Técnico</p>

        </div>
    </section>
    <script>
        // Función para alternar la visibilidad del menú en pantallas pequeñas
        function toggleNav() {
            var nav = document.querySelector("nav");
            nav.classList.toggle("show-nav");
        }
    </script>
</body>

</html>