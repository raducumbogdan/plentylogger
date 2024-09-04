<?php

namespace Plenty\Tests\Drivers;

use PHPUnit\Framework\TestCase;
use Plenty\Logger\Drivers\CLIOutputLoggerDriver;

class CLIOutputLoggerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Start output buffering
        ob_start();
    }

    protected function tearDown(): void
    {
        // Clean up and end buffering
        ob_end_clean();
        parent::tearDown();
    }

    public function testLogToCLI()
    {
        // Create an instance of CLIOutputLogger
        $logger = new CLIOutputLoggerDriver();

        // Capture the output
        ob_start();

        // Log a message
        $logger->log('INFO', 'Test CLI message', ['key' => 'value'], 'trace123');

        // Get the output
        $output = ob_get_clean();

        // Check if the output matches the expected output
        $this->assertStringContainsString('INFO', $output);
        $this->assertStringContainsString('Test CLI message', $output);
        $this->assertStringContainsString('trace123', $output);
        $this->assertStringContainsString(json_encode(['key' => 'value']), $output);
        $this->assertMatchesRegularExpression('/"timestamp":"\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}"/', $output);
    }
}
