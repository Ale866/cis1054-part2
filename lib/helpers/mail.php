<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '/../bootstrap.php';

class Mail
{
    public static function getPhpMailer()
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.gmail.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->Username = 'pizzeriamammamia1054@gmail.com';
        $phpmailer->Password = 'nxaq hbfd kzwc cfnz';
        $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        return $phpmailer;
    }
}
