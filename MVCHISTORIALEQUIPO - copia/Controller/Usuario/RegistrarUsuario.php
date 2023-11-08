<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Soporte</title>
</head>

<body>
    <?php
    require("../../Model/conexion.php");

        if (
            isset($_POST['Nombre']) == true &&
            isset($_POST['Contraseña']) == true 
        ) {
    
            $nombre = $_POST['Nombre'];
            $contraseña = $_POST['Contraseña'];
    
            try {
                // Inserta el nuevo Responsable en la tabla
                $sql = "insert INTO usuario (Nombre,Contraseña)
                        VALUES (?, ?)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute([$nombre, $contraseña]);
                
                header("location:../Personal/RegistrarPersonal.php");
                
            } catch (PDOException $e) {
                echo "ERROR: " . $e->getMessage();
            }
        }

    ?>

    <div class="container">
        <h2>Primero registra un Usuario</h2>
        <form action="RegistrarUsuario.php" method="POST">
            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Contraseña">Contraseña</label>
                <input type="password" name="Contraseña" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <button name="btnRegistrarUsuario" type="submit" class="btn btn-primary form-control">Guardar</button>
                <a href="../Personal/MostrarPersonal.php" class="btn btn-success form-control">Regresar a mantenimiento</a>
            </div>
        </form>
    </div>
</body>

</html>