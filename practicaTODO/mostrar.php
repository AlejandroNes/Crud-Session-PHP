<?php
session_start();

if (isset($_SESSION['admin'])) {
    echo "Bienvenido: ".$_SESSION['admin']."<br>";
    echo '<a href="../crud2/index.php">Ir a la APP</a></br>';
    echo '<a href="cerrar.php">cerrar sesion</a></br>';
    echo '<a href="registro.php">volver registro</a></br>';
  
}else{
    header('location:index.php');
}
