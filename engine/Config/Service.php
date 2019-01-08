<?php

return [
	Engine\Service\Database\Provider::class,
	Engine\Service\QueryBuilder\Provider::class,
	Engine\Service\Model\Provider::class,
	Engine\Service\Load\Provider::class,
	Engine\Service\Router\Provider::class,
	Engine\Service\View\Provider::class,
	Engine\Service\Config\Provider::class,
	Engine\Service\Request\Provider::class,
	Engine\Service\Auth\Provider::class,
	Engine\Service\Image\Provider::class,
	Engine\Service\File\Provider::class,
	Engine\Service\Cart\Provider::class,
    Engine\Service\Mail\Provider::class
];