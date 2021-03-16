

<?php
session_start();

if (!isset($_SESSION['admin'])) {
  header('location:../practicaTODO/index.php');
  die();
}
include_once 'conexion.php';

//MOSTRAR DATOS
$consultaVer = 'SELECT * FROM colors';
$sentencia_ver = $pdo->prepare($consultaVer);
$sentencia_ver->execute();
$respuesta = $sentencia_ver->fetchAll();

//INSERTAR
if($_POST){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $consultaInsertar = 'INSERT INTO colors (nombre,descripcion) VALUES (?,?)';
    $sentencia_insertar = $pdo->prepare($consultaInsertar);
    $sentencia_insertar->execute(array($nombre,$descripcion));
    header('location:index.php');
}
//EDITAR
    if($_GET){
        $id_unico = $_GET['id'];
        $consultaVer_unico = 'SELECT * FROM colors WHERE id = ?';
        $sentencia_ver_unico = $pdo->prepare($consultaVer_unico);
        $sentencia_ver_unico->execute(array($id_unico));
        $respuesta_unico = $sentencia_ver_unico->fetch();
    }

?>

<!-- INDEX -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Colores2</title>
</head>
<style>
body{
    background-color: #34495e;
}
h2{
    background-color: #2c3e50;
}
form{
    background-color: 2c3e50;
}
</style>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <a class="navbar-brand" href="#">Bienvenido: <?php echo $_SESSION['admin'] ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav text-center">
      <li class="nav-item">
        <a class="nav-link" href="../practicaTODO/index.php">Volver</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../practicaTODO/cerrar.php">Cerrar Sesion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../practicaTODO/inicioSesion.php">Iniciar Sesion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../practicaTODO/registro.php" tabindex="-1">Registrarse</a>
      </li>
    </ul>
  </div>
  </nav>
    <h2 class="text-center text-info py-3">CRUD <span class="text-warning">COLORES</span> <span class="text-success">BOOTSTRAP</span></h2>
    <div class="container mt-4">
        <div class="row">
            <!-- mostrar los colores -->
            <div class="col-6">
                <?php foreach($respuesta as $item): ?>
                <div class="alert alert-<?php echo $item['nombre']; ?>">
                    <strong><?php echo $item['nombre']; ?></strong> - <?php echo $item['descripcion']; ?>
                    
                    <a class="btn btn-warning btn-sm float-right mx-1" 
                    href="index.php?id=<?php echo $item['id'] ?>">?</a>

                    <a class="btn btn-danger btn-sm float-right mx-1" 
                    href="eliminar.php?id=<?php echo $item['id'] ?>">x</a>

                </div>      
                <?php endforeach; ?>
            </div>
            <!-- mostrar el formulario -->
            <div class="col-6">
            <?php if(!$_GET): ?>
            <form method="POST" class="p-3 border rounded-lg">
                    <h4 class="text-center text-white">Agregar Elemento</h4>
                    <input type="text" class="form-control my-2 " name="nombre" placeholder="ingrese nombre">
                    <input type="text" class="form-control my-2 " name="descripcion" placeholder="ingrese descripcion">
                    <button class="btn btn-info my-2 btn-block">AGREGAR</button>
            </form>
            <?php endif; ?>

            <?php if($_GET): ?>
            <form class="p-3 border rounded-lg" method="POST"  action="editar.php">
                    <h4 class="text-center text-warning">Editar Elemento</h4>
                    <input value="<?php echo $respuesta_unico['nombre']; ?>" type="text" class="form-control my-2 " name="nombre" placeholder="ingrese nombre">
                    <input value="<?php echo $respuesta_unico['descripcion']; ?>" type="text" class="form-control my-2 " name="descripcion" placeholder="ingrese descripcion">
                    <input value="<?php echo $respuesta_unico['id']; ?>" type="hidden" name="id">
                    <button class="btn btn-warning my-2 btn-block">AGREGAR</button>
            </form>
            <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>