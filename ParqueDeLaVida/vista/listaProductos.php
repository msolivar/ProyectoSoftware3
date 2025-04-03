<?php
//Hacemos la consulta a la base de datos para mostrar los productos
$qry = $conexion->query("SELECT * FROM boleto");

//    echo "<pre>";
//    print_r($productos);
//    echo "</pre>";
?>

<div class="colorClaro">
    <h4 >Carrito de compra:</h4>

    <table class="color centered">
        <tr bgcolor="#F1F1F1">
            <th width="3%">ID</th>
            <th width="7%">IMAGEN</th>
            <th width="20%">ENTRADA</th>
            <th width="7%">PRECIO</th>
            <th width="3%">CANTIDAD</th>
            <th width="7%">TOTAL A PAGAR</th>
            <!-- <th width="7%">TIPO PRODUCTO</th> -->
            <th width="3%">BORRAR</th>
        </tr>

        <div id="mensaje" style="color: red; font-weight: bold; margin-top: 10px;"></div>

        <?php
        $color = array("lightgrey", "lightblue");
        $contador = 0;
        $suma = 0;
        foreach ($productos as $k => $v) {
            $subto = $v['totalAPagar'];
            $suma = $suma + $subto;
            $contador++;

            $qry = $conexion->query("SELECT * FROM boleto WHERE id='" . $v['id'] . "'");
            $row = $qry->fetch_array();
        ?>

            <tr bgcolor="<?php echo $color[$contador % 2]; ?>">
                <td>
                    <?php //imagen codigo
                    $imagen = empty($row['imagenEvento']) ? "recursos/Productos.png" : $row['imagenEvento'];
                    $codigo = $v['id'];
                    echo $codigo ?>
                </td>
                <td>
                    <img src="<?= $imagen ?>" width="80px" height="80px" />
                </td>
                <td>
                    <?php //ponemos el título del producto con link a su detalle. 
                    ?>
                    <?php echo $v['entrada'] ?>
                </td>
                <td>
                    <?php //ponemos el precio del producto. 
                    ?>
                    <?=formatoMoneda($v['precio']) ?><br />
                </td>
                <td>
                    <input type="number" class="cantidadSolicitada" onkeypress="return soloNumeros(event)"
                        data-id="<?php echo $v['id']; ?>"
                        data-producto="<?php echo $v['entrada']; ?>"
                        data-precio="<?php echo $v['precio']; ?>"
                        data-total="<?php echo $v['totalAPagar']; ?>"
                        data-estado="<?= $estado; ?>"
                        value="<?php echo $v['cantidadSolicitada']; ?>"
                        placeholder="Cantidad" value="1" min="1" max="99"
                        style="background-color:white;">
                </td>
                <td id="totalAPagar">
                    <?php //ponemos el totalAPagar del producto. 
                    ?>
                    <?=formatoMoneda($v['totalAPagar']) ?><br />
                </td>
                <td>
                    <a href="<?= dirCar ?>borraCar.php?&id=<?= $v['id'] ?>&estado=<?= $estado; ?>">
                        <img src="recursos/btBorrar.png" alt="Borrar Pedido" width="50" height="50" />
                    </a>
                </td>
            </tr>

            <tr bgcolor="#F1F1F1">
            <?php } //fin foreach 
            ?>
            <td colspan="8">
                <p>
                    TOTAL A PAGAR: <?=formatoMoneda($suma) ?>
                </p>
            </td>
            </tr>
    </table>
</div>

<?php //Al final del archivo liberamos recursos
$conexion->close();
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

    $(document).ready(function() {
        $('.cantidadSolicitada').on('change', function() {
            var idPedido = $(this).data('id'); // Obtener el ID del pedido
            var entrada = $(this).data('producto');
            var cantidad = $(this).val(); // Obtener el valor ingresado
            var precio = $(this).data('precio');
            var totalAPagar = $(this).data('total');
            var estado = $(this).data('estado');
            // console.log(idPedido+", "+cantidad);

            //cargarPagina
            pagina = "";
            if (estado == "DeleteEnCarrito") {
                pagina = "vercarrito.php";
            } else if (estado == "DeleteEnPedido") {
                pagina = "pedido.php";
            } else {
                pagina = "error.php"
            }

            let regex = /^0[1-9]/;   

            // Validar cantidad antes de enviar
            if (cantidad === "" || isNaN(cantidad) || cantidad <= 0 || regex.test(cantidad)) {
                // $('#mensaje').text("La cantidad debe ser un número mayor a 0.").css('color', 'red');
                alert("Caracter Invalido");
                window.location = pagina;
                return;
            }

            // Realizar la solicitud AJAX
            $.ajax({
                url: '<?= dirCar ?>actualizarCantidadSolicitada.php', // Archivo PHP que procesa la actualización
                type: 'POST',
                data: {
                    idPedido: idPedido,
                    entrada: entrada,
                    cantidad: cantidad,
                    precio: precio,
                    totalAPagar: totalAPagar
                },
                success: function(response) {
                    $('#mensaje').html(response).css('color', 'green'); // Mostrar mensaje de éxito
                },
                error: function() {
                    $('#mensaje').text('Error al actualizar la cantidad solicitada.').css('color', 'red'); // Mostrar mensaje de error
                }
            });

            // window.location = pagina;
        });

    });
</script>