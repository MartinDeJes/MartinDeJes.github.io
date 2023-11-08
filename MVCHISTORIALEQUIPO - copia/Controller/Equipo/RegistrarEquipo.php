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
        isset($_POST['CodPatrimonial']) == true &&
        isset($_POST['Nombre']) == true &&
        isset($_POST['Marca']) == true &&
        isset($_POST['Modelo']) == true &&
        isset($_POST['NumSerie']) == true &&
        isset($_POST['Estado']) == true &&
        isset($_POST['Caracteristicas']) == true &&
        isset($_POST['CodigoAmbiente']) == true
    ) {
        $codPatrimonial = $_POST['CodPatrimonial'];
        $nombre = $_POST['Nombre'];
        $marca = $_POST['Marca'];
        $modelo = $_POST['Modelo'];
        $numSerie = $_POST['NumSerie'];
        $estado = $_POST['Estado'];
        $caracteristicas = $_POST['Caracteristicas'];
        $codigoAmbiente = $_POST['CodigoAmbiente'];
        try {
            $sql = "insert into equipo(CodPatrimonial,Nombre,Marca,Modelo,NumSerie,Estado,Caracteristicas,CodigoAmbiente)
                    values(?,?,?,?,?,?,?,?)";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute([$codPatrimonial, $nombre, $marca, $modelo, $numSerie, $estado, $caracteristicas, $codigoAmbiente]);

            echo "Equipo agregado";
        } catch (PDOException $e) {
            echo "ERROR: ", $e->getMessage();
        }
    }
    ?>

    <div class="container">
        <h1>REGISTRO NUEVO EQUIPO</h1>
        <form action="RegistrarEquipo.php" method="POST">
            <div class="form-group">
                <label for="CodPatrimonial">Código Patrimonial</label>
                <input type="text" name="CodPatrimonial" class="form-control" require><br>
            </div>
            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre" class="form-control" require><br>
            </div>
            <div class="form-group">
                <label for="Marca">Marca</label>
                <input type="text" name="Marca" class="form-control" require><br>
            </div>
            <div class="form-group">
                <label for="Modelo">Modelo</label>
                <input type="text" name="Modelo" class="form-control" require><br>
            </div>
            <div class="form-group">
                <label for="NumSerie">NumSerie</label>
                <input type="text" name="NumSerie" class="form-control" require><br>
            </div>
            <div class="form-group">
                <label for="Estado">Estado</label>
                <input type="text" name="Estado" class="form-control" require><br>
            </div>
            <div class="form-group">
                <label for="Caracteristicas">Caracteristicas</label>
                <input type="text" name="Caracteristicas" class="form-control" require><br>
            </div>
            <div class="form-group">
                <label for="CodigoAmbiente">Ambiente</label>
                <select name="CodigoAmbiente" id="CodigoAmbiente" class="form-control" required>
                    <option value="">Seleccione el ambiente del equipo</option>
                    <?php
                    $consulta = $conexion->prepare("SELECT Codigo, Nombre FROM ambiente");
                    $consulta->execute();
                    $ambiente = $consulta->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($ambiente as $amb) {
                        echo "<option value='{$amb['Codigo']}' $selected>{$amb['Nombre']}</option>";
                    }
                    ?>
                </select>
            </div><br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Guardar</button>
                <a href="MostrarEquipo.php" class="btn btn-success form-control">Regresar a mantenimiento</a>
            </div>
        </form>
    </div>
</body>

</html>