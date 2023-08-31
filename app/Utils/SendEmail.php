<?php
namespace App\Utils;

use App\Models\EmailModel;

class SendEmail{

    public static function sendEmailMailer($senderName, $senderEmail, $recipientEmail, $subject, $view, $formData): bool
    {

        $email = \Config\Services::email();
        $email->setFrom($senderEmail, $senderName);
        $email->setTo($recipientEmail);

        $email->setSubject($subject);

        $email->setMessage(view($view, [
            "formData" => $formData
        ]));

        if($email->send()){
            $successEmail = true;
        }else{
            $successEmail = false;
        }

        return $successEmail;
    }
}