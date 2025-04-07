<!-- ---------BARRA DE MENU---------------->
<nav class="#d50000 red accent-4">

  <div class="nav-wrapper container">

    <a href="index.php" class="brand-logo">Ecoparque</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse">
      <i class="material-icons" style="color: white;">menu</i></a>

    <!-- Vista Normal -->
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <!-- <li><a href="pedido.php">Pedido</a></li> -->
      <!-- <li style="font-size: 18px;">
        <a class="btn-floating indigo" href="vercarrito.php" title="Compras">
          <i class="material-icons" style="color:white;">shopping_basket</i>
        </a><?= $cantidadProductos ?>
      </li> -->
      <!-- <li><a href="verpedido.php">Entradas</a></li> -->
      <li><a href="login.php">Iniciar Sesion</a></li>
      <li><a href="registrarcliente.php">Registrarse</a></li>
      <!-- <li><a class="dropdown-button" href="#!" data-activates="dropdownO">Opciones<i class="material-icons right" style="color:white;">arrow_drop_down</i></a></li> -->
    </ul>

    <!-- Vista Celular -->
    <ul class="side-nav" id="mobile-demo">
      <li><a href="index.php">Ecoparque</a></li>
      <!-- <li><a href="vercarrito.php">Compras <?= $cantidadProductos ?></a></li> -->
      <!-- <li><a href="pedido.php">Pedido</a></li> -->
      <!-- <li><a href="verpedido.php">Entradas</a></li> -->
      <li><a href="login.php">Iniciar Sesion</a></li>
      <li><a href="registrarcliente.php">Registrarse</a></li>
      <!-- <li><a class="dropdown-button" href="#!" data-activates="dropdownO1">Opciones<i class="material-icons right">arrow_drop_down</i></a></li> -->
    </ul>

  </div>

</nav>

<!-- Vista Normal -->
<ul id="dropdownO" class="dropdown-content">
  <li><a href="cuentaAdministrador.php">Cuenta</a></li>
  <li><a href="<?= dirsesion ?>cerrarsession.php?logout=<?= $tipoUsuario ?>">Salir</a></li>
</ul>

<!-- Vista Celular -->
<ul id="dropdownO1" class="dropdown-content">
  <li><a href="cuentaAdministrador.php">Cuenta</a></li>
  <li><a href="<?= dirsesion ?>cerrarsession.php?logout=<?= $tipoUsuario ?>">Salir</a></li>
</ul>

<script>
  $(document).ready(function() {

    $(".button-collapse").sideNav();

  });
</script>