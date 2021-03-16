<?php
//ELIMINAR DATO
include_once 'conexion.php';

$idEliminar = $_GET['id'];

$consultaEliminar = 'DELETE FROM colors WHERE id = ?';
$sentenciaEliminar = $pdo->prepare($consultaEliminar);
$sentenciaEliminar->execute(array($idEliminar));
header('location:index.php');
?>

