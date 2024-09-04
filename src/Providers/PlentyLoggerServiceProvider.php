<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Plenty\Logger\Drivers\CLIOutputLoggerDriver;
use Plenty\Logger\Drivers\ElkLoggerDriver;
use Plenty\Logger\Drivers\FileLoggerDriver;
use Plenty\Logger\Drivers\MySQLLogger;
use Plenty\Logger\PlentyLogger;

class PlentyLoggerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('PlentyLogger', function ($app) {
            $config = $app['config']->get('plentylogger');
            $driverInstances = $this->initializeDrivers($app, $config);

            return new PlentyLogger($driverInstances);
        });
    }

    protected function initializeDrivers($app, array $config): array
    {
        $drivers = [];

        if (in_array('cli', $config['drivers'], true)) {
            $drivers['cli'] = new CLIOutputLoggerDriver();
        }

        if (in_array('file', $config['drivers'], true)) {
            $drivers['file'] = new FileLoggerDriver($config['file']['path']);
        }

        if (in_array('elk', $config['drivers'], true)) {
            $drivers['elk'] = new ElkLoggerDriver($config['elk']['client'], $config['elk']['index']);
        }

        if (in_array('mysql', $config['drivers'], true)) {
            $drivers['mysql'] = new MySQLLogger();
        }

        return $drivers;
    }
}
