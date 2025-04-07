<?php
require_once('path.php');
require_once(dirrecursos . 'funciones.php');
require_once(dirrecursos . 'accesibilidadweb.php');

session_start();
require_once('conexionbd.php');

// Si la sesión está vacía
if (!isset($_SESSION['admin'])) {
  header("location:index.php");
}

$usuario = $_SESSION['admin']['nombre'] . ' ' . $_SESSION['admin']['apellido'];
$correoUsuario = $_SESSION['admin']['email'];
$tipoUsuario = $_SESSION['admin']['tipoUsuario'];

// $tabla = "boleto";
// require_once(dirrecursos . 'descripciondelatabla.php');

// devuelve el codigo de cada sitio
$idAcodigo = isset($_GET['idActualizar']) ? $_GET['idActualizar'] : "";

$consulta = "SELECT * FROM boleto WHERE id='$idAcodigo' ";
$resultado = mysqli_query($conexion, $consulta);

$fila = mysqli_fetch_array($resultado);

//Consulta Normal
$consulta = "SELECT * FROM boleto ORDER BY fechaRegistroEvento DESC";
$resultado = mysqli_query($conexion, $consulta);

$contador = 0;

if (isset($_POST['btnGrabar'])) {
  $codigo = strip_tags($_POST['txtId']);
  $producto = strip_tags($_POST['txtProducto']);
  $precio = strip_tags($_POST['txtPrecio']);
  $cantidad = strip_tags($_POST['txCantidad']);
  $rutaAI = $_FILES['imagen']['tmp_name'];
  $nombreAI = ($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : "";
  $fechaInicial = strip_tags($_POST['fechaInicial']);
  $horaInicial = strip_tags($_POST['horaInicial']);
  $fechaFinal = strip_tags($_POST['fechaFinal']);
  $horaFinal = strip_tags($_POST['horaFinal']);

  if ($producto == "") {
    $error[] = "Ingrese el producto";
  } else if ($precio == "") {
    $error[] = "Ingrese el precio";
  } else if ($cantidad == "") {
    $error[] = "Ingrese la cantidad";
  } else if ($fechaInicial == "") {
    $error[] = "Ingrese la fecha inicial";
  } else if ($horaInicial == "") {
    $error[] = "Ingrese la hora inicial";
  } else if ($fechaFinal == "") {
    $error[] = "Ingrese la fecha inicial";
  } else if ($horaFinal == "") {
    $error[] = "Ingrese la hora final";
  } else {

    $destino = "";
    // Copiar las imagenes a la carpeta imagenes
    if ($nombreAI != "") {

      $destino = "recursos/eventos/" . $nombreAI;
      copy($rutaAI, $destino);
    }

    $fechaInicialC = $fechaInicial . " " . $horaInicial;
    $fechaFinalC = $fechaFinal . " " . $horaFinal;

    // id, evento, precio, disponibles, imagenEvento, fechaIngreso, fechaSalida, fechaRegistroEvento
    $sql = "INSERT INTO boleto values(NULL,'$producto','$precio',
    '$cantidad','$destino','$fechaInicialC', '$fechaFinalC', NOW())";
    // echo $sql;
    mysqli_query($conexion, $sql);

    echo '<script type="text/javascript">
        alert("Evento Registrado");     
        window.location="productos.php"
      </script>';
  }
}

if (isset($_POST['btnActualizar'])) {
  $codigo = strip_tags($_POST['txtId']);
  $producto = strip_tags($_POST['txtProducto']);
  $precio = strip_tags($_POST['txtPrecio']);
  $cantidad = strip_tags($_POST['txCantidad']);
  $dataImagen = strip_tags($_POST['dataImagen']);
  $rutaAI = $_FILES['imagen']['tmp_name'];
  $nombreAI = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : "";
  $fechaInicial = strip_tags($_POST['fechaInicial']);
  $horaInicial = strip_tags($_POST['horaInicial']);
  $fechaFinal = strip_tags($_POST['fechaFinal']);
  $horaFinal = strip_tags($_POST['horaFinal']);

  $destino = $dataImagen;

  if ($codigo == "") {
    $error[] = "Ingrese el codigo";
  } else if ($producto == "") {
    $error[] = "Ingrese el producto";
  } else if ($precio == "") {
    $error[] = "Ingrese el precio";
  } else if ($cantidad == "") {
    $error[] = "Ingrese la cantidad";
  } else if ($fechaInicial == "") {
    $error[] = "Ingrese la fecha inicial";
  } else if ($horaInicial == "") {
    $error[] = "Ingrese la hora inicial";
  } else if ($fechaFinal == "") {
    $error[] = "Ingrese la fecha inicial";
  } else if ($horaFinal == "") {
    $error[] = "Ingrese la hora final";
  } else {

    // Copiar las imagenes a la carpeta imagenes
    if ($nombreAI != "") {

      $destino = "recursos/eventos/" . $nombreAI;
      copy($rutaAI, $destino);
    }

    $fechaInicialC = $fechaInicial . " " . $horaInicial;
    $fechaFinalC = $fechaFinal . " " . $horaFinal;

    $sql = "UPDATE boleto SET 
    evento='$producto',
    precio='$precio',
    disponibles='$cantidad',
    imagenEvento='$destino',
    fechaIngreso='$fechaInicialC',
    fechaSalida='$fechaFinalC'
     WHERE id='$codigo'";
    // echo $sql;
    mysqli_query($conexion, $sql);

    echo '<script type="text/javascript">
        alert("Evento Actualizado");     
        window.location="productos.php"
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
  <title>Eventos</title>
</head>

<style>
  @media screen and (max-width: 1600px) {
    .ancholabel {
      margin-left: 0px; font-size:12pt;
    }

    .anchoinput {
      margin-bottom: 0px; margin-left: 46px; width: 400px;
    }

    @media screen and (max-width: 400px) {
      .ancholabel {
        margin-left: 60px; font-size:12pt;
      }

      .anchoinput {
        margin-bottom: 0px; margin-left: 46px; width: 200px;
      }
    }
  }
</style>

<body>

  <?php
  require_once(dirvista . 'bodyelementos.php');
  require_once(dirvista . 'navbaradmin.php');
  ?>

  <div class="container">
    <p class="margen">Administrador: <?= $correoUsuario ?></p>
    <h4 class="colorClaro">Inventario Eventos:</h4>

  </div>

  <div class="container" style="border: 1px solid black; background-color: #1f3a28; padding: 20px;
border-radius: 10px;">

    <h5 style="margin-top: 0px; background-color: rgba(144, 238, 144, 0.5); 
        padding: 5px; border-radius: 10px;">Eventos:</h5>

    <br>
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

      <div class="row">
        <!-- <div class="input-field col s8 m6 l6"> -->
        <!-- <i class="material-icons prefix">vpn_key</i> -->
        <input class="color" placeholder=" Ingrese el codigo" name="txtId" id="txtId" type="hidden" value="<?php if (isset($error)) {
                                                                                                              echo $codigo;
                                                                                                            }
                                                                                                            echo empty($fila['id']) ? "" : $fila['id']; ?>" data-length="10" readonly>
        <!-- <label class="titulo" style="font-size:12pt;" for="txtId">Codigo</label> -->
        <!-- </div> -->

        <div class="input-field col s8 m12 l12">
          <!-- <i class="material-icons prefix">shopping_basket</i> -->
          <input class="color" placeholder=" Ingrese el producto" name="txtProducto" id="txtProducto" value="<?php if (isset($error)) {
                                                                                                                echo $producto;
                                                                                                              }
                                                                                                              echo empty($fila['evento']) ? "" : $fila['evento']; ?>" onkeypress="return soloLetras(event)" type="text" data-length="25" required>
          <label class="titulo" style="font-size:12pt;" for="txtProducto">Producto</label>
        </div>

        <div class="col s8 m6 l6">
          <!-- <i class="material-icons prefix" style="position: fixed;top: 100px;left: 160px;">account_circle</i> -->
          <label class="titulo ancholabel" for="fechaInicial">Fecha Inicio Evento</label>
          <input class="color anchoinput" name="fechaInicial" value="<?php if (isset($error)) {
                                                                                                                        echo $fechaInicial;
                                                                                                                      }
                                                                                                                      echo empty($fila['fechaIngreso']) ? "" : date("Y-m-d", strtotime($fila['fechaIngreso'])); ?>" type="date" id="fechaInicial" required>
          <span class="character-counter" style="float: right; font-size: 12px; height: 1px;"></span>
        </div>
        <!-- date -->

        <div class="col s8 m6 l6">
          <label class="titulo ancholabel" for="horaInicial">Hora Inicial</label>
          <input class="color anchoinput" name="horaInicial" value="<?php if (isset($error)) {
                                                                                                                      echo $horaInicial;
                                                                                                                    }
                                                                                                                    echo empty($fila['fechaIngreso']) ? "" : date("H:i:s", strtotime($fila['fechaIngreso'])); ?>" type="time" id="horaInicial" step="1">
          <span class="character-counter" style="float: right; font-size: 12px; height: 1px;"></span>
        </div>

        <div class="col s8 m6 l6">
          <!-- <i class="material-icons prefix" style="position: fixed;top: 100px;left: 160px;">account_circle</i> -->
          <label class="titulo ancholabel" for="fechaFinal">Fecha Final Evento</label>
          <input class="color anchoinput" name="fechaFinal" value="<?php if (isset($error)) {
                                                                                                                      echo $fechaFinal;
                                                                                                                    }
                                                                                                                    echo empty($fila['fechaSalida']) ? "" : date("Y-m-d", strtotime($fila['fechaSalida'])); ?>" type="date" id="fechaFinal" required>
          <span class="character-counter" style="float: right; font-size: 12px; height: 1px;"></span>
        </div>

        <div class="col s8 m6 l6">
          <label class="titulo ancholabel" for="horaFinal">Hora Final</label>
          <input class="color anchoinput" name="horaFinal" value="<?php if (isset($error)) {
                                                                                                                    echo $horaFinal;
                                                                                                                  }
                                                                                                                  echo empty($fila['fechaSalida']) ? "" : date("H:i:s", strtotime($fila['fechaSalida'])); ?>" type="time" id="horaFinal" step="1">
          <span class="character-counter" style="float: right; font-size: 12px; height: 1px;"></span>
        </div>

        <div class="input-field col s8 m6 l6">
          <!-- <i class="material-icons prefix">attach_money</i> -->
          <input class="color" placeholder=" Ingrese la Precio" name="txtPrecio" id="txtPrecio" value="<?php if (isset($error)) {
                                                                                                          echo $precio;
                                                                                                        }
                                                                                                        echo empty($fila['precio']) ? "" : $fila['precio']; ?>" onkeypress="return soloNumeros1(event)" type="text" data-length="25" required>
          <label class="titulo" style="font-size:12pt;" for="txtPrecio">Precio</label>
        </div>

        <div class="input-field col s8 m6 l6">
          <!-- <i class="material-icons prefix">work</i> -->
          <input class="color" placeholder=" Ingrese la cantidad" name="txCantidad" id="txCantidad" value="<?php if (isset($error)) {
                                                                                                              echo $cantidad;
                                                                                                            }
                                                                                                            echo empty($fila['disponibles']) ? "" : $fila['disponibles']; ?>" onkeypress="return soloNumeros(event)" type="number" data-length="3" min="1" max="99" required>

          <label class="titulo" style="font-size:12pt;" for="txCantidad">Cantidad</label>
        </div>

        <div class="input-field col s8 m6 l6">
          <div class="file-field input-field">
            <div class="btn #1976d2 blue darken-2">
              <span>Adjuntar</span>
              <input type="file" name="imagen" id="imagen">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" placeholder=" Imagen jpg, png" style="color:black;background-color:white;">
            </div>
          </div>
          <label class="titulo" style="font-size:12pt;top: -10px;left: 40px;" for="imagen">Imagen</label>
        </div>

        <input class="color" placeholder=" Ingrese la cantidad" name="dataImagen" id="dataImagen" value="<?php if (isset($error)) {
                                                                                                            echo $cantidad;
                                                                                                          }
                                                                                                          echo empty($fila['imagen']) ? "" : $fila['imagen']; ?>" type="hidden" data-length="25" required>

        <div class="input-field col s12 m10 l8">

          <?php
          if ($idAcodigo == "") {
          ?>
            <button class="btn waves-effect waves-light indigo" type="submit" name="btnGrabar" style="margin-left: 20px;">Grabar
              <i class="material-icons right" style="color: white;">send</i>
            </button>
          <?php
          }
          ?>

          <?php
          if ($idAcodigo != "") {
          ?>
            <button class="btn waves-effect waves-light green" type="submit" name="btnActualizar" style="margin-left: 20px;">Actualizar
              <i class="material-icons right" style="color: white;">send</i>
            </button>
          <?php
          }
          ?>
          &nbsp; &nbsp;
          <a class="waves-effect waves-light btn red" href="productos.php" id="btnLimpiar"><i class="material-icons right" style="color: white;">send</i>Limpiar Formulario</a>
        </div>
      </div>
    </form>

    <div class="row">

      <div class="input-field col s12 m12 l12">
        <i class="material-icons prefix">search</i>
        <input class="validate color" placeholder=" Ingrese el campo que quiera consultar en la base de datos" name="txtBuscador" id="FiltrarContenido" type="text"
          style="border: 1px solid black;">
        <label class="titulo" style="font-size:12pt;" for="txtBuscador">Buscador</label>
      </div>

      <table class="centered">
        <thead>
          <tr bgcolor="#F1F1F1">
            <th>Id</th>
            <th>Boleto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <!-- <th>tipoProducto</th> -->
            <th>Imagen</th>
            <th>Actualizar</th>
            <th>Eliminar</th>

          </tr>
        </thead>

        <tbody class="BusquedaRapida">
          <?php

          $color = array("lightgrey", "lightblue");

          while ($fila = mysqli_fetch_array($resultado)) {
            $contador++;
            echo "<tr bgcolor=" . $color[$contador % 2] . ">";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['evento'] . "</td>";
            echo "<td>" . $fila['precio'] . "</td>";
            echo "<td>" . $fila['disponibles'] . "</td>";
            // echo "<td>" . $fila['tipoProducto'] . "</td>";
            $imagen = empty($fila['imagenEvento']) ?  dirrecursos . "Productos.png" : $fila['imagenEvento'];
            echo '<td class=espacio"><img class="materialboxed" data-caption="' . $fila['evento'] . '" width="80" height="70" src="' . $imagen . '"></td>';
            echo "<td><a class='btn-floating btn-small waves-effect waves-light green' title='Actualizar' href='productos.php?idActualizar=" . $fila['id'] . "'><i class='material-icons'>
                update</i></a></td>";

            echo "<td><a class='btn-floating btn-small waves-effect waves-light red' title='Eliminar' href='recursos/eliminarproducto.php?idEliminar=" . $fila['id'] . "'><i class='material-icons'>
                delete</i></a></td>";

            echo "</tr>";
          }
          ?>

        </tbody>
      </table>

      <!-- <a class="btn-floating btn-small waves-effect waves-light indigo" title="Insertar Usuario" href="index.html"><i class="material-icons">add</i></a> -->

    </div>
  </div>

</body>

<?php
include('vista/pieDePagina.php');
?>

</html>

<script>
  $(document).ready(function() {
    $('select').material_select();

    $('#btnLimpiar').click(function(e) {
      e.preventDefault(); // Prevenir el comportamiento por defecto del enlace

      // Limpiar todos los campos del formulario
      $('#formProducto')[0].reset();
    });
  });
</script>