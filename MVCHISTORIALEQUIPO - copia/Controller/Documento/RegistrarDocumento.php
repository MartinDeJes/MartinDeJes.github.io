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
        isset($_POST['NumSolicitud']) == true &&
        isset($_POST['Fecha']) == true &&
        isset($_POST['Detalles']) == true &&
        isset($_POST['Archivo']) == true &&
        isset($_POST['CodigoResponsable']) == true
    ) {
        $numSolicitud = $_POST['NumSolicitud'];
        $fecha = $_POST['Fecha'];
        $detalles = $_POST['Detalles'];
        $archivo = $_POST['Archivo'];
        $codigoResponsable = $_POST['CodigoResponsable'];
        try {
            $sql = "insert into equipo(NumSolicitud,Fecha,Detalles,Archivo,CodigoResponsable)
                    values(?,?,?,?,?)";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute([$numSolicitud, $fecha, $detalles, $archivo, $codigoResponsable]);

            echo "Documento agregado";
        } catch (PDOException $e) {
            echo "ERROR: ", $e->getMessage();
        }
    }
    ?>

    <div class="container">
        <h1>REGISTRO NUEVO DOCUMENTO</h1>
        <form action="RegistrarDocumento.php" method="POST">
            <div class="form-group">
                <label for="NumSolicitud">Número de la solicitud</label>
                <input type="text" name="NumSolicitud" class="form-control" require><br>
            </div>
            <div class="form-group">
                <label for="Fecha">Fecha</label>
                <input type="datetime" name="Fecha" class="form-control" require><br>
            </div>
            <div class="form-group">
                <label for="Detalles">Detalles</label>
                <input type="text" name="Detalles" class="form-control" require><br>
            </div>
            <div class="form-group">
                <label for="Archivo">Archivo</label>
                <input type="text" name="Archivo" class="form-control"><br>
            </div>
            <div class="form-group">
                <label for="CodigoResponsable">Responsable</label>
                <select name="CodigoResponsable" id="CodigoResponsable" class="form-control" required>
                    <option value="">Seleccione al responsable del documento</option>
                    <?php
                    $consulta = $conexion->prepare("SELECT Codigo, Nombre FROM responsable");
                    $consulta->execute();
                    $responsable = $consulta->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($responsable as $resp) {
                        echo "<option value='{$resp['Codigo']}' $selected>{$resp['Nombre']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Guardar</button>
                <a href="MostrarDocumento.php" class="btn btn-success form-control">Regresar a mantenimiento</a>
            </div>
        </form>
    </div>
</body>

</html>