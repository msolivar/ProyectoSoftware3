<?php

    include 'conexion.php';

    $entrada=empty($_REQUEST["entrada"]) ? "Sin datos" : $_REQUEST["entrada"];

    $valor=0;

    if($entrada=="1"){
        $valor=45000;
    }
    else if($entrada==2){
        $valor=35000;
    }
    else if($entrada==3){
        $valor=25000;
    }
    else if($entrada==4){
        $valor=15000;
    }
    else{
        $valor=5000;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Entradas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #2d4739;
            color: white;
        }
        .container {
            background: #1f3a28;
            padding: 20px;
            border-radius: 10px;
        }
        .form-control {
            background: #e6e6e6;
            border: none;
            border-radius: 10px;
        }
        .total-pagar {
            font-size: 20px;
            color: red;
            font-weight: bold;
        }
        .btn-comprar {
            background-color: #c4a460;
            color: white;
            padding: 10px;
            border-radius: 20px;
            text-decoration: none;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h4 class="bg-success text-white p-2 rounded">Entrada general</h4>
        <form action="registrarpago.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <label>Nombres</label>
                    <input type="text" name="nombres" class="form-control" placeholder="Nombre" required>
                </div>
                <div class="col-md-6">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Número de cédula</label>
                    <input type="text" name="cedula" class="form-control" placeholder="Número de cédula" required>
                </div>
                <div class="col-md-6">
                    <label>Celular</label>
                    <input type="text" name="celular" class="form-control" placeholder="Celular" required>
                </div>
            </div>
            <div class="mt-3">
                <label>Correo electrónico</label>
                <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>
            </div>
            <div class="table-responsive mt-4">
                <table class="table text-white">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio unitario</th>
                            <th>Cantidad</th>
                            <th>Total a pagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Entrada general</td>
                            <td><input readonly type="text" name="precioEntrada" id="precioEntrada" class="form-control" placeholder="precioEntrada" value="<?php echo $valor;?>" required></td>
                            <td>
                                <button type="button" class="btn btn-secondary" onclick="cambiarCantidad(-1)">-</button>
                                <span id="cantidad">1</span>
                                <button type="button" class="btn btn-secondary" onclick="cambiarCantidad(1)">+</button>
                            </td>
                            <td><input readonly type="text" id="totalPagar" name="totalPagar" class="form-control" placeholder="Total a Pagar" value="<?php echo $valor;?>" required></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-comprar">Ir a pagar</button>
        </form>
    </div>

    <script>
        let cantidad = 1;
        const precioUnitario = document.getElementById('precioEntrada').value;
        
        function cambiarCantidad(valor) {
            cantidad += valor;
            
            document.getElementById('cantidad').innerText = cantidad;
            document.getElementById('totalPagar').value = "$ " + (cantidad * precioUnitario);
        }

        // Validar Pago
        function validarFormulario() {
            let nombres = document.querySelector('input[name="nombres"]').value.trim();
            let apellidos = document.querySelector('input[name="apellidos"]').value.trim();
            let cedula = document.querySelector('input[name="cedula"]').value.trim();
            let celular = document.querySelector('input[name="celular"]').value.trim();
            let correo = document.querySelector('input[name="correo"]').value.trim();

            if (nombres === "" || apellidos === "" || cedula === "" || celular === "" || correo === "") {
                alert("Por favor, complete todos los campos antes de continuar.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>