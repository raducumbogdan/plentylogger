<?php

namespace Plenty\Tests\Drivers;

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;
use Plenty\Logger\Drivers\MySQLLogger;
use Plenty\Logger\Models\Logs;

class MysqlLoggerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Set up Eloquent ORM
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => 'test_database',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        // Ensure the log_entries table is empty
        Logs::truncate();
    }

    public function testLogToMySQL()
    {
        $logger = new MySQLLogger();
        $logger->log('ERROR', 'Test error message', ['context' => 'test'], 'trace123');

        $logEntry = Logs::where(['trace_id' => 'trace123'])->first();

        $this->assertNotNull($logEntry);
        $this->assertEquals('ERROR', $logEntry->level);
        $this->assertEquals('Test error message', $logEntry->message);
        $this->assertEquals(json_encode(['context' => 'test']), $logEntry->attributes);
        $this->assertEquals('trace123', $logEntry->trace_id);
    }
}
