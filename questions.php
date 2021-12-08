<?php

require './dbconfig.php';
require('./tcpdf/tcpdf.php');
require './model.php';






// tcpdf's object
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


class PDF extends TCPDF
{

	// Page header
	public function Header()
	{
		$this->SetFont('Helvetica', 'B', 12);
		$this->SetTextColor(167, 147, 68);
		$this->Cell(0, 10, 'First Attempt Crack', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}



$pdf = new PDF();

$tag = "";

if (isset($_POST['tag'])){
	$tag = $_POST['tag'];
	$results = get_all_questions($conn,$tag);
}
else {
	$results = get_all_questions($conn,"all");
}

$pdf->AddPage('P', "A4");

$pdf->Cell(0,10,ucfirst($tag),0,1);

$question_no = 0;
foreach ($results as $result) {
	
	$question_no += 1;
	$pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('freesans', '', 14);
    $pdf->Multicell(190, 10,"Q".$question_no.". ". str_replace('</br>',"\n",trim($result[1])), 0, 2);
    $pdf->SetFont('freesans', '', 13);
	$pdf->SetTextColor(0, 155, 0);
	$pdf->Multicell(190,10,"Ans " .str_replace('</br>',"\n",trim($result[2])), 0,2);
	$pdf->Ln();
}
$pdf->Output("first_attempt_crack_".$tag.".pdf");
