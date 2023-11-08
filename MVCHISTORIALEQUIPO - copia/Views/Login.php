<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="rectangulo">
            <div class="image-container">
                <img src="./img/login.jpg" alt="Phone image">
            </div>
            <div class="form-container">
                <h1>Login</h1>
                <?php
                require('../Model/conexion.php');
                require('../Controller/Usuario/ValidacionInicioSesion.php');
                ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" id="usuario" name="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" id="contraseña" name="contraseña" class="form-control">
                    </div>
                    <button name="btnEnviar" type="submit" value="Enviar" class="btn btn-primary btn-block">Entrar</button>
                    <a href="RegistrarUser.php">¿No tienes una cuenta? Regístrate</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
