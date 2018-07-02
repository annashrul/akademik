<?php
//============================================================+
// File name   : example_005.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 005 for TCPDF class
//               Multicell
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
 * @abstract TCPDF - Example: Multicell
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Report '.$judul);
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)



// set color for background
$pdf->SetFillColor(255, 255, 215);

// set font
$pdf->SetFont('helvetica', '', 12);

// set cell padding
// $pdf->setCellPaddings(2, 4, 6, 8);

// $txt = "CUSTOM PADDING:\nLeft=2, Top=4, Right=6, Bottom=8\nLorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue.\n";
$title = <<<EOD
	<h3>$judul </h3>
EOD;

$pdf->writeHTMLCell(0,0,'','',$title,0,1,0,true,'C',true);

$table = '<table style="padding:5px;">
						<tr>
							<td align="left">NIS</td>
							<td align="left" style="width:40;">:</td>
							<td align="left" style="width:300px;">'.$cb->nis.'</td>
						</tr>
						<tr>
							<td align="left">Nama</td>
							<td align="left" style="width:40;">:</td>
							<td align="left">'.$cb->nama.'</td>
						</tr>
						<tr>
							<td align="left">kelas</td>
							<td align="left" style="width:40;">:</td>
							<td align="left">'.$cb->id_kelas.'</td>
						</tr>
						<tr>
							<td align="left">Jurusan</td>
							<td align="left" style="width:40;">:</td>
							<td align="left">'.$cb->jurusan.'</td>
						</tr>
						<tr>
							<td align="left">Biaya</td>
							<td align="left" style="width:40;">:</td>
							<td align="left" style="width:400px;">'.ucwords(''.terbilang($cb->biaya).'').' Rupiah ( '.ucwords(''.terbilang($cb->biaya).'').' Rupiah )</td>
						</tr>
					
						<tr>
							<td align="left">Jumlah Uang</td>
							<td align="left" style="width:40;">:</td>
							<td align="left">'.'Rp '. number_format($cb->jumlah_uang).' || '.ucwords(''.terbilang($cb->jumlah_uang).'').'</td>
						</tr>
						<tr>
							<td align="left">Kembalian</td>
							<td align="left" style="width:40;">:</td>
							<td align="left">'.'Rp '. number_format($cb->kembalian).'</td>
						</tr>
					';
					// foreach($cetak_pembayaran as $s):
					// $table.='
					// 	<tr>
					// 		<td style="border:1px solid black;">'.$s->nis.'</td>
					// 		<td style="border:1px solid black;">'.$s->nama.'</td>
					// 		<td style="border:1px solid black;">'.strtoupper($s->id_kelas).'</td>
					// 		<td style="border:1px solid black;">'.$s->jurusan.'</td>
					// 		<td style="border:1px solid black;">'.$s->biaya.'</td>
					// 		<td style="border:1px solid black;">'.$s->jumlah_uang.'</td>
					// 	</tr>
					// ';
					// endforeach; 
$table .= '</table>';
$pdf->writeHTMLCell(0,0,'','',$table,0,1,0,true,'C',true);

$table1 = '<table style="padding:6px;">
						<tr>
							<td colspan="7" align="right">'.longdate_indo($cb->tanggal_bayar).'</td>
						</tr>
						<tr>
							<td colspan="7" align="right"></td>
						</tr>
						<tr><td  colspan="7" align="right">Annashrul Yusuf M,kom</td></tr>
					';
$table1 .= '</table>';
$pdf->writeHTMLCell(0,0,'','',$table1,0,1,0,true,'C',true);
$pdf->MultiCell(55, 5, 1, 'J', 1, 2, 125, 210, true);

// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('report-data-siswa.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
