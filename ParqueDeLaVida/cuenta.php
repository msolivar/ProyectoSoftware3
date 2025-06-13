<?php
require_once('path.php');
require_once(dirrecursos . 'funciones.php');
require_once(dirrecursos . 'accesibilidadweb.php');

session_start();
require_once('conexionbd.php');

// Si la sesión está vacía
if (!isset($_SESSION['usuario'])) {
  header("location:index.php");
}

$usuario = $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'];
$correoUsuario = $_SESSION['usuario']['email'];
$tipoUsuario = $_SESSION['usuario']['tipoUsuario'];

// $tabla = "usuario";
// require_once(dirrecursos . 'descripciondelatabla.php');

//Creamos la Sesion articulos que va almacenar los productos.
if (isset($_SESSION['articulos'])) {

  $productos = $_SESSION['articulos'];
  if (count($productos) > 0) {

    $cantidadProductos = count($productos);
  } else {

    $cantidadProductos = "";
  }
} else {

  $productos = false;
  $cantidadProductos = "";
}

$consulta = "SELECT * FROM usuario where email ='$correoUsuario'";
$resultado = mysqli_query($conexion, $consulta);

$fila = mysqli_fetch_array($resultado);

if (isset($_POST['btnActualizar'])) {
  $cedula = strip_tags($_POST['cedula']);
  $nombre = strip_tags($_POST['nombre']);
  $apellido = strip_tags($_POST['apellido']);
  $telefono = strip_tags($_POST['telefono']);
  $password = strip_tags($_POST['password']);

  if ($cedula === "") {
    $error[] = "Ingrese la cedula";
  } else if ($nombre === "") {
    $error[] = "Ingrese el nombre";
  } else if ($apellido === "") {
    $error[] = "Ingrese el apellido";
  } else if ($telefono === "") {
    $error[] = "Ingrese el telefono";
  } else if ($password === "") {
    $error[] = "Ingrese la contraseña";
  } else {

    $sql = "UPDATE usuario SET 
    cedula='$cedula',
    nombre='$nombre',
    apellido='$apellido',
    telefono='$telefono',
    password='$password'
     WHERE email='$correoUsuario'";
    // echo $sql;
    mysqli_query($conexion, $sql);

    echo '<script type="text/javascript">
        alert("Cuenta Actualizada");     
        window.location="cuenta.php"
      </script>';
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <?php
  require_once(dirvista . 'headerelementos.php');
  ?>
  <title>Cuenta</title>
</head>

<style>
  h5 {
    text-align: justify;
  }

  body {
    background-color: lavender;
  }

  input,
  input::-webkit-input-placeholder {
    color: #798081;
  }

  i.material-icons,
  label.blanco {
    color: black;
  }

  textarea,
  textarea::-webkit-input-placeholder {
    color: #798081;
  }
</style>

<body>
  <?php
  require_once(dirvista . 'bodyelementos.php');
  require_once(dirvista . 'navbarprincipal.php');
  ?>

  <br>

  <div class="container" style="border: 1px solid black; background-color: antiquewhite; padding: 20px;
border-radius: 10px;"> 
    <div class="row"> 

      <form class="formProducto col s12 m12 l12" id="formProducto" name="formProducto" method="POST" enctype="multipart/form-data">

        <?php
        if (isset($error)) {
          foreach ($error as $error) {
        ?>
            <script type="text/javascript">
              alert("<?php echo $error; ?>");
            </script>
        <?php
          }
        }
        ?>
        <br>

        <div class="input-field col s9 m11 l8">
          <i class="material-icons prefix">account_circle</i>
          <input type="text" name="cedula" value="<?php if (isset($error)) {
                                                    echo $cedula;
                                                  }
                                                  echo empty($fila['cedula']) ? "" : $fila['cedula']; ?>" required style="color:black;background-color:white;"
            onkeypress="return soloNumeros1(event)" placeholder=" Cedula" data-length="10">
          <label class="blanco" for="cedula" style="font-size:12pt;">Cedula</label>
        </div>
        <div class="input-field col s9 m11 l8">
          <i class="material-icons prefix">assignment_ind</i>
          <input type="text" name="nombre" value="<?php if (isset($error)) {
                                                    echo $nombre;
                                                  }
                                                  echo empty($fila['nombre']) ? "" : $fila['nombre']; ?>" required style="color:black;background-color:white;"
            onkeypress="return soloLetras(event)" placeholder=" Nombre" data-length="20">
          <label class="blanco" for="nombre" style="font-size:12pt;">Nombre</label>
        </div>
        <div class="input-field col s9 m11 l8">
          <i class="material-icons prefix">assignment_ind</i>
          <input type="text" name="apellido" value="<?php if (isset($error)) {
                                                      echo $apellido;
                                                    }
                                                    echo empty($fila['apellido']) ? "" : $fila['apellido']; ?>" required style="color:black;background-color:white;"
            onkeypress="return soloLetras(event)" placeholder=" Apellido" data-length="20">
          <label class="blanco" for="apellido" style="font-size:12pt;">Apellido</label>
        </div>
        <div class="input-field col s9 m11 l8">
          <i class="material-icons prefix">local_phone</i>
          <input type="text" name="telefono" value="<?php if (isset($error)) {
                                                      echo $telefono;
                                                    }
                                                    echo empty($fila['telefono']) ? "" : $fila['telefono']; ?>" required style="color:black;background-color:white;"
            onkeypress="return soloNumeros1(event)" placeholder=" Telefono" data-length="10">
          <label class="blanco" for="telefono" style="font-size:12pt;">Telefono</label>
        </div>
        <div class="input-field col s4.1 m8 l8">
          <i class="material-icons prefix">vpn_key</i>
          <input type="password" id="password" name="password" value="<?php if (isset($error)) {
                                                                        echo $password;
                                                                      }
                                                                      echo empty($fila['password']) ? "" : $fila['password']; ?>" required placeholder=" Contraseña" style="color:black;background-color:white;" data-length="15">
          <label class="blanco" for="password" style="font-size:12pt;">Contraseña</label>
        </div>

        <div class="input-field col s4 m4 l3">
          <p>
            <input name="VerPassword" id="VerPassword" type="checkbox">
            <label class="blanco" for="VerPassword">Ver contraseña</label>
          </p>
        </div>

        <div class="input-field col s9 m11 l8">

          <button class="btn waves-effect waves-light green" type="submit" name="btnActualizar" style="margin-left: 20px;">Actualizar
            <i class="material-icons right" style="color: white;">send</i>
          </button>
        </div>

      </form>

    </div>
  </div>

</body>

</html>