<?php

namespace Engine\Service\Mail;

use \Engine\Service\AbstractProvider;
use \Engine\Core\Mail\Mail;

class Provider extends AbstractProvider
{
    /**
     * @var string $serviceName
     */
    public $serviceName = 'mail';

    /**
     * @return mixed
     */
    public function init()
    {
        $mail = new Mail($this->di);

        $this->di->set($this->serviceName, $mail);
    }
}