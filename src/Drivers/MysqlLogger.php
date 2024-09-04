<?php

namespace Plenty\Logger\Drivers;

use DateTime;
use Plenty\Logger\Models\Logs;

class MysqlLogger extends AbstractLoggerDriver
{
    public function log(
        string $level,
        string $message,
        array $attributes = [],
        ?string $traceId = null
    ): void {
        Logs::create([
            'level' => $level,
            'message' => $message,
            'attributes' => json_encode($attributes),
            'trace_id' => $traceId,
            'created_at' => new DateTime(),
        ]);
    }
}
