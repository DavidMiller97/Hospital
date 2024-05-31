<?php

require_once '../../fpdf186/fpdf.php';
require_once '../db/db.php';

class PDF extends FPDF {
    function Header() {
        // Logo
        // $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',16);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,'Receta Medica',0,0,'C');
        // Salto de línea
        $this->Ln(20);
    }
    
    function Footer() {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial itálica 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);



$idConsulta = $_POST['idConsulta'];
$fecha = date('Y-m-d');



$consult = "
SELECT 
    CONCAT(paciente.nombre, ' ', paciente.apellidopaterno, ' ', paciente.apellidoMaterno) AS paciente,
    CONCAT(medico.nombre, ' ', medico.apellidoPa, ' ', medico.apellidoMa) AS medico,
    consulta.padecimiento as padecimiento,
    receta.indicaciones as indicaciones,
    receta.comentarios as comentario,
    medicamento.nombre AS medicamento
FROM 
    receta
    JOIN consulta ON consulta.idConsulta = receta.idConsulta
    JOIN paciente ON consulta.idPaciente = paciente.idPaciente
    JOIN medico ON consulta.idMedico = medico.idmedico
    JOIN detallesReceta ON receta.idReceta = detallesReceta.idReceta
    JOIN medicamento ON detallesReceta.idMedicamento = medicamento.idMedicamento
WHERE 
    consulta.idConsulta = $idConsulta
";

$result = mysqli_query($mysqli, $consult);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($mysqli));
}

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Fecha de consulta: ') . $fecha, 0, 1);
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Paciente:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, utf8_decode($row['paciente']), 0, 1);
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Medico:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, utf8_decode($row['medico']), 0, 1);
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Padecimiento:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, utf8_decode($row['padecimiento']), 0, 1);
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Indicaciones:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, utf8_decode($row['indicaciones']), 0, 1);
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Comentarios:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, utf8_decode($row['comentario']), 0, 1);
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Medicamento:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, utf8_decode($row['medicamento']), 0, 1);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 30, utf8_decode('_______________________________'), 0, 1, 'C');
    $pdf->Cell(0, 10, utf8_decode('Firma médica'), 0, 1, 'C');
}

$pdf->Output();
?>
