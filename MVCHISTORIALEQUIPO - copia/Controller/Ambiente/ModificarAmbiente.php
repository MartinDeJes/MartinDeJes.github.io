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
    if (isset($_POST['btnModificar'])) {
        if (
            isset($_POST['Codigo'])==true &&
            isset($_POST['Nombre']) == true &&
            isset($_POST['Vigente']) == true
        ) {
            $codigo = intval($_POST['Codigo']);
            $nombre = $_POST['Nombre'];
            $vigente = intval($_POST['Vigente']);
            try {
                $sql = "update ambiente
                        set Nombre = ?
                        set Vigente = ?
                        where Codigo=?";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute([$nombre, $vigente, $codigo]);

                echo "Ambiente modificado";
                echo "<a href='MostrarAmbiente.php' class='btn btn-info'> Regresar a mantenimiento</a>";
            } catch (PDOException $e) {
                echo "ERROR: ", $e->getMessage();
            }
        }
    } else {
        $codigo = $_GET['Codigo'];

        $sql = "select * from ambiente where Codigo = $codigo";
        $registro = $conexion->prepare($sql);
        $registro->execute();

        //Obtener la FILA del Ambiente
        $fila = $registro->fetch();

    ?>

        <div class="container">
            <h1>MODIFICAR AMBIENTE</h1>
            <form action="ModificarAmbiente.php" method="POST">
                <input type="text" name="Codigo" value="<?= $codigo ?>" hidden>

                <div class="form-group">
                    <label for="Nombre">Nombre</label>
                    <input type="text" name="Nombre" value="<?= $fila['Nombre'] ?>" class="form-control" require><br>
                </div>
                <div class="form-group">
                    <label for="Vigente">Vigente</label><br>
                    <select name="Vigente" id="Vigente">
                    <option value="1" <?php if ($fila['Vigente'] == "1") echo "selected"; ?>>Activo</option>
                    <option value="0" <?php if ($fila['Vigente'] == "0") echo "selected"; ?>>Deshabilitado</option>
                    </select>
                </div><br>
                <div class="form-group">
                    <button name="btnModificar" type="submit" class="btn btn-primary form-control">Guardar</button>
                </div>
            </form>
            <br>
            <a href="MostrarAmbiente.php" class="btn btn-success form-control">Regresar a mantenimiento</a>
        </div>
    <?php
    }
    ?> 
</body>

</html>