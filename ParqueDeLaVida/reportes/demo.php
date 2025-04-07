<?php
require_once('../path.php');         // archivo donde defines 'dirpdf'
require_once('../conexionbd.php');   // conexión a la base de datos
require_once('../'.dirpdf);             // carga la clase TCPDF

// Consulta a ejecutar
$query = "SELECT id, cedula, nombre, apellido, email, telefono FROM usuario";
$resultado = $conexion->query($query);

// Crear el documento PDF
$pdf = new TCPDF();
$pdf->SetCreator('Sistema');
$pdf->SetAuthor('TuEmpresa');
$pdf->SetTitle('Reporte de Usuarios Registrados');
$pdf->SetMargins(15, 20, 15);
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Usuarios Registrados', 0, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('helvetica', '', 10);

// Verificamos si hay resultados
if ($resultado->num_rows > 0) {
    $html = '
    <table border="1" cellpadding="4">
        <thead>
            <tr style="background-color:#f2f2f2;">
                <th>ID</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>';

    while ($usuario = $resultado->fetch_assoc()) {
        $html .= '<tr>
            <td>' . $usuario['id'] . '</td>
            <td>' . $usuario['cedula'] . '</td>
            <td>' . htmlspecialchars($usuario['nombre']) . '</td>
            <td>' . htmlspecialchars($usuario['apellido']) . '</td>
            <td>' . htmlspecialchars($usuario['email']) . '</td>
            <td>' . $usuario['telefono'] . '</td>
        </tr>';
    }

    $html .= '</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
} else {
    $pdf->Write(0, 'No se encontraron usuarios registrados.', '', 0, 'L', true, 0, false, false, 0);
}

// Salida del PDF
$pdf->Output('usuarios_registrados.pdf', 'I');