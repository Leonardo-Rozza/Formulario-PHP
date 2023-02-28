<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


function sendMail($asunto, $body, $email, $name, $html = false){

  //Iniciacion 
  $phpmailer = new PHPMailer();
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.gmail.com';
  $phpmailer->SMTPAuth = true;
  $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
  $phpmailer->Port = 465;
  $phpmailer->Username = 'leonardo155964@gmail.com';
  $phpmailer->Password = 'qiaiuoyynaxhomag';

  // Añadiendo destinatarios
  $phpmailer->setFrom('contac@miempresa.com', 'Miempresa');
  $phpmailer->addAddress($email, $name);   

  //Definiendo el contenido de mi email.
    $phpmailer->isHTML($html);                                  //Set email format to HTML
    $phpmailer->Subject = $asunto;
    $phpmailer->Body = $body;

  //Mandamos el correo
    $phpmailer->send();
}




?>