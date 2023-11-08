<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php
    require("../../Model/conexion.php");
    if (
        isset($_POST['Nombre']) == true
    ) {
        $nombre = $_POST['Nombre'];
        try {
            $sql = "insert into ambiente(Nombre)
                    values(?)";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute([$nombre]);

            echo "Ambiente agregado";
        } catch (PDOException $e) {
            echo "ERROR: ", $e->getMessage();
        }
    }
    ?>

    <div class="container">
        <h1>REGISTRO NUEVO AMBIENTE</h1>
        <form action="RegistrarAmbiente.php" method="POST">
            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre" class="form-control" require><br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Guardar</button>
                <a href="MostrarAmbiente.php" class="btn btn-success form-control">Regresar a mantenimiento</a>
            </div>
        </form>
    </div>
</body>
</html>
