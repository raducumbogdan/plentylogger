<?php

namespace Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Plenty\Logger\Drivers\LoggerDriverInterface;
use Plenty\Logger\PlentyLogger;

class PlentyLoggerTest extends TestCase
{
    protected PlentyLogger $logger;
    protected MockObject|LoggerDriverInterface $fileDriver;
    protected MockObject|LoggerDriverInterface $elkDriver;
    protected MockObject|LoggerDriverInterface $mysqlDriver;

    protected function setUp(): void
    {
        parent::setUp();

        // Create mocks for log drivers
        $this->fileDriver = $this->createMock(LoggerDriverInterface::class);
        $this->elkDriver = $this->createMock(LoggerDriverInterface::class);
        $this->mysqlDriver = $this->createMock(LoggerDriverInterface::class);

        // Initialize PlentyLogger with mocked drivers
        $this->logger = new PlentyLogger([
            $this->fileDriver,
            $this->elkDriver,
            $this->mysqlDriver,
        ]);
    }

    public function testDebugLogging()
    {
        $this->fileDriver
            ->expects($this->once())
            ->method('log')
            ->with(
                'debug',
                'Debug message',
                ['some' => 'arguments'],
                'trace123'
            );

        $this->elkDriver
            ->expects($this->once())
            ->method('log')
            ->with(
                'debug',
                'Debug message',
                ['some' => 'arguments']
            );

        $this->mysqlDriver
            ->expects($this->once())
            ->method('log')
            ->with(
                'debug',
                'Debug message',
                ['some' => 'arguments']
            );

        // Log a debug message
        $this->logger->debug('Debug message', ['some' => 'arguments'], 'trace123');
    }
}
