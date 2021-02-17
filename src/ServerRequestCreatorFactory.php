<?php

declare(strict_types=1);

namespace Jnjxp\App;

use Nyholm\Psr7Server\ServerRequestCreator;
use Nyholm\Psr7Server\ServerRequestCreatorInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

class ServerRequestCreatorFactory
{
    public function __invoke(ContainerInterface $container, string $name)
    {
        switch ($name) {
            case ServerRequestCreatorInterface::class:
            case ServerRequestCreator::class:
                return $this->newServerRequestCreator($container);
                break;
            default:
                throw new ServiceNotFoundException("Service Not Found: $name");
                break;
        }
    }

    public function newServerRequestCreator(ContainerInterface $container) : ServerRequestCreatorInterface
    {
        return new ServerRequestCreator(
            $container->get(ServerRequestFactoryInterface::class),
            $container->get(UriFactoryInterface::class),
            $container->get(UploadedFileFactoryInterface::class),
            $container->get(StreamFactoryInterface::class),
        );
    }
}
