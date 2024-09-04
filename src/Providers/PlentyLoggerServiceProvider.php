<?php

namespace Plenty\Logger\Providers;

use Illuminate\Support\ServiceProvider;
use Plenty\Logger\Drivers\CLIOutputLoggerDriver;
use Plenty\Logger\Drivers\ElkLoggerDriver;
use Plenty\Logger\Drivers\FileLoggerDriver;
use Plenty\Logger\Drivers\MySQLLogger;
use Plenty\Logger\PlentyLogger;

class PlentyLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');
    }

    public function register(): void
    {
        $this->app->singleton(PlentyLogger::class, function ($app) {
            $config = $app['config']->get('plentylogger');
            $driverInstances = $this->initializeDrivers($config['drivers']);

            return new PlentyLogger($driverInstances);
        });
    }

    protected function initializeDrivers(array $config): array
    {
        $drivers = [];


        if (array_key_exists('cli', $config)) {
            $drivers['cli'] = new CLIOutputLoggerDriver();
        }

        if (array_key_exists('file', $config)) {
            $drivers['file'] = new FileLoggerDriver($config['file']['path']);
        }

        if (array_key_exists('elk', $config)) {
            $drivers['elk'] = new ElkLoggerDriver($config['elk']['client'], $config['elk']['index']);
        }

        if (array_key_exists('mysql', $config)) {
            $drivers['mysql'] = new MySQLLogger();
        }

        return $drivers;
    }
}
