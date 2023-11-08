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
            isset($_POST['Codigo']) &&
            isset($_POST['CodPatrimonial']) &&
            isset($_POST['Nombre']) &&
            isset($_POST['Marca']) &&
            isset($_POST['Modelo']) &&
            isset($_POST['NumSerie']) &&
            isset($_POST['Estado']) &&
            isset($_POST['Caracteristicas']) &&
            isset($_POST['CodigoAmbiente'])
        ) {
            $codigo = intval($_POST['Codigo']);
            $codPatrimonial = $_POST['CodPatrimonial'];
            $nombre = $_POST['Nombre'];
            $marca = $_POST['Marca'];
            $modelo = $_POST['Modelo'];
            $numSerie = $_POST['NumSerie'];
            $estado = $_POST['Estado'];
            $caracteristicas = $_POST['Caracteristicas'];
            $codigoAmbiente = intval($_POST['CodigoAmbiente']);
            try {
                $sql = "UPDATE equipo
                        SET CodPatrimonial=? ,
                            Nombre = ? ,
                            Marca = ? ,
                            Modelo = ? ,
                            NumSerie = ? ,
                            Estado = ? ,
                            Caracteristicas = ? ,
                            CodigoAmbiente = ? 
                        WHERE Codigo = ?";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute([$codPatrimonial, $nombre, $marca, $modelo, $numSerie, $estado, $caracteristicas, $codigoAmbiente, $codigo]);

                echo "Equipo modificado";
                echo "<a href='MostrarEquipo.php' class='btn btn-info'> Regresar a mantenimiento</a>";
            } catch (PDOException $e) {
                echo "ERROR: " . $e->getMessage();
            }
        }
    } else {
        $codigo = $_GET['Codigo'];

        $sql = "SELECT * FROM equipo WHERE Codigo = ?";
        $registro = $conexion->prepare($sql);
        $registro->execute([$codigo]);

        //Obtener la FILA del equipo
        $fila = $registro->fetch();
    ?>

        <div class="container">
            <h1>MODIFICAR EQUIPO</h1>
            <form action="ModificarEquipo.php" method="POST">
                <input type="text" name="Codigo" value="<?= $codigo ?>" hidden>

                <div class="form-group">
                    <label for="CodPatrimonial">Codigo Patrimonial</label>
                    <input type="text" name="CodPatrimonial" value="<?= $fila['CodPatrimonial'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="Nombre">Nombre</label>
                    <input type="text" name="Nombre" value="<?= $fila['Nombre'] ?>" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <label for="Marca">Marca</label>
                    <input type="text" name="Marca" value="<?= $fila['Marca'] ?>" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <label for="Modelo">Modelo</label>
                    <input type="text" name="Modelo" value="<?= $fila['Modelo'] ?>" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <label for="NumSerie">NumSerie</label>
                    <input type="text" name="NumSerie" value="<?= $fila['NumSerie'] ?>" class="form-control"><br>
                </div>
                <div class="form-group">
                    <label for="Estado">Estado</label>
                    <input type="text" name="Estado" value="<?= $fila['Estado'] ?>" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <label for="Caracteristicas">Caracteristicas</label>
                    <input type="text" name="Caracteristicas" value="<?= $fila['Caracteristicas'] ?>" class="form-control"><br>
                </div>
                <div class="form-group">
                    <label for="CodigoAmbiente">Ambiente</label>
                    <select name="CodigoAmbiente" id="CodigoAmbiente" class="form-control" required>
                        <option value="">Seleccione el nuevo ambiente del equipo</option>
                        <?php
                        $consulta = $conexion->prepare("SELECT Codigo, Nombre FROM ambiente");
                        $consulta->execute();
                        $ambientes = $consulta->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($ambientes as $amb) {
                            $selected = ($amb['Codigo'] === $fila['CodigoAmbiente']) ? "selected" : "";
                            echo "<option value='{$amb['Codigo']}' $selected>{$amb['Nombre']}</option>";
                        }
                        ?>
                    </select>
                </div><br>
                <div class="form-group">
                    <button name="btnModificar" type="submit" class="btn btn-primary form-control">Guardar</button>
                </div>
            </form>
            <br>
            <a href="MostrarEquipo.php" class="btn btn-success form-control">Regresar a mantenimiento</a>
        </div>
    <?php
    }
    ?>
</body>

</html>
