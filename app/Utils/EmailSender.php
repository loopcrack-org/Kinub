<?php
namespace App\Utils;

use App\Models\EmailModel;

class EmailSender{

    public static function sendEmail($senderName, $senderEmail, $recipientEmail, $subject, $view, $formData): bool
    {

        $email = \Config\Services::email();
        $email->setFrom($senderEmail, $senderName)
            ->setTo($recipientEmail)
            ->setSubject($subject)
            ->setMessage(view($view, [
                    "formData" => $formData
            ]));

        return $email->send();
    }
}