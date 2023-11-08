<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>

<style>
    .buscar-input {
        width: 200px;
        height: 35px;
    }

    .margen-superior {
        margin-top: 20px;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 margen-superior">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>MANTENIMIENTO DE DOCUMENTOS</h2>
                    <div>
                        <form action="" method="post">
                            <input type="text" name="search" class="buscar-input" placeholder="Buscar por código">
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </form>
                        <a href="RegistrarDocumento.php" class="btn btn-success">Nuevo Documento</a>
                    </div>
                </div>

                <table class="table table-ms">
                    <tr>
                        <td>ID</td>
                        <td>Numero Solicitud</td>
                        <td>Fecha</td>
                        <td>Detalles</td>
                        <td>Archivo</td>
                        <td>Responsable</td>
                        <td>Operaciones</td>
                    </tr>
                    <?php
                    require("../../Model/conexion.php");
                    //Buscar
                    // Verifica si se ha enviado una consulta de búsqueda
                    if (isset($_POST['search'])) {
                        $searchTerm = $_POST['search'];
                        // Prepara una consulta que busca el término ingresado en el número de equipo
                        $sentencia = $conexion->prepare("SELECT * FROM documento WHERE NumSolicitud LIKE ?");
                        $searchTerm = "%$searchTerm%"; // Agrega comodines para buscar de manera parcial
                        $sentencia->bindParam(1, $searchTerm);
                    } else {
                        // Si no hay consulta de búsqueda, muestra todos los registros
                        $sentencia = $conexion->prepare("SELECT * FROM documento");
                    }

                    // Formato de devolución
                    $sentencia->setFetchMode(PDO::FETCH_ASSOC);
                    $sentencia->execute();

                    // Recorre la sentencia y sus resultados
                    while ($fila = $sentencia->fetch()) {
                        echo ("<tr>");
                        echo ("<td>" . $fila['Codigo'] . "</td>");
                        echo ("<td>" . $fila['NumSolicitud'] . "</td>");
                        echo ("<td>" . $fila['Fecha'] . "</td>");
                        echo ("<td>" . $fila['Detalles'] . "</td>");
                        echo ("<td>" . $fila['Archivo'] . "</td>");
                        echo ("<td>" . obtenerResp($fila['CodigoResponsable']) . "</td>");
                        echo ("<td>" . "<a href='ModificarDocumento.php?Codigo={$fila['Codigo']}' class='btn btn-danger'>Modificar</a>" . "</td>");
                        echo ("</tr>");
                    }

                    function obtenerResp($Codigo)
                    {
                        require("../../Model/conexion.php");
                        $sql = "select Nombre from responsable where Codigo = ?";
                        $registro = $conexion->prepare($sql);
                        $registro->execute([$Codigo]);
                        $responsables = $registro->fetch(PDO::FETCH_ASSOC);
                        return $responsables['Nombre'];
                    }

                    ?>
                </table>
            </main>
        </div>
    </div>
</body>

</html>