<?php
require_once('path.php');
//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 011 for TCPDF class
//               Colored Table (very simple table)
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group table
 * @group color
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once(dirPDF);

// Monto Total Venta En Caja Sin Pagar
//Calcular Las Transaciones de las facturas
require_once('conexion.php');
$consulta = "SELECT * FROM `usuario`";
$facturas = $conexion->query($consulta);

// extend TCPF with custom functions
class MYPDF extends TCPDF {

	// Load table data from file
	

	// Colored table
	public function ColoredTable($header,$data) {
		// Colors, line width and bold font
		$this->setFillColor(255, 0, 0);
		$this->setTextColor(255);
		$this->setDrawColor(128, 0, 0);
		$this->setLineWidth(0.3);
		$this->setFont('', 'B');
		// Header
		$w = array(40, 35, 40, 45);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->setFillColor(224, 235, 255);
		$this->setTextColor(0);
		$this->setFont('');
		// Data
		$fill = 0;

		foreach($data as $row) {
			$this->Cell($w[0], 6, number_format($row['id']), 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, $row['nombre'], 'LR', 0, 'L', $fill);
			$this->Cell($w[2], 6, $row['apellido'], 'LR', 0, 'R', $fill);
			$this->Cell($w[3], 6, $row['email'], 'LR', 0, 'R', $fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 011');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// column titles
$header = array('Id', 'Nombre', 'Apellido', 'Correo Electronico');

// print colored table
$pdf->ColoredTable($header, $facturas);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('exampleFacturas.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+