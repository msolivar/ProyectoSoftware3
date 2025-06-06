<div class="container colorClaro">

    <h4>Pedidos</h4>

    <!-- <h5>Consultar Pedido</h5> -->
    <br>

    <div class="input-field col s12 m12 l12">

        <i class="material-icons prefix">search</i>
        <input class="validate color" placeholder=" Ingrese el campo que quiera consultar en la base de datos" name="txtBuscador" id="FiltrarContenido" type="text"
            style="border: 1px solid black;">

        <label class="titulo" style="font-size:12pt;" for="txtBuscador">Buscador</label>

    </div>

    <table class="color centered">

        <thead bgcolor="#F1F1F1">

            <tr>

                <!-- <th width="3%">ID</th>
                <th width="4%">FECHA</th> -->
                <th width="10%">CLIENTE</th>
                <!-- <th width="7%">TIPO DE PAGO</th> -->
                <th width="20%">ENTRADA</th>
                <!-- <th width="7%">TOTALAPAGAR</th> -->
                <th width="7%">PEDIDO</th>
                <th width="7%">PDF</th>

            </tr>

        </thead>

        <tbody class="BusquedaRapida">

            <?php

            $color = array("lightgrey", "lightblue");
            $contador = 0;
            $suma = 0;

            while ($row = $qry->fetch_array()) {
                $codigo = $row['f.id'];
                $email = $row['email'];
                $fecha_actual = new DateTime($row['fechaRegistroUsuario']);

                $subto = $row['totalAPagar'];
                $suma = $suma + $subto;
                $contador++;
            ?>

                <tr bgcolor="<?php echo $color[$contador % 2]; ?>">

                    <!-- <td>

                    echo $codigo 

                </td> -->

                    <!-- <td>
                    
                    echo date_format($fecha_actual, "d/m/Y"); 

                </td> -->

                    <td>

                        <?php //ponemos el cliente. 
                        ?>

                        <?php echo $row['cedula'] ?>

                        <br>

                        <?php echo $row['nombre'] ?>

                        <br>

                        <?php echo $row['telefono'] ?>

                    </td>

                    <!-- <td>

                    <?php //ponemos el tipo de pago. 
                    ?>

                    <?php echo $row['tipoDePago'] ?>

                </td> -->

                    <td>

                        <?php //ponemos los productos. 
                        ?>

                        <?php

                        $productos = json_decode($row['productos'], TRUE);

                        foreach ($productos as $k => $v) {

                            $detalleProducto = '';

                            $caracteristicas = 'Id: ' . $v['id'] . ' ' . $v['entrada'] . '</br> ' . $v['cantidadSolicitada'] . ' X ' . formatoMoneda1($v['precio']) . ' = ' . formatoMoneda1($v['totalAPagar']) . '</br>';

                            if ($contador <= count($productos) - 1) {

                                $detalleProducto = $caracteristicas . '</br>';
                            } else {

                                $detalleProducto = $caracteristicas;
                            }

                            echo $detalleProducto;
                        }

                        ?>

                    </td>

                    <!-- <td>

                    <?php //ponemos el total a pagar. 
                    ?>

                    <?= formatoMoneda($row['totalAPagar']) ?>

                </td> -->

                    <td>

                        <?php //ponemos el estado del pedido. 
                        ?>

                        <?php

                        $background = ""; // Inicializa la variable



                        if ($row['estadoPago'] == "Pendiente") {

                            $background = 'background: rgba(255, 0, 0, 0.5); width: 200px;';
                        } elseif ($row['estadoPago'] == "Enviado") {

                            $background = 'background: rgba(255, 255, 0, 0.5); width: 200px;';
                        } elseif ($row['estadoPago'] == "Pagado") {

                            $background = 'background: rgba(0, 255, 0, 0.5); width: 200px;';
                        }

                        // Luego puedes usar la variable $background en tu HTML

                        ?>



                        <form action="estadoPedidoForm">

                            <div class="input-field col s7 m6 l6" style="<?php echo $background; ?>">

                                <input type="hidden" id="idPedido" name="idPedido" value="<?php echo $row['f.id']; ?>"> <!-- Input con el valor del ID del pedido -->

                                <select class="estadoPedido" data-id="<?php echo $row['f.id']; ?>" name="estadoPedido">

                                    <option value="" disabled selected>Tipo de pedido</option>

                                    <option value="Pendiente" <?php if ($row['estadoPago'] == "Pendiente") { ?> selected <?php } ?>>Pendiente</option>

                                    <option value="Pagado" <?php if ($row['estadoPago'] == "Pagado") { ?> selected <?php } ?>>Pagado</option>

                                </select>

                                <!-- <input type="hidden" id="correoE" name="correoE" value="<?php echo $row['correo'] ?>"> -->

                                <label class="titulo" style="font-size:12pt; font-weight: 600;" for="estadoPedido">Estado</label>

                            </div>

                        </form>

                    </td>

                    <td>

                        <a href="<?= doct ?>factura.php?email=<?= $email; ?>&idProducto=<?= $codigo ?>" target="_blank">

                            <img src="recursos/btPdf.png" alt="PDF" width="50" height="50" />

                        </a>

                    </td>

                </tr>



                <tr bgcolor="#F1F1F1">

                <?php } //fin foreach 
                ?>

                <td colspan="9">

                    <!-- <div id="mensaje"></div> -->

                    <p>

                        TOTAL VENTAS: <?= formatoMoneda($suma) ?>

                    </p>

                </td>

                </tr>

        </tbody>

    </table>



    <?php //Al final del archivo liberamos recursos

    $conexion->close();

    ?>

</div>