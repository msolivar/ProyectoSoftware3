<?php
require_once('path.php');
require_once(dirRecursos.'funciones.php');

session_start();
require_once('conexion.php');

// $tabla = "boleto";
// require_once('descripcionDeLaTabla.php');  // Mostrar La Descripcion De La Tabla

// Monto Total Venta En Caja Sin Pagar
// $qry = $conexion->query("SELECT SUM(precio*disponibles) AS totalVentas FROM boleto");
// $row = $qry->fetch_array();
// $totalVentas = $row['totalVentas'];

//Calcular Las Transaciones de las facturas
// $consulta = "SELECT factura_id, SUM(precio * cantidad) AS total_boletos FROM transaccion GROUP BY factura_id ORDER BY factura_id DESC";

// echo '<p class="colorClaro"> total Ventas En Caja: '.formatoMoneda($totalVentas).' </p>';

//Creamos la Sesion articulos que va almacenar los productos.

if (isset($_SESSION['articulos'])) {
  $productos = $_SESSION['articulos'];
  if(count($productos)>0){
    $cantidadProductos = count($productos);
  } else{
    $cantidadProductos = "";
  }
  
} else {
  $productos = false;
  $cantidadProductos = "";
}

// echo "<pre>";
// print_r($productos);
// echo "</pre>";

$consulta = "
    SELECT *, 
    CONCAT(
        CASE DAYOFWEEK(fechaIngreso)
            WHEN 1 THEN 'Domingo'
            WHEN 2 THEN 'Lunes'
            WHEN 3 THEN 'Martes'
            WHEN 4 THEN 'Miércoles'
            WHEN 5 THEN 'Jueves'
            WHEN 6 THEN 'Viernes'
            WHEN 7 THEN 'Sábado'
        END, ' ',
        DATE_FORMAT(fechaIngreso, '%e de %M')
    ) AS fechaEvento,
    DATE_FORMAT(fechaIngreso, '%l:%i %p') AS horaIngresoEvento
    FROM boleto 
    WHERE id > 1
    ";
$qry = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Parque de la Vida</title>
  <!--etiqueta para codificar el idioma-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- etiqueta para controlar el zoom en dispositovs moviles -->
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0">
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <!-- css diseño de la pagina -->
  <link type="text/css" href="css/estilos.css" rel="stylesheet" type="text/css" media="screen" />
  <style>
    .header-container {
      display: flex;
      justify-content: center;
      /* Centrar horizontalmente */
      align-items: center;
      /* Centrar verticalmente */
      gap: 20px;
      /* Espaciado entre secciones */
    }

    .col {
      text-align: center;
      /* Centrar texto dentro de cada columna */
    }

    .event-card {
      background: rgba(255, 255, 255, .2);
      color: black;
      border-radius: 10px;
      padding: 10px;
      text-align: center;
    }

    .btn-entrada {
      background-color: #c0a676;
      color: white;
      font-weight: bold;
      display: inline-block;
      margin-top: 10px;
      padding: 10px 20px;
      border-radius: 20px;
      text-decoration: none;
      width: fit-content;

    }

    .btn-comprar {
      background-color: #c4a460;
      color: white;
      padding: 10px;
      border-radius: 20px;
      text-decoration: none;
      /* display: block; */
      text-align: center;
    }

    .header-container img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }

    /* Establecer mismo tamaño en las tarjetas */
    .row {
      display: flex;
      flex-wrap: wrap;
      align-items: stretch;
    }

    .card {
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .card-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      min-height: 150px;
      /* Ajusta según sea necesario */
    }

    h3 {
      text-align: center;
    }

    img.imagenes {
      width: 170px;
      /* Ancho */
      height: 100px;
      /* Alto */
    }

    .centrar {
      display: flex;
      justify-content: center;
      /* Centra horizontalmente */

    }
  </style>
</head>

<body class="black-text">

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!-- js para mostrar la contraseña -->
  <script type="text/javascript" src="js/mostrarcontraseña.js"></script>

  <?php
  require_once(dirVista.'NavBarPrincipal.php');
  ?>

  <?php
  $consulta = "SELECT * FROM `boleto` WHERE id=1";
  $qry1 = $conexion->query($consulta);
  $row = $qry1->fetch_array(MYSQLI_BOTH); // Obtiene la primera fila de resultados como un array asociativo

  $evento = empty($row['evento']) ? "Null" : $row['evento'];
  $precio = empty($row['precio']) ? "Null" : $row['precio'];
  $aforo = empty($row['disponibles']) ? 0 : $row['disponibles'];
  ?>

  <br>

  <div class="container">
    <div class="header-container">
      <div class="col s12 m6 l6">
        <h3 class="center-align">
          <b>BIENVENIDO<br>
            AL PARQUE DE LA VIDA</b>
        </h3>
        <p class="center-align"><b><?= $fecha_colombia ?></b></p>
      </div>
      <div class="col s12 m6 l6">
        <img src="recursos\eventos\koala.jpg" class="imagenes" alt="Koala">
        <br>
        <!-- <a href="entrada.php?&entrada=1" class="btn-entrada">Entradas Aquí</a> -->

        <?php
        if ($aforo == !0) {
        ?>
          <!-- Botón para abrir el modal -->
          <a class="waves-effect waves-light btn orange btnModal" href="#modalPago"
            data-entrada="<?= $evento ?>"
            data-precio="<?= $precio ?>">
            Comprar Entrada
          </a>

        <?php
        }
        ?>

      </div>
    </div>
    <p class="center-align" style="font-size: 24px;">Descubre un oasis natural donde la fauna y la flora se encuentran en armonía.<br>
      Explora senderos mágicos y conoce especies fascinantes.</p>
  </div>

  <div class="container #eeeeee grey lighten-3">
    <h4 class="center-align">EVENTOS</h4>
    <div class="row">
      <?php
      while ($row = $qry->fetch_array(MYSQLI_ASSOC)) {
        $evento = empty($row['evento']) ? "Null" : $row['evento'];
        $imagenEvento = empty($row['imagenEvento']) ? "Null" : $row['imagenEvento'];
        $fechaEvento = empty($row['fechaEvento']) ? "Null" : $row['fechaEvento'];
        $horaIngresoEvento = empty($row['horaIngresoEvento']) ? "Null" : $row['horaIngresoEvento'];
        $entrada = empty($row['id']) ? "Null" : $row['id'];
        $precio = empty($row['precio']) ? "Null" : $row['precio'];
        $aforo = empty($row['disponibles']) ? 0 : $row['disponibles'];
      ?>
        <?php
        if ($aforo == !0) {
        ?>
          <div class="col s6 m4 l3">
            <div class="card">
              <div class="card-image">
                <img src="<?= $imagenEvento ?>" alt="<?= $evento ?>">
              </div>
              <div class="card-content">
                <span class="card-title"><?= $evento ?></span>
                <p><b>Fecha Ingreso:</b> <?= $fechaEvento ?></p>
                <p><b>Hora Entrada:</b> <?= $horaIngresoEvento ?></p>

                <!-- Botón para abrir el modal -->
                <a class="waves-effect waves-light btn orange btnModal" href="#modalPago"
                  data-entrada="<?= $evento ?>"
                  data-precio="<?= $precio ?>">
                  Comprar Entrada
                </a>
              </div>
            </div>
          </div>
      <?php
        }
      } //Fin del while

      //Al final del archivo liberamos recursos
      $conexion->close();
      ?>
    </div>
  </div>

  <!-- Modal Structure -->
  <div id="modalPago" class="modal">
    <!-- Botón para cerrar -->
    <div class="modal-footer">
      <a href="#!" id="btnCerrarModal" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>

    <div class="modal-content">
      <h4>Detalles de la Compra</h4>

      <form action="<?=dirCar?>agregacar.php" method="post">
        <div class="table-responsive mt-4">
          <table class="table text-black"> <!-- Cambié text-white a text-black para visibilidad -->
            <thead>
              <tr>
                <th>Entrada</th>
                <th>Precio unitario</th>
                <th>Cantidad</th>
                <th>Total a pagar</th>
              </tr>
            </thead>

            <?php
            $color = array("lightgrey", "lightblue");
            ?>

            <tbody>
              <tr bgcolor="<?= $color[1] ?>">
                <td>
                  <input readonly type="text" name="detalleEntrada" id="detalleEntrada" class="form-control"
                    placeholder="Entrada" required>
                </td>
                <td>
                  <input readonly type="text" name="precioEntrada" id="precioEntrada" class="form-control"
                    placeholder="Precio Entrada" required>
                </td>
                <td>
                  <input type="number" class="color" name="cantidad" id="cantidad" onkeypress="return soloNumeros(event)"
                    placeholder="Cantidad" value="1" min="1" max="99" required>
                </td>
                <td>
                  <input readonly type="text" id="totalPagar" name="totalPagar" class="form-control"
                    placeholder="Total a Pagar" required>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="right-align">
          <button type="submit" class="btn waves-effect waves-light indigo" style="width: 300px;">
            <i class="material-icons" style="color:white;">shopping_cart</i>
            RESERVAR EVENTO</button>
        </div>
      </form>
    </div>
  </div>

</body>

<?php
require_once(dirVista.'pieDePagina.php');
?>

<script>
  //Ingresar soloNumeros
  function soloNumeros(event) {
    let tecla = event.key;
    let input = event.target;

    // Permite solo números (0-9)
    if (!/^[0-9]$/.test(tecla)) {
      return false; // Bloquea si no es número
    }

    // Verifica que el input no tenga más de 2 caracteres
    if (input.value.length >= 2) {
      return false; // Bloquea si ya tiene 2 caracteres
    }

    return true; // Permite la entrada válida
  }

  // Inicializar elementos de Materialize si es necesario
  document.addEventListener('DOMContentLoaded', function() {

    var elems = document.querySelectorAll('.modal');
    // var instances = M.Modal.init(elems, options); 

    // Capturar todos los botones con la clase btnModal y agregarles eventos
    const botonesModal = document.querySelectorAll('.btnModal');

    //Asignar Valores Estaticos al modal
    botonesModal.forEach(function(boton) {
      boton.addEventListener('click', function() {

        // Obtener valores dinámicos del atributo data-*
        const entrada = boton.getAttribute('data-entrada');
        const precio = boton.getAttribute('data-precio');

        document.getElementById('detalleEntrada').value = `${entrada}`;
        document.getElementById('precioEntrada').value = `${precio}`;
        document.getElementById('totalPagar').value = `$ ${precio}`;
      });
    });

    //Reiniciar Cantidad si da click en el boton CerrarModal
    var cantidadInput = document.getElementById('cantidad');

    document.getElementById('btnCerrarModal').addEventListener('click', function() {
      cantidadInput.value = 1; // Reiniciar cantidad
    });

    // Observar cambios en los atributos del modal
    var modal = document.getElementById('modalPago');

    var observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.attributeName === "style") {
          var displayValue = window.getComputedStyle(modal).display;
          if (displayValue === "none") {
            cantidadInput.value = 1; // Reinicia la cantidad a 1
            // document.getElementById('totalPagar').value = ''; // Limpia el total a pagar
          }
        }
      });
    });

    // Iniciar la observación de cambios en los atributos del modal
    observer.observe(modal, {
      attributes: true
    });
  });

  // Or with jQuery
  $(document).ready(function() {
    $('.modal').modal();

    $('#cantidad').on('input', function() {
      let cantidadStr = document.getElementById('cantidad').value;

      // Eliminar ceros iniciales si hay más de un dígito
      if (/^0[0-9]+/.test(cantidadStr)) {
        cantidadStr = cantidadStr.replace(/^0+/, ''); // Quita ceros iniciales
        document.getElementById('cantidad').value = cantidadStr || 1; // Si queda vacío, pone 1
      }

      let cantidad = parseInt(cantidadStr) || 0; // Convertir a número entero
      let precio = parseFloat(document.getElementById('precioEntrada').value) || 0;

      // Si la cantidad es 0 o menor, corregir a 1
      if (cantidad <= 0) {
        cantidad = 1;
      }

      // Calcular el total
      let total = cantidad * precio;
      document.getElementById('totalPagar').value = "$ "+total;
    });
  });
</script>

</html>