<?php

$isim = $_POST['name'];
$email = $_POST['email'];
$konu = $_POST['subject'];
$numara = $_POST['number'];

/* print_r($_POST); */

$host = "localhost";
$dbname = "contacts";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
  die("Connection error: " . mysqli_connect_error());
}

$sql = "INSERT INTO contacts_table (İsim, Email,	Konu, Numara)
        VALUES (?, ?, ?, ?)";


$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
  die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssss", $isim, $email, $konu, $numara);

mysqli_stmt_execute($stmt);


require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

/* $mail->SMTPDebug = SMTP::DEBUG_SERVER; */

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->CharSet = 'utf-8';

$mail->Host = "smtp-mail.outlook.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = ""; /* Auto Maili gönderen Username & Password */
$mail->Password = "";

$mail->setFrom("SEND91@hotmail.com.tr", "Form Otomasyon");
$mail->addAddress("hukuk.tamer@gmail.com", "Hukuk.Tamer");

$mail->Subject = "New Contact";
$mail->Body = "Yeni Form Bilgileri:"."\nİsim: ".$isim."\nEmail: ".$email."\nKonu: ".$konu."\nİrtibat Numarası: ".$numara."\n";

$mail->send();


header("Location: send.html")


?> 