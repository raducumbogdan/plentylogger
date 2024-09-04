<?php

require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

// Set up Eloquent
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

Capsule::schema()->create('logs', function (Blueprint $table) {
    $table->id();
    $table->string('level');
    $table->text('message');
    $table->json('attributes')->nullable();
    $table->string('trace_id')->nullable();
    $table->timestamps();
});

echo "Table 'logs' created successfully.\n";
