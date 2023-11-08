<?php
session_start();
if (!empty($_POST['btnEnviar'])) {
    if (empty($_POST['usuario']) and empty($_POST['contraseña'])) {
        echo "Ingrese datos";
    } else {
        try {
            $usuario = $_POST['usuario'];
            $clave = $_POST['contraseña'];

            $sentencia = $conexion->prepare("select * from usuario where Nombre=? and Contraseña=? ");
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->execute([$usuario, $clave]);

            if ($fila = $sentencia->fetch()) {
                $Codigo = $fila['Codigo'];


                $sentencia2 = $conexion->prepare("select * from personalsoporte where CodigoUsuario =$Codigo");
                $sentencia2->setFetchMode(PDO::FETCH_ASSOC);
                $sentencia2->execute();

                if($fila2 = $sentencia2->fetch()){
                    $_SESSION['Codigo'] = $fila['Codigo'];
                    $_SESSION['CodigoUsuario'] = $fila2['CodigoUsuario'];
                    $_SESSION['Nombres'] = $fila2['Nombres'];
                    $_SESSION['Apellidos'] = $fila2['Apellidos'];
                }
                header("location:Administrador.php");
                      
            } else {
                echo "acceso denegado : Usuario incorrecto ";
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }
}
?>