<?php

namespace App\Utils;

class EmailSender
{
    public static function sendEmail($senderName, $senderEmail, $recipientEmail, $subject, $view, $formData): bool
    {
        $email = \Config\Services::email();
        $email->setFrom($senderEmail, $senderName)
            ->setTo($recipientEmail)
            ->setSubject($subject)
            ->setMessage(view($view, [
                'formData' => $formData,
            ]));

        return $email->send();
    }

    public static function getEmailBody($formData, $viewEmail): string
    {
        $emailHTML = view($viewEmail, [
            'formData' => $formData,
        ]);

        $emailBody = '';
        if (preg_match('/<body>(.*?)<\/body>/is', $emailHTML, $matches)) {
            $emailBody = $matches[1];

            $emailBody = preg_replace('/\s+/', '', $emailBody);
        }

        return $emailBody;
    }
}
