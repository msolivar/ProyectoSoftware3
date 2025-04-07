<!-- ---------BARRA DE MENU---------------->

<nav class="#d50000 red accent-4">

  <div class="nav-wrapper container">

    <a href="index.php" class="brand-logo">Ecoparque</a>

    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons" style="color: white;">menu</i></a>

    <ul id="nav-mobile" class="right hide-on-med-and-down">

      <!-- <li><a href="pedido.php">Pedido</a></li> -->

      <li style="font-size: 18px;">

        <a class="btn-floating indigo" href="vercarrito.php" title="Compras">

          <i class="material-icons" style="color:white;">shopping_basket</i>

        </a><?= $cantidadProductos ?>

      </li>

      <li><a href="verpedido.php">Entradas</a></li>

      <li><a href="login.php">Iniciar Sesion</a></li>

      <!-- <li><a href="recursos/generarcodigo.php">Generar Codigo</a></li> -->

      <!-- <li><a href="recursos/qrtoken.php">Qr token</a></li> -->

      <!-- <li><a class="btn-floating indigo" href="administrador.php" title="Administrador"><i class="material-icons" style="color:white;">account_circle</i></a></li> -->

    </ul>

    <ul class="side-nav" id="mobile-demo">

      <li><a href="index.php">Ecoparque</a></li>

      <li><a href="vercarrito.php">Compras <?= $cantidadProductos ?></a></li>

      <!-- <li><a href="pedido.php">Pedido</a></li> -->

      <li><a href="verpedido.php">Entradas</a></li>

      <li><a href="login.php">Iniciar Sesion</a></li>

      <!-- <li><a href="usuario.php">Iniciar Sesion</a></li> -->

      <!-- <li><a href="registro.php">Registrarse</a></li> -->

      <!-- <li><a href="administrador.php">Administrador</a></li> -->

    </ul>

  </div>

</nav>



<script>

  $(document).ready(function() {

    $(".button-collapse").sideNav();

  });

</script>