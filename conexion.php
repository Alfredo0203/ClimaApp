
<?php

function conectar (){
    $bd = mysqli_connect("127.0.0.1", "root", "root", "prueba");
  
    if (!$bd){
      echo "Fallo en la conexion a MySQL: " . mysqli_connect_error();
      }
      else {
        echo "La conexion a la base de datos fue exitosa";
    }

    return $bd;
}
?>
<?php

  

