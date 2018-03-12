<?php
/**
 * MailSender
 */

namespace App\Lib;

use SendGrid\Content;
use SendGrid\Email;
use SendGrid\Mail;
use SendGrid\Response;

/**
 * Class MailSender
 *
 * @package App\Lib
 */
class MailSender
{

    /**
     * メール送信を行う
     *
     * @param SendMailInterface $sendMail
     * @return Response
     */
    public function send(SendMailInterface $sendMail): Response
    {
        $from = new Email(
            $sendMail->getFrom(),
            $sendMail->getFrom()
        );

        $subject = $sendMail->getSubject();

        $to = new Email(
            $sendMail->getTo(),
            $sendMail->getTo()
        );
        $content = new Content('text/plain', $sendMail->getContent());
        $mail = new Mail($from, $subject, $to, $content);

        $apiKey = getenv('SENDGRID_API_KEY');

        $sendGrid = new \SendGrid($apiKey);

        return $sendGrid->client->mail()->send()->post($mail);
    }
}
