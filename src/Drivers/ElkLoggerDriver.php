<?php

namespace Plenty\Logger\Drivers;

use DateTime;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

class ElkLoggerDriver extends AbstractLogger implements LoggerInterface
{
    private Client $client;
    private string $index;

    public function __construct(Client $client, string $index)
    {
        $this->client = $client;
        $this->index = $index;
    }

    /**
     * @throws AuthenticationException
     */
    public static function createWithDefaults(array $hosts, string $index): self
    {
        $client = ClientBuilder::create()->setHosts($hosts)->build();

        return new self($client, $index);
    }

    /**
     * @throws ServerResponseException
     * @throws ClientResponseException
     * @throws MissingParameterException
     */
    public function log($level, $message, array $context = [], ?string $traceId = null): void
    {
        $document = [
            'timestamp' => (new DateTime())->format('Y-m-d H:i:s'),
            'level' => $level,
            'message' => $message,
            'attributes' => $context,
        ];

        $this->client->index([
            'index' => $this->index,
            'body' => $document,
        ]);
    }
}
