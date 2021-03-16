<?php
//EDITAR
if($_POST){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    include_once 'conexion.php';
    $consultaEditar = 'UPDATE colors SET nombre=?, descripcion=? WHERE id=? ';
    $sentenciaEditar = $pdo->prepare($consultaEditar);
    $sentenciaEditar->execute(array($nombre,$descripcion,$id));
    header('location:index.php');
} 
?>