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
                    <h2>MANTENIMIENTO DE EQUIPOS</h2>
                    <div>
                        <form action="" method="post">
                            <input type="text" name="search" class="buscar-input" placeholder="Buscar por código patrimonial">
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </form>
                        <a href="RegistrarEquipo.php" class="btn btn-success">Nuevo Equipo</a>
                    </div>
                </div>

                <table class="table table-ms">
                    <tr>
                        <td>ID</td>
                        <td>Codigo Patrimonial</td>
                        <td>Nombre</td>
                        <td>Marca</td>
                        <td>Modelo</td>
                        <td>NumSerie</td>
                        <td>Estado</td>
                        <td>Caracteristicas</td>
                        <td>Ambiente</td>
                        <td>Operaciones</td>
                    </tr>
                    <?php
                    require("../../Model/conexion.php");
                    //Buscar
                    // Verifica si se ha enviado una consulta de búsqueda
                    if (isset($_POST['search'])) {
                        $searchTerm = $_POST['search'];
                        // Prepara una consulta que busca el término ingresado en el número de equipo
                        $sentencia = $conexion->prepare("SELECT * FROM Equipo WHERE Nombre LIKE ?");
                        $searchTerm = "%$searchTerm%"; // Agrega comodines para buscar de manera parcial
                        $sentencia->bindParam(1, $searchTerm);
                    } else {
                        // Si no hay consulta de búsqueda, muestra todos los registros
                        $sentencia = $conexion->prepare("SELECT * FROM equipo");
                    }

                    // Formato de devolución
                    $sentencia->setFetchMode(PDO::FETCH_ASSOC);
                    $sentencia->execute();

                    // Recorre la sentencia y sus resultados
                    while ($fila = $sentencia->fetch()) {
                        echo ("<tr>");
                        echo ("<td>" . $fila['Codigo'] . "</td>");
                        echo ("<td>" . $fila['CodPatrimonial'] . "</td>");
                        echo ("<td>" . $fila['Nombre'] . "</td>");
                        echo ("<td>" . $fila['Marca'] . "</td>");
                        echo ("<td>" . $fila['Modelo'] . "</td>");
                        echo ("<td>" . $fila['NumSerie'] . "</td>");
                        echo ("<td>" . $fila['Estado'] . "</td>");
                        echo ("<td>" . $fila['Caracteristicas'] . "</td>");
                        echo ("<td>" . obtenerAmb($fila['CodigoAmbiente']) . "</td>");
                        echo ("<td>" . "<a href='ModificarEquipo.php?Codigo={$fila['Codigo']}' class='btn btn-danger'>Modificar</a>" . "</td>");
                        echo ("</tr>");
                    }

                    function obtenerAmb($Codigo)
                    {
                        require("../../Model/conexion.php");
                        $sql = "select Nombre from ambiente where Codigo = ?";
                        $registro = $conexion->prepare($sql);
                        $registro->execute([$Codigo]);
                        $ambientes = $registro->fetch(PDO::FETCH_ASSOC);
                        return $ambientes['Nombre'];
                    }

                    ?>
                </table>
            </main>
        </div>
    </div>
</body>

</html>