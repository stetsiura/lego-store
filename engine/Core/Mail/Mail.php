<?php

namespace Engine\Core\Mail;

use \Engine\Core\Mail\Message\AbstractMessage;
use \Engine\Core\Config\Config;

class Mail
{
    public function __construct(\Engine\DI\DI $di){}

    public function sendMessage(AbstractMessage $message)
    {
        try {
            $to = $message->getEmail();
			$subject = $message->getSubject();
			$html = $message->getBody();
			
			$headers = [];
			
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';
			$headers[] = 'From: ' . Config::group('main')['mail_from_name'] . ' <' . Config::group('main')['mail_from_email'] . '>';
			
			$result = mail($to, $subject, $html, implode("\r\n", $headers));
			
        } catch(\Exception $e) {
            $result = true;
        }


        return $result;
    }
}