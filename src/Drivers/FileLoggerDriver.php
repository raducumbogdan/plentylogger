<?php

namespace Plenty\Logger\Drivers;

class FileLoggerDriver extends AbstractLoggerDriver
{
    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function log(
        string $level,
        string $message,
        array $attributes = [],
        ?string $traceId = null
    ): void {
        file_put_contents(
            $this->filePath,
            $this->formatLogEntry($level, $message, $attributes, $traceId) . PHP_EOL,
            FILE_APPEND
        );
    }
}
