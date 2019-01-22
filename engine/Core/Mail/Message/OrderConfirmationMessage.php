<?php

namespace Engine\Core\Mail\Message;

class OrderConfirmationMessage extends AbstractMessage
{
    protected $templateFile = FILE_ROOT_DIR . TEMPLATES_PATH . 'order-confirm-template.html';

    protected $subject = 'Подтверждение заказа на сайте "BricksUnity"';

    public function __construct($data, $email)
    {
        $this->data = $data;
        $this->email = $email;
    }
}