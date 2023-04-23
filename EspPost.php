<?php

include'conexion.php';

if ($con) {
    echo "Conexion con base de datos exitosa! ";
    
    if(isset($_POST['temperatura'])) {
        $temperatura = $_POST['temperatura'];
        echo "Estación meteorológica";
        echo " Temperaura : ".$temperatura;
    }
 
    if(isset($_POST['humedad'])) { 
        $humedad = $_POST['humedad'];
        echo " humedad : ".$humedad;

        
        $consulta = "INSERT INTO dht22(id, fecha, temperatura, humedad) VALUES (NULL, current_timestamp(),'$temperatura','$humedad')";
       // $consulta = "UPDATE DHT11 SET Temperatura='$temperatura',Humedad='$humedad' WHERE Id = 1";
        $resultado = mysqli_query($con, $consulta);
        if ($resultado){
            echo " Registo en base de datos OK! ";
        } else {
            echo " Falla! Registro BD";
        }
    }
    
    
} else {
    echo "Falla! conexion con Base de datos ";   
}


?>