<?php

//$path = Yii::getAlias("@vendor/fpdf/fpdf.php");
require_once Yii::$app->basePath.'\vendor\fpdf\fpdf.php';
define('FPDF_FONTPATH','font/');

//require_once($path);


$pdf = new FPDF();
$pdf->AddPage();
$pdf->AddFont('helvetica','I');
$pdf->SetFont('helvetica','',16);
$pdf->Cell(40,10,'Hola, Mundo');

header('Content-type: application/pdf');
$pdf->Output();
?>