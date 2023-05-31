<?php
if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: index.html" );
}

require '../phpmailer/PHPMailer.php';
require '../phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$sexo = $_POST['sexo'];
$hijos = $_POST['hijos'];
$aportes = $_POST['aportes'];
$mensaje = $_POST['mensaje'];


if( empty(trim($nombre)) ) $nombre = 'anonimo';
if( empty(trim($apellido)) ) $apellido = '';

$body = <<<HTML
    <h4>Contacto desde la web</h4>
    <p>De: $nombre $apellido / $email / $telefono</p>
    <p>Datos: $sexo / $hijos / $aportes</p>
    <h5>Mensaje</h5>
    $mensaje
HTML;

$mailer = new PHPMailer();
$mailer->setFrom( $email, "$nombre $apellido" );
$mailer->addAddress('julieta.gordillo@gmail.com','Sitio web');
$mailer->Subject = "Contacto Web";
$mailer->msgHTML($body);
$mailer->AltBody = strip_tags($body);
$mailer->CharSet = 'UTF-8';
$rta = $mailer->send( );

var_dump($rta);
header("Location: gracias.html" );