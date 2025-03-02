<?php

declare(strict_types=1);

namespace Jnjxp\App;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;
use Psr\Http\Server\RequestHandlerInterface;

class App implements AppInterface
{
    protected $serverRequestCreator;

    protected $errorGenerator;

    public function __construct(
        protected EmitterInterface $emitter,
        callable $serverRequestCreator,
        callable $errorGenerator
    ) {
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
            $this->serverRequestCreator,
            $this->errorGenerator
        );
    }
}
