<?php
require_once('../path.php');         // archivo donde defines 'dirpdf'
require_once('../conexionbd.php');   // conexión a la base de datos
// require_once('../recursos/funciones.php');
require_once('../' . dirpdf);             // carga la clase TCPDF

// Consulta a ejecutar

$email = isset($_GET["email"]) ? trim($_GET["email"]) : null;
$idProducto = isset($_GET["idProducto"]) ? trim($_GET["idProducto"]) : null;

$query = " SELECT f.id AS factura_id, f.usuario_id, f.productos, f.tipoDePago, f.totalAPagar,
    f.estadoPago, f.fechaRegistroPago, u.id AS usuario_id, u.cedula, u.nombre, u.apellido, u.email,
    u.fechaRegistroUsuario, u.telefono, u.password 
FROM factura f 
INNER JOIN 
    usuario u ON f.usuario_id = u.id 
WHERE 
    u.email = '$email' AND f.id = '$idProducto'
    ORDER BY f.id DESC";

$resultado = $conexion->query($query);

function formatoMoneda($cantidad, $decimales = 0)
{
    return "$ " . number_format($cantidad, $decimales, ",", ".");
}

function formatoMoneda1($cantidad, $decimales = 0)
{
    return number_format($cantidad, $decimales, ",", ".");
}

// Crear documento PDF
$pdf = new TCPDF();
$pdf->SetCreator('Sistema de Facturación');
$pdf->SetAuthor('Parque De La Vida');
$pdf->SetTitle('Facturación Electrónica');
$pdf->SetMargins(15, 20, 15);
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 24);
$pdf->Cell(0, 10, 'Facturación Electrónica', 0, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('helvetica', '', 14);

// Verificamos si hay datos
if ($resultado->num_rows > 0) {
    // Obtenemos los datos del cliente (primera fila)
    $fila = $resultado->fetch_assoc();

    $infoCliente = "
    <h4>Parque de la Vida: {$fecha_colombia}</h4>
    <table cellpadding='6' cellspacing='0'>
        <tr bgcolor='lightblue'>
            <td>
                <b>Cédula:</b> {$fila['cedula']}<br>
                <b>Cliente </b> {$fila['nombre']} {$fila['apellido']}<br>
                <b>Email:</b> {$fila['email']}<br>
                <b>Teléfono:</b> {$fila['telefono']}<br>
            </td>
            <td>
                <b>Moneda: </b> Cop Colombia, Pesos<br>
                <b>Fecha de Pago:</b> {$fila['fechaRegistroPago']}<br>
                <b>Hora Emisión: </b> {$hora_colombia}<br>
                <b>Fecha Emisión: </b> {$fecha_original}<br>
            </td>
        </tr>
    </table>";

    $pdf->writeHTML($infoCliente, true, false, true, false, '');

    // Reiniciamos el puntero para volver a recorrer resultados
    $resultado->data_seek(0);

    // Tabla de facturas
    $html = '
    <h4>Detalle de Facturas</h4>
    <table border="1" cellpadding="4">
        <thead>
            <tr style="background-color:#eaeaea;">
                <th>Productos</th>
                <th>Tipo de Pago</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Fecha de Pago</th>
            </tr>
        </thead>
        <tbody>';

    while ($factura = $resultado->fetch_assoc()) {

        $productos = json_decode($factura['productos'], TRUE);
        $detalleProducto = '';

        foreach ($productos as $k => $v) {

            $caracteristicas = 'Id: ' . $v['id'] . ' ' . $v['entrada'] . '<br> ' . $v['cantidadSolicitada'] . ' X ' . formatoMoneda1($v['precio']) . ' = ' . formatoMoneda1($v['totalAPagar']) . '<br>';

            $detalleProducto .= $caracteristicas;
        }

        $html .= '<tr>
            <td>' . $detalleProducto . '</td>
            <td>' . $factura['tipoDePago'] . '</td>
            <td>' . formatoMoneda($factura['totalAPagar']) . '</td>
            <td>' . $factura['estadoPago'] . '</td>
            <td>' . $factura['fechaRegistroPago'] . '</td>
        </tr>';
    }

    $html .= '</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
} else {
    $pdf->Write(0, 'No se encontraron facturas para este cliente.', '', 0, 'L', true, 0, false, false, 0);
}

// Salida del PDF
$pdf->Output('factura.pdf', 'I');
