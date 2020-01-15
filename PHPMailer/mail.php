<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if(isset($_POST['email'])) { 
	$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
}
if(isset($_POST['nombre'])) { 
	$nombre = filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
}
if(isset($_POST['ejes'])) { 
	$ejes = filter_var($_POST['ejes'],FILTER_SANITIZE_STRING);
}
if(isset($_POST['problema'])) { 
	$problema = filter_var($_POST['problema'],FILTER_SANITIZE_STRING);
}
if(isset($_POST['solucion'])) { 
	$solucion = filter_var($_POST['solucion'],FILTER_SANITIZE_STRING);
}
$video='';
if(isset($_POST['video'])) { 
	$video = filter_var($_POST['video'],FILTER_SANITIZE_STRING);
}


//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "soportefacweb@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "rpdmrgfssfdswuxe";
//Set who the message is to be sent from
$mail->setFrom('soportefacweb@gmail.com', 'Notificaciones Construyendo Futuro!');
//Set an alternative reply-to address
//$mail->addReplyTo('soportefacweb@gmail.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($email, $nombre);
//Set the subject line  
$mail->Subject = "Hola $nombre. Se ha recibido su proposición!";
//$mail->Body = 'Hola '.$nombre.'! <br><br>Hemos recibido su propuesta para la construcción del plan de desarrollo Construyendo Futuro 2020 - 2013 <br><br> Resumen de su proposición: <br><br>Eje seleccionado: <strong>'.$ejes.'</strong><br><br> Problema: '.$problema.' <br>Solución: '.$solucion.' <br><br>Puede ver su video en: <a href=\"https://facundocastillo.com.co/uploads/'.$video.'\">Ver video</a>';
if($video<>''){
    $mail->Body = "Hola $nombre! <br><br>Hemos recibido su propuesta para la construcción del plan de desarrollo Construyendo Futuro 2020 - 2013 <br><br> Resumen de su proposición: <br><br>Eje seleccionado: <strong>$ejes</strong><br><br> Puede ver su video en: <a href=\"https://facundocastillo.com.co/plan/uploads/$video\">Ver video</a>";
}else {    
    $mail->Body = "Hola $nombre! <br><br>Hemos recibido su propuesta para la construcción del plan de desarrollo Construyendo Futuro 2020 - 2013 <br><br> Resumen de su proposición: <br><br>Eje seleccionado: <strong>$ejes</strong><br><br> Problema: $problema <br>Solución: $solucion";
}
//$mail->Body .= "<a href=\"http://localhost:82/construfuturo/uploads/6652709233000198.webm\">Ver video</a>";
$mail->IsHTML(true);
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
///$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Replace the plain text body with one created manually
///$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
///$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}