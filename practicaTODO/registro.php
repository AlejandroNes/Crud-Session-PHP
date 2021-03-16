<?php
if($_POST){
    session_start();
    $nuevo_usuario = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];
    $contrasena2 = $_POST['contrasena2'];
    $errores = '';
    
include '../crud2/conexion.php';

$sql = 'SELECT * FROM registro WHERE usuario = ?';
$sentencia = $pdo->prepare($sql);
$sentencia->execute(array($nuevo_usuario));
$resp = $sentencia->fetch();

if ($resp) {
    // header('location:index.php');
   $errores .= 'Ya existe ese nombre <br>';
}else{
    $contrasena =  password_hash($contrasena, PASSWORD_DEFAULT);
    // Ver el ejemplo de password_hash() para ver de dónde viene este hash.
    $errores = '';
    
    if (password_verify($contrasena2, $contrasena)) {
    
        $consultaInsertar = 'INSERT INTO registro (usuario,contrasena) VALUES (?,?)';
        $sentencia_insertar = $pdo->prepare($consultaInsertar);
        $sentencia_insertar->execute(array($nuevo_usuario, $contrasena));
        $errores = '';
        header('location:index.php');

    } else {
        $errores .= "Ingrese constraseñas iguales <br>";
    }
}
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Registro</title>
</head>

<body>
    <h1 class="text-center text-info py-2 bg-dark">Registro de Usuario</h1>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">

                <form class="p-4 border mt-4 bg-dark rounded" method="POST" action="registro.php">
                    <div class="form-group">
                        <label class="text-white" for="nombre">Ingrese su nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                    </div>

                    <div class="form-group">
                        <label class="text-white" for="contrasena">Ingrese una contraseña</label>
                        <input type="text" class="form-control" name="contrasena" id="contrasena">
                    </div>

                    <div class="form-group">
                        <label class="text-white" for="contrasena2">Vuelva a escribir su contraseña</label>
                        <input type="text" class="form-control" name="contrasena2" id="contrasena2">
                    </div>

                    <div class="d-flex justify-content-around">
                        <a href="index.php" class="btn btn-outline-warning">VOLVER</a>
                        <input type="submit" class="btn btn-outline-primary" value="Aceptar">
                    </div>
                </form>
                <?php if($_POST):?>
                <?php if(!empty($errores)):?>
             
                <div class="alert alert-danger mt-3">
                    <p><?php echo $errores; ?></p>
                </div>
        
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>