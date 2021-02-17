<?php

declare(strict_types=1);

namespace Jnjxp\App;

use Psr\Container\NotFoundExceptionInterface;

class ServiceNotFoundException extends \Exception implements NotFoundExceptionInterface
{
}
