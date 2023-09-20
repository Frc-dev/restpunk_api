<?php

namespace App\Domain;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Serializer\SerializerInterface;

class ApiResponse
{
    private SerializerInterface $serializer;

    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    public function handleResponse(Envelope $envelope): string
    {
        return $this->serializer->serialize($envelope->last(HandledStamp::class)->getResult(), 'json');
    }
}
