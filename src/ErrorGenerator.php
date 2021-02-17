<?php

declare(strict_types=1);

namespace Jnjxp\App;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ErrorGenerator implements StatusCodeInterface
{
    protected $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Throwable $e) : ResponseInterface
    {
        $response = $this->createResponse();

        $response->getBody()
            ->write(sprintf('An error occurred: %s', $e->getMessage()));

        return $response;
    }

    protected function createResponse() : ResponseInterface
    {
        return $this->responseFactory->createResponse(self::STATUS_INTERNAL_SERVER_ERROR);
    }
}
