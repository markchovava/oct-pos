<?php 

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 14);

$pdf->Cell(130, 5, 'Hello There.', '', 0);
$pdf->Cell(59, 5, 'Hello There.', '', 1);

$pdf->Output();