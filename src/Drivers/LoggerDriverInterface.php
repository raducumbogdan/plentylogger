<?php

namespace Plenty\Logger\Drivers;

interface LoggerDriverInterface
{
    public function log(
        string $level,
        string $message,
        array $attributes = [],
        ?string $traceId = null
    ): void;
}
