<?php 
use PHPMailer\PHPMailer\PHPMailer; 
require "./vendor/autoload.php"; 
$mail = new PHPMailer(); 
$mail->IsSMTP(); 
// cambiar a 0 para no ver mensajes de error 
$mail->SMTPDebug = 2; 
$mail->SMTPAuth = true; 
$mail->SMTPSecure = "tls"; 
$mail->Host = "smtp.gmail.com"; 
$mail->Port = 587; 
// introducir usuario de google 
$mail->Username = "aromerotrash@gmail.com"; 
// introducir clave 
$mail->Password = ""; 
$mail->SetFrom('user@gmail.com', 'Test'); 
// asunto 
$mail->Subject = "Correo de prueba";
// cuerpo 
$mail->MsgHTML('Prueba'); 
// adjuntos 
$mail->addAttachment("empleados.xml"); 
// destinatario 
$address = "alejandro.romero.pino@gmail.com"; 
$mail->AddAddress($address, "Test"); 
// enviar 
$resul = $mail->Send(); 
if(!$resul) { 
    echo "Error" . $mail->ErrorInfo; 
} else { 
    echo "Enviado"; 
  } 