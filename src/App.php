<?php

declare(strict_types=1);

namespace Jnjxp\App;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;
use Nyholm\Psr7Server\ServerRequestCreatorInterface;
use Psr\Http\Server\RequestHandlerInterface;

class App implements AppInterface
{
    protected $emitter;

    protected $serverRequestCreator;

    protected $errorGenerator;

    public function __construct(
        EmitterInterface $emitter,
        ServerRequestCreatorInterface $serverRequestCreator,
        callable $errorGenerator
    ) {
        $this->emitter = $emitter;
        $this->serverRequestCreator = $serverRequestCreator;
        $this->errorGenerator = $errorGenerator;
    }

    public function run(RequestHandlerInterface $pipe) : void
    {
        $runner = $this->newRunner($pipe);
        $runner->run();
    }

    protected function newRunner(RequestHandlerInterface $pipe) : RequestHandlerRunner
    {
        return new RequestHandlerRunner(
            $pipe,
            $this->emitter,
            [$this->serverRequestCreator, 'fromGlobals'],
            $this->errorGenerator
        );
    }
}
