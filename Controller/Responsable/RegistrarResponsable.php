<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Registrar Responsable</title>
</head>

<body>
    <?php
    require("../../Model/conexion.php");

    if (
        isset($_POST['Nombres']) == true &&
        isset($_POST['Apellidos']) == true &&
        isset($_POST['Telefono']) == true &&
        isset($_POST['Correo']) == true &&
        isset($_POST['DNI']) == true &&
        isset($_POST['CodigoAmbiente']) == true
    ) {

        $nombres = $_POST['Nombres'];
        $apellidos = $_POST['Apellidos'];
        $telefono = $_POST['Telefono'];
        $correo = $_POST['Correo'];
        $dni = $_POST['DNI'];
        $codigoAmbiente = $_POST['CodigoAmbiente'];

        try {
            // Inserta el nuevo Responsable en la tabla
            $sql = "INSERT INTO Responsable (Nombres, Apellidos, Telefono, Correo, DNI, CodigoAmbiente)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute([$nombres, $apellidos, $telefono, $correo, $dni, $codigoAmbiente]);

            echo "Responsable agregado";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    ?>

    <div class="container">
        <h1>Registrar Nuevo Responsable</h1>
        <form action="RegistrarResponsable.php" method="POST">
            <div class="form-group">
                <label for="Nombres">Nombres</label>
                <input type="text" name="Nombres" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Apellidos">Apellidos</label>
                <input type="text" name="Apellidos" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Telefono">Teléfono</label>
                <input type="text" name="Telefono" class="form-control">
            </div>
            <div class="form-group">
                <label for="Correo">Correo</label>
                <input type="email" name="Correo" class="form-control">
            </div>
            <div class="form-group">
                <label for="DNI">Numero de Documento:</label>
                <input type="text" name="DNI" class="form-control">
            </div>
            <div class="form-group">
                <label for="CodigoAmbiente">Ambiente</label>
                <select name="CodigoAmbiente" id="CodigoAmbiente" class="form-control" required>
                    <option value="">Seleccione el ambiente del responsable</option>
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
                <a href="MostrarResponsable.php" class="btn btn-success form-control">Regresar a mantenimiento</a>
            </div>
        </form>
    </div>
</body>

</html>