<?php
//conexion a base de datos
$dataBase = 'mysql:host=127.0.0.1:3308 ; dbname=colores2';
$user = 'root';
$password = '';

try {
    //code...
    $pdo = new PDO($dataBase,$user,$password);

}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
