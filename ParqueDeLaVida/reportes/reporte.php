<?php
require_once('../path.php');         // archivo donde defines 'dirpdf'
require_once('../conexionbd.php');   // conexión a la base de datos
require_once('../'.dirpdf);             // carga la clase TCPDF

// Consulta a ejecutar
$query = "SELECT id, email, nombre, apellido FROM `usuario`";
$usuarios = $conexion->query($query);

// Clase extendida para la tabla personalizada
class MYPDF extends TCPDF {
	public function ColoredTable($header, $data) {
		$this->setFillColor(255, 0, 0);
		$this->setTextColor(255);
		$this->setDrawColor(128, 0, 0);
		$this->setLineWidth(0.3);
		$this->setFont('', 'B');

		$w = array(40, 35, 40, 45);
		for ($i = 0; $i < count($header); ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();

		$this->setFillColor(224, 235, 255);
		$this->setTextColor(0);
		$this->setFont('');
		$fill = 0;

		while ($row = $data->fetch_assoc()) {
			$this->Cell($w[0], 6, $row['id'], 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, $row['nombre'], 'LR', 0, 'L', $fill);
			$this->Cell($w[2], 6, $row['apellido'], 'LR', 0, 'L', $fill);
			$this->Cell($w[3], 6, $row['email'], 'LR', 0, 'L', $fill);
			$this->Ln();
			$fill = !$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}
}

// Crear PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sistema');
$pdf->setTitle('Reporte de Usuarios');
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Fuente y página
$pdf->setFont('helvetica', '', 12);
$pdf->AddPage();

// Cabeceras
$header = array('Id', 'Nombre', 'Apellido', 'Correo Electronico');

// Mostrar tabla
$pdf->ColoredTable($header, $usuarios);

// Salida del PDF
$pdf->Output('usuarios_registrados.pdf', 'I');

$conexion->close();
