<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Modificar Responsable</title>
</head>

<body>
    <?php
    require("../../Model/conexion.php");
    
    if (isset($_POST['btnModificar'])) {
        if (
            isset($_POST['Codigo']) == true &&
            isset($_POST['Nombres']) == true &&
            isset($_POST['Apellidos']) == true &&
            isset($_POST['Telefono']) == true &&
            isset($_POST['Correo']) == true &&
            isset($_POST['DNI']) == true

        ) {
            $codigo = intval($_POST['Codigo']);
            $nombres = $_POST['Nombres'];
            $apellidos = $_POST['Apellidos'];
            $telefono = $_POST['Telefono'];
            $correo = $_POST['Correo'];
            $DNI = $_POST['DNI'];
    
            try {
                $sql = "UPDATE PersonalSoporte
                        SET Nombres=?, Apellidos=?, Telefono=?, Correo=?, DNI=?
                        WHERE Codigo=?";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute([$nombres, $apellidos, $telefono, $correo, $DNI, $codigo]);
    
                echo "Personal modificado";
                echo "<a href='MostrarPersonal.php' class='btn btn-info'>Regresar a mantenimiento</a>";
            } catch (PDOException $e) {
                echo "ERROR: ", $e->getMessage();
            }
        }
    } else {
        $codigo = $_GET['Codigo'];

        $sql = "select * FROM PersonalSoporte WHERE Codigo = $codigo";
        $registro = $conexion->prepare($sql);
        $registro->execute();

        // Obtener la fila del Responsable
        $fila = $registro->fetch();

    ?>

        <div class="container">
            <h1>MODIFICAR RESPONSABLE</h1>
            <form action="ModificarPersonal.php" method="POST">
                <input type="text" name="Codigo" value="<?= $codigo ?>" hidden>

                <div class="form-group">
                    <label for="Nombres">Nombres</label>
                    <input type="text" name="Nombres" value="<?= $fila['Nombres'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="Apellidos">Apellidos</label>
                    <input type="text" name="Apellidos" value="<?= $fila['Apellidos'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="Telefono">Teléfono</label>
                    <input type="text" name="Telefono" value="<?= $fila['Telefono'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Correo">Correo</label>
                    <input type="email" name="Correo" value="<?= $fila['Correo'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="DNI">Número de DNI</label>
                    <input type="text" name="DNI" value="<?= $fila['DNI'] ?>" class="form-control">
                </div>
                
            </div><br>
                <div class="form-group">
                    <button name="btnModificar" type="submit" class="btn btn-primary form-control">Guardar</button>
                </div>
            </form>
            <br>
            <a href='MostrarPersonal.php' class='btn btn-success form-control'>Regresar a mantenimiento</a>
        </div>
    <?php
    }
    ?>
</body>

</html>