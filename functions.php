<?php

use PHPMailer\PHPMailer\PHPMailer;

function sendEmail($id)
{

    require_once('./lib/PHPMailer/PHPMailer.php');
    require_once('./lib/PHPMailer/SMTP.php');
    require_once('./lib/PHPMailer/Exception.php');

    require_once('./lib/FPDF/fpdf.php');


    include './bd_conexion.php';

    $sql = "SELECT id,name,lastname,age,address,email,electrolitos,glucosa,azucar,proteina FROM user WHERE id=" . $id;

    $resultado = $conn->query($sql);

    $recibo['userData'] = $resultado->fetch_assoc();

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetXY(100, 10);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(24, 7, 'Registro', 0, 0, 'C');


    $pdf->SetXY(10, 30);
    $pdf->SetFont('Arial', 'B', 10);
    //Cabecera
    $pdf->Cell(24, 7, utf8_decode('Paciente #'), 1, 0, 'L');
    $pdf->Cell(24, 7, utf8_decode('Nombre'), 1, 0, 'L');
    $pdf->Cell(24, 7, utf8_decode('Apellido'), 1, 0, 'L');
    $pdf->Cell(24, 7, utf8_decode('Edad'), 1, 0, 'L');
    $pdf->Cell(24, 7, utf8_decode('Direccion'), 1, 0, 'L');

    //Cuerpo
    $pdf->SetXY(10, 37);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(24, 7, utf8_decode($recibo['userData']['id']), 1, 0, 'L');
    $pdf->Cell(24, 7, utf8_decode($recibo['userData']['name']), 1, 0, 'L');
    $pdf->Cell(24, 7, utf8_decode($recibo['userData']['lastname']), 1, 0, 'L');
    $pdf->Cell(24, 7, utf8_decode($recibo['userData']['age']), 1, 0, 'L');
    $pdf->Cell(24, 7, utf8_decode($recibo['userData']['address']), 1, 0, 'L');
    $pdf->Ln();

    $pdf->SetXY(30, 44);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(30, 10, 'Electrolitos', 0, 0, 'C');
    $pdf->SetXY(10, 54);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(24, 7, utf8_decode('Electrolitos'), 1, 0, 'L');
    $pdf->SetXY(10, 61);
    $pdf->Cell(24, 7, utf8_decode($recibo['userData']['electrolitos']), 1, 0, 'L');
    $pdf->Ln();

    $pdf->SetXY(30, 71);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(30, 10, 'Glucosa', 0, 0, 'C');
    $pdf->SetXY(10, 78);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(24, 7, utf8_decode('Glucosa'), 1, 0, 'L');
    $pdf->SetXY(10, 85);
    $pdf->Cell(24, 7, utf8_decode($recibo['userData']['glucosa']), 1, 0, 'L');
    $pdf->Ln();

    $pdf->SetXY(30, 95);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(30, 10, 'Azucar', 0, 0, 'C');
    $pdf->SetXY(10, 102);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(24, 7, utf8_decode('Azucar'), 1, 0, 'L');
    $pdf->SetXY(10, 109);
    $pdf->Cell(24, 7, utf8_decode($recibo['userData']['azucar']), 1, 0, 'L');
    $pdf->Ln();

    $pdf->SetXY(30, 119);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(30, 10, 'Proteina', 0, 0, 'C');
    $pdf->SetXY(10, 126);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(24, 7, utf8_decode('Proteinas'), 1, 0, 'L');
    $pdf->SetXY(10, 133);
    $pdf->Cell(24, 7, utf8_decode($recibo['userData']['proteina']), 1, 0, 'L');
    $pdf->Ln();

    $emailAttachment = $pdf->Output('recibo.pdf', 'S');

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 465;
    $mail->isHTML(true);
    $mail->Username   = "daniel1243gomez@gmail.com";
    $mail->Password   = "holacomo1234";
    $mail->SetFrom("carlos3232pineda@gmail.com", "Laboratorio clinico Maracaibo");
    $mail->Subject = "recibo ";
    $mail->Body = "recibo";
    $mail->AddAddress($recibo['userData']['email']);
    $mail->AddStringAttachment($emailAttachment, 'file.pdf', 'base64', 'application/pdf'); // attachment

    try {

        $mail->send();
    } catch (Exception $e) {
    }

}
