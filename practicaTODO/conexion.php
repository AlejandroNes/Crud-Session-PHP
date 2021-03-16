<?php
try {
    $database = 'mysql:host=127.0.0.1:3308 ; dbname=colores2';
    $user = 'root';
    $password = '';
    $pdo = new PDO($database,$user,$password);
    echo 'conectado';
    $mbd = null;
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
