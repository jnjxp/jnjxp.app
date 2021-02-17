<?php

declare(strict_types=1);

namespace Jnjxp\App;

use Psr\Http\Server\RequestHandlerInterface;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;

interface AppInterface
{
    public function run(RequestHandlerInterface $pipe) : void;
}
