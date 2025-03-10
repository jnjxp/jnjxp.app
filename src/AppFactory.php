<?php

declare(strict_types=1);

namespace Jnjxp\App;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class AppFactory
{
    const SERVER_REQUEST_CREATOR = 'server-request-creator';

    public function __invoke(ContainerInterface $container, string $name)
    {
        switch ($name) {
            case AppInterface::class:
            case App::class:
                return $this->newApp($container);
                break;
            case ErrorGenerator::class:
                return $this->newErrorGenerator($container);
                break;
            case EmitterInterface::class:
                return $this->newEmitter($container);
                break;
            default:
                throw new ServiceNotFoundException("Service Not Found: $name");
                break;
        }
    }

    public function newApp(ContainerInterface $container) : AppInterface
    {
        return new App(
            $container->get(EmitterInterface::class),
            $container->get(self::SERVER_REQUEST_CREATOR),
            $container->get(ErrorGenerator::class)
        );
    }

    public function newErrorGenerator(ContainerInterface $container) : callable
    {
        return new ErrorGenerator($container->get(ResponseFactoryInterface::class));
    }

    public function newEmitter() : EmitterInterface
    {
        return new SapiEmitter();
    }
}
