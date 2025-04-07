<?php

require_once('path.php');
require_once(dirrecursos . 'funciones.php');
require_once(dirrecursos . 'accesibilidadweb.php');

session_start();
require_once('conexionbd.php');

// $tabla = "boleto";
// require_once(dirrecursos .'descripciondelatabla.php');  // Mostrar La Descripcion De La Tabla

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
  if (count($productos) > 0) {

    $cantidadProductos = count($productos);
  } else {

    $cantidadProductos = "";
  }
} else {

  $productos = false;
  $cantidadProductos = "";
}

//echo "<pre>";
//print_r($productos);
//echo "</pre>";

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
    AND DATEDIFF('".$fecha_original."', DATE(fechaIngreso)) > 0";

$qry = $conexion->query($consulta);

?>

<!DOCTYPE html>

<html lang="es">

<head>

  <?php
  require_once(dirvista . 'headerelementos.php');
  ?>
  <title>Parque de la Vida</title>

  <style>
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
      background-color: papayawhip;
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

    @media screen and (max-width: 1600px) {
      .header-container {
        display: flex;
        justify-content: center;
        /* Centrar horizontalmente */
        align-items: center;
        /* Centrar verticalmente */
        gap: 20px;
        /* Espaciado entre secciones */
      }

      @media screen and (max-width: 600px) {
        .header-container {
          display: block;
          justify-content: center;
          align-items: center;
          gap: 20px;
        }
      }
    }
  </style>

</head>

<body>

  <?php
  require_once(dirvista . 'bodyelementos.php');
  require_once(dirvista . 'navbarinicio.php');
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
      <div class="col s6 m6 l6">
        <h3 class="center-align">
          <b>BIENVENIDO<br>
            AL PARQUE DE LA VIDA</b>
        </h3>

        <p class="center-align"><b><?= $fecha_colombia ?></b></p>
      </div>

      <div class="col s6 m6 l6">
        <img src="recursos\eventos\koala.jpg" class="imagenes" alt="Koala">
        <br>
        <!-- <a href="entrada.php?&entrada=1" class="btn-entrada">Entradas Aquí</a> -->

        <?php
        if ($aforo == !0) {
        ?>

          <!-- Botón para abrir el modal -->
          <a class="waves-effect waves-light btn orange btnModal" href="login.php">
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
                <a class="waves-effect waves-light btn orange btnModal" href="login.php">
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

</body>

<?php
require_once(dirvista . 'piedepagina.php');
?>

</html>