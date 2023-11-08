<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Registrar Personal</title>
</head>

<body>
    <?php
    require("../../Model/conexion.php");

    if (
        isset($_POST['Nombres']) == true &&
        isset($_POST['Apellidos']) == true &&
        isset($_POST['Telefono']) == true &&
        isset($_POST['Correo']) == true &&
        isset($_POST['DNI']) == true
    ) {

        $nombres = $_POST['Nombres'];
        $apellidos = $_POST['Apellidos'];
        $telefono = $_POST['Telefono'];
        $correo = $_POST['Correo'];
        $dni = $_POST['DNI'];



        try {

            $sentencia2 = $conexion->prepare("select MAX(Codigo) AS UltimoUsuario from Usuario");
            $sentencia2->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia2->execute();

            if ($sentencia2) {
                $fila2 = $sentencia2->fetch();
                $codigoUsuario = $fila2['UltimoUsuario'];

                $sql = "insert INTO personalsoporte (Nombres, Apellidos, Telefono, Correo, DNI, CodigoUsuario)
                    VALUES (?, ?, ?, ?, ?, ?)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute([$nombres, $apellidos, $telefono, $correo, $dni, $codigoUsuario]);

                echo "personal agregado";
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    ?>

    <div class="container">
        <h1>Registrar Nuevo Responsable</h1>
        <form action="RegistrarPersonal.php" method="POST">
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
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Guardar</button>
                <a href="MostrarPersonal.php" class="btn btn-success form-control">Regresar a mantenimiento</a>
            </div>
        </form>
    </div>
</body>

</html>