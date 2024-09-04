<?php

namespace Plenty\Logger;

use Illuminate\Support\Str;
use Plenty\Logger\Drivers\LoggerDriverInterface;

class PlentyLogger
{
    protected array $drivers = [];

    public function __construct(array $drivers)
    {
        foreach ($drivers as $driver) {
            $this->addDriver($driver);
        }
    }

    public function addDriver(LoggerDriverInterface $driver): void
    {
        $this->drivers[] = $driver;
    }

    protected function log($level, $message, array $attributes = [], ?string $traceId = null): void
    {
        $traceId = $traceId ?? Str::uuid(); // Generate a unique TraceID for the transaction if none has been provided

        foreach ($this->drivers as $driver) {
            $driver->log(
                $level,
                $message,
                $attributes,
                $traceId
            );
        }
    }

    public function debug($message, array $attributes = [], ?string $traceId = null): void
    {
        $this->log('debug', $message, $attributes, $traceId);
    }

    public function info($message, array $attributes = [], ?string $traceId = null): void
    {
        $this->log('info', $message, $attributes, $traceId);
    }

    public function notice($message, array $attributes = [], ?string $traceId = null): void
    {
        $this->log('notice', $message, $attributes, $traceId);
    }

    public function warning($message, array $attributes = [], ?string $traceId = null): void
    {
        $this->log('warning', $message, $attributes, $traceId);
    }

    public function error($message, array $attributes = [], ?string $traceId = null): void
    {
        $this->log('error', $message, $attributes, $traceId);
    }

    public function alert($message, array $attributes = [], ?string $traceId = null): void
    {
        $this->log('alert', $message, $attributes, $traceId);
    }
}
