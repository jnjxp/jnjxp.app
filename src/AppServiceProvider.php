<?php

declare(strict_types=1);

namespace Jnjxp\App;

use Interop\Container\ServiceProviderInterface;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Nyholm\Psr7Server\ServerRequestCreator;
use Nyholm\Psr7Server\ServerRequestCreatorInterface;

class AppServiceProvider implements ServiceProviderInterface
{
    public function getFactories()
    {
        return [
            App::class => AppFactory::class,
            AppInterface::class => AppFactory::class,
            EmitterInterface::class => AppFactory::class,
            ErrorGenerator::class => AppFactory::class,
            ServerRequestCreator::class => ServerRequestCreatorFactory::class,
            ServerRequestCreatorInterface::class => ServerRequestCreatorFactory::class,
        ];
    }

    public function getExtensions()
    {
        return [];
    }
}
