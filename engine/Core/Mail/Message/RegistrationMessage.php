<?php

namespace Engine\Core\Mail\Message;

class RegistrationMessage extends AbstractMessage
{
    protected $templateFile = FILE_ROOT_DIR . TEMPLATES_PATH . 'registration-message.html';

    protected $subject = 'Благодрим за регистрацию на сайте "BricksUnity"!';

    public function __construct($data, $email)
    {
        $this->data = $data;
        $this->email = $email;
    }
}