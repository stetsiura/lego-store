<?php

namespace Engine\Core\Mail;

use \Engine\Core\Mail\Message\AbstractMessage;
use \Engine\Core\Config\Config;
use Mailgun\Mailgun;

class Mail
{
    public function __construct(\Engine\DI\DI $di){}

    public function sendMessage(AbstractMessage $message)
    {
        try {
            /* $to = $message->getEmail();
			$subject = $message->getSubject();
			$html = $message->getBody();
			
			$headers = [];
			
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';
			$headers[] = 'From: ' . Config::group('main')['mail_from_name'] . ' <' . Config::group('main')['mail_from_email'] . '>';
			
            $result = mail($to, $subject, $html, implode("\r\n", $headers)); */
            
            $mgClient = new Mailgun('key-0c74da4cdafb41eb0d18b691ad1ed93b', new \Http\Adapter\Guzzle6\Client());
            $domain = "sandbox6ac7123272dd4023bd87d656267b618d.mailgun.org";

            $result = $mgClient->sendMessage($domain, array(
                'from'    => Config::group('main')['mail_from_name'] . ' <' . Config::group('main')['mail_from_email'] . '>',
                'to'      => $message->getEmail(),
                'subject' => $message->getSubject(),
                'html'    => $message->getBody()
            ));
			
        } catch(\Exception $e) {
            $result = true;
        }


        return $result;
    }
}