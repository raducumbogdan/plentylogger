<?php

namespace Plenty\Tests\Drivers;

use PHPUnit\Framework\TestCase;
use Plenty\Logger\Drivers\FileLoggerDriver;

class FileLoggerTest extends TestCase
{
    protected string $logFilePath = __DIR__ . '/log_test.log';

    protected function setUp(): void
    {
        parent::setUp();
        if (file_exists($this->logFilePath)) {
            unlink($this->logFilePath);
        }
    }

    protected function tearDown(): void
    {
        if (file_exists($this->logFilePath)) {
            unlink($this->logFilePath);
        }
        parent::tearDown();
    }

    public function testLogToFile()
    {
        $logger = new FileLoggerDriver($this->logFilePath);
        $logger->log('INFO', 'Test message', ['key' => 'value'], 'trace123');

        $this->assertFileExists($this->logFilePath);

        $logContent = file_get_contents($this->logFilePath);

        $this->assertStringContainsString('INFO', $logContent);
        $this->assertStringContainsString('Test message', $logContent);
        $this->assertStringContainsString('trace123', $logContent);
        $this->assertStringContainsString(json_encode(['key' => 'value']), $logContent);
    }
}
