<?php

$fecha = date('Y-m-d');

require_once 'fpdf186/fpdf.php';

$pdf = new FPDF();
 
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->SetXY(80,10);
$pdf->Cell(50,0,utf8_decode('Receta'),0,0,'C',true);

$pdf->SetFont('Arial','B',14);
$pdf->SetXY(150,10);
$pdf->Cell(50,0,$fecha,0,0,'C',true);

$idga = $_POST["idgat"];

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'Adopciones';

$conexion = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

$consult = "SELECT * FROM adoptante ad INNER JOIN adopciones a on ad.id=a.idAdoptante INNER JOIN Gatos g ON a.idGato = g.id and g.id = $idga ";

$result = mysqli_query($conexion,$consult);

while($row = mysqli_fetch_assoc($result)){
    $pdf->SetFont('Arial','',12);

    $pdf->SetXY(21,30);
    $pdf->Cell(50,0,utf8_decode('Adoptante:'),0,0,'C',true);
    $pdf->SetXY(40,30);
    $pdf->Cell(50,0,$row['nombre'],0,0,'C',true);
    $pdf->SetXY(55,30);
    $pdf->Cell(50,0,$row['apepat'],0,0,'C',true);
    $pdf->SetXY(70,30);
    $pdf->Cell(50,0,$row['apemat'],0,0,'C',true);

    $pdf->SetXY(20,40);
    $pdf->Cell(50,0,utf8_decode('Dirección:'),0,0,'C',true);
    $pdf->SetXY(50,40);
    $pdf->Cell(50,0,$row['direccion'],0,0,'C',true);
    $pdf->SetXY(75,40);
    $pdf->Cell(50,0,$row['ciudad'],0,0,'C',true);
    $pdf->SetXY(105,40);
    $pdf->Cell(50,0,$row['estado'],0,0,'C',true);
    $pdf->SetXY(130,40);
    $pdf->Cell(50,0,$row['codigoPostal'],0,0,'C',true);

    $pdf->SetXY(25,50);
    $pdf->Cell(50,0,utf8_decode('Datos del Gato:'),0,0,'C',true);
    $pdf->SetXY(25,60);
    $pdf->Cell(50,0,utf8_decode('Nombre:'),0,0,'C',true);
    $pdf->Cell(50,0,$row['Nombre'],0,0,'C',true);
    $pdf->SetXY(29,70);
    $pdf->Cell(50,0,utf8_decode('Edad (Años):'),0,0,'C',true);
    $pdf->Cell(50,0,$row['Edad'],0,0,'C',true);

    $pdf->SetXY(35,80);
    $pdf->Cell(50,0,utf8_decode('Fecha de adopción:'),0,0,'C',true);
    $pdf->Cell(50,0,$row['fecha'],0,0,'C',true);

    $pdf->SetFont('Arial','B',14);
    $pdf->SetXY(90,100);
    $pdf->Cell(50,0,utf8_decode('Muchas Gracias por ayudar a tu gatito a tener una mejor vida.'),0,0,'C',true);

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(85,115);
    $pdf->Cell(50,0,utf8_decode('_______________________________'),0,0,'C',true);
    $pdf->SetXY(85,120);
    $pdf->Cell(50,0,utf8_decode('Firma de la organización'),0,0,'C',true);

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(85,140);
    $pdf->Cell(50,0,utf8_decode('_______________________________'),0,0,'C',true);
    $pdf->SetXY(85,145);
    $pdf->Cell(50,0,utf8_decode('Firma del adoptante'),0,0,'C',true);

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(85,170);
    $pdf->Cell(50,0,utf8_decode('_______________________________'),0,0,'C',true);
    $pdf->SetXY(85,175);
    $pdf->Cell(50,0,utf8_decode('Huellita de tu gatito'),0,0,'C',true);
    

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(85,200);
    $pdf->Cell(50,0,utf8_decode('La validez de este documento es de un año por lo que deberas de renovarlo,'),0,0,'C',true);
    $pdf->SetXY(85,210);
    $pdf->Cell(50,0,utf8_decode('recuerda asistir a la organización junto con tu gatito a firmar.'),0,0,'C',true);
    
}

$pdf->Output();

?>