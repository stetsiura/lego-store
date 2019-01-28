<?php

namespace Engine\Core\Mail\Message;

class OrderNotificationMessage extends AbstractMessage
{
    protected $templateFile = FILE_ROOT_DIR . TEMPLATES_PATH . 'order-notification-template.html';

    protected $subject = 'Новый заказ на "BricksUnity"';

    public function __construct($data, $email)
    {
        $this->data = $data;
        $this->email = $email;
    }
}
