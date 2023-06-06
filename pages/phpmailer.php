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
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$hijos = $_POST['hijos'];
$aportes = $_POST['aportes'];
$mensaje = $_POST['mensaje'];


if( empty(trim($nombre)) ) $nombre = 'anonimo';
if( empty(trim($apellido)) ) $apellido = '';

$body = <<<HTML
    <h4>Contacto desde la web</h4>
    <h3>Datos</h3>
    <p>De: $nombre $apellido</p>
    <p>mail: $email</p>
    <p>teléfono: $telefono</p>
    <p>edad: $edad</p>
    <p>sexo Op1-Masc; Op2-Fem: $sexo</p>
    <p>cantidad de hijos: $hijos</p>
    <p>aportes desp de 2008 Op1-Si; Op2- No: $aportes</p>
    <h5>Mensaje</h5>
    $mensaje
HTML;

$mailer = new PHPMailer();
$mailer->setFrom( $email, "$nombre $apellido" );
$mailer->addAddress('estudionataliareggi@gmail.com','Sitio web');
$mailer->Subject = "Contacto Web";
$mailer->msgHTML($body);
$mailer->AltBody = strip_tags($body);
$mailer->CharSet = 'UTF-8';
$rta = $mailer->send( );

var_dump($rta);
header("Location: gracias.html" );