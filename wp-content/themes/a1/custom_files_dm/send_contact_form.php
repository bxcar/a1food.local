<?php
require_once("../../../../wp-load.php");

require './PHPMailer/src/PHPMailer.php';
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();
$mail->setFrom('it@a1eda.ru', 'A1EDA');
$mail->isHTML(true);
$mail->Subject   = 'Message Subject';
$message = "";
if($_POST['user_phone']) {
    $message .= '<strong>Телефон: </strong>'.$_POST['user_phone'].'<br>';
}
if($_POST['user_name']) {
    $message .= '<strong>Имя: </strong>'.$_POST['user_name'].'<br>';
}
if($_POST['user_section']) {
    $message .= '<strong>Раздел: </strong>'.$_POST['user_section'].'<br>';
}
if($_POST['feedback']) {
    $message .= '<strong>Сообщение: </strong>'.$_POST['feedback'].'<br>';
} else {
    echo json_encode(
        [
            'success' => 'false'
        ]
    );
    die();
}
$mail->Body      = $message;
$mail->addAddress($_POST['email']);

if (isset($_FILES['file']) &&
    $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    $mail->AddAttachment($_FILES['file']['tmp_name'],
        $_FILES['file']['name']);
}

if($mail->Send()) {
    echo json_encode(
        [
            'success' => 'true'
        ]
    );
} else {
    echo json_encode(
        [
            'success' => 'false'
        ]
    );
}



