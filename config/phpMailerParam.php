<?php
//
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
//
//require ROOT.'/PHPMailer-master/src/Exception.php';
//require ROOT.'/PHPMailer-master/src/PHPMailer.php';
//require ROOT.'/PHPMailer-master/src/SMTP.php';
//
//$mail = new PHPMailer;
//$mail->CharSet = 'UTF-8';
//
//// Настройки SMTP
//$mail->isSMTP();
//$mail->SMTPAuth = true;
//$mail->SMTPDebug = 1;
//
//$mail->Host = 'smtp.gmail.com';
//$mail->Port = 465;
//$mail->Username = 'anton.uzhva';
//$mail->SMTPSecure = "ssl";
//$mail->Password = 'Lumen2021';
//
//// От кого
//$mail->setFrom($userEmail, 'anton');
//
//// Кому
//$mail->addAddress($adminEmail, 'InternetShop');
////
////$mail->isHTML(true);
//
//// Тема письма
//$mail->Subject = $subject;
//
//// Тело письма
//
//$mail->Body =$message;
//
//// Приложение
////$mail->addAttachment("/Users/mac/PhpstormProjects/VictorZinchenko/InternetShop/template/images/home/gallery1.jpg");
//
//$mail->send();
