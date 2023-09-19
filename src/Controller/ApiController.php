<?php

namespace App\Controller;

use App\Domain\ApiResponse;
use App\Domain\Bus\Query\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

class ApiController extends AbstractController
{
    protected MessageBusInterface $queryBus;
    protected ApiResponse $apiResponse;

    public function __construct
    (
        MessageBusInterface $queryBus,
        ApiResponse $apiResponse
    )
    {
        $this->queryBus = $queryBus;
        $this->apiResponse = $apiResponse;
    }

    protected function ask(Query $query): void
    {
    }
}