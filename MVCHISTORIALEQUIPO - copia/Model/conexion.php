<?php
    $hostname = "localhost";
    $user = "root";
    $base = "bd_historialequipo";
    $port = "3307";
    $password = "martin";
   
    try {
        // Intentar establecer la conexión
        $conexion = new PDO("mysql:host=$hostname; port=$port; dbname=$base", $user, $password);
       
        // Configurar el modo de error para que lance excepciones en caso de error
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

    } catch (PDOException $e) {

        echo "Error de conexión: " . $e->getMessage();
    }
?>
