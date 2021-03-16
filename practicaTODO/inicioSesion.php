<?php
if($_POST){
    session_start();
$usuario_login = $_POST['nombre'];
$contrasena_login = $_POST['contrasena'];
$errores = '';
include '../crud2/conexion.php';

$sql = 'SELECT * FROM registro WHERE usuario = ?';
$sentencia = $pdo->prepare($sql);
$sentencia->execute(array($usuario_login));
$resp = $sentencia->fetch();

if(!$resp){
    $errores .= 'No estas registrado'."<br>";
  
}else{
    $errores = '';
    if (password_verify($contrasena_login, $resp['contrasena'])) {
        $_SESSION['admin'] = $usuario_login;
        header('location:../crud2/index.php');
    
    } else {
        $errores .= 'La contraseña no es válida.'."<br>";
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
    <title>sesion</title>
</head>

<body>
    <h1 class="text-center text-info py-2 bg-dark">Iniciar Sesión</h1>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">

                <form class="p-4 border mt-4 bg-dark border border-info rounded" method="POST" action="inicioSesion.php">
                    <div class="form-group">
                        <label class="text-white" for="nombre">Ingrese su nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                    </div>

                    <div class="form-group">
                        <label class="text-white" for="contrasena">Ingrese su contraseña</label>
                        <input type="text" class="form-control" name="contrasena" id="contrasena">
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