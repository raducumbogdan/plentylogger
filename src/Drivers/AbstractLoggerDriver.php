<?php

namespace Plenty\Logger\Drivers;

abstract class AbstractLoggerDriver implements LoggerDriverInterface
{
    protected function formatLogEntry(
        string $level,
        string $message,
        array $attributes,
        ?string $traceId
    ): string {
        $timestamp = date('Y-m-d H:i:s');
        $entry = [
            'timestamp' => $timestamp,
            'level' => $level,
            'message' => $message,
            'traceId' => $traceId,
            'attributes' => $attributes,
        ];

        return json_encode($entry);
    }
}
