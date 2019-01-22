<?php

namespace Engine\Core\Mail\Message;

class PasswordResetMessage extends AbstractMessage
{
    protected $templateFile = FILE_ROOT_DIR . TEMPLATES_PATH . 'password-reset-message.html';

    protected $subject = 'Сброс пароля на сайте "BricksUnity"';

    public function __construct($data, $email)
    {
        $this->data = $data;
        $this->email = $email;
    }
}