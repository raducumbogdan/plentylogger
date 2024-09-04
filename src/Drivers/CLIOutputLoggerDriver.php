<?php

namespace Plenty\Logger\Drivers;

class CLIOutputLoggerDriver extends AbstractLoggerDriver
{
    public function log(
        string $level,
        string $message,
        array $attributes = [],
        ?string $traceId = null
    ): void {
        echo $this->formatLogEntry($level, $message, $attributes, $traceId) . PHP_EOL;
    }
}
