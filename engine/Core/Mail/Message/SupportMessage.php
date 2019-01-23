<?php

namespace Engine\Core\Mail\Message;

class SupportMessage extends AbstractMessage
{
    protected $templateFile = FILE_ROOT_DIR . TEMPLATES_PATH . 'support-message.html';

    protected $subject = 'Запрос в службу поддержки BricksUnity';

    public function __construct($data, $email)
    {
        $this->data = $data;
        $this->email = $email;
    }
}