<?php

namespace Plenty\Logger\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property Carbon $timestamp
 * @property string $level
 * @property string $message
 * @property array|null $attributes
 * @property string $trace_id
 * @method static Builder|Logs newModelQuery()
 * @method static Builder|Logs newQuery()
 * @method static Builder|Logs query()
 * @method static Builder|Logs where($value)
 * @method static Builder|Logs whereId($value)
 * @method static Builder|Logs whereTimestamp($value)
 * @method static Builder|Logs whereLevel($value)
 * @method static Builder|Logs whereMessage($value)
 * @method static Builder|Logs whereContext($value)
 * @method static Builder|Logs whereAttributes($value)
 * @method static Builder|Logs create(array $attributes = [])
 * @method static Builder|Logs find($id, $columns = ['*'])
 * @method static Builder|Logs truncate()
 */
class Logs extends Model
{
    protected $table = 'logs';
    protected $fillable = [
        'level',
        'message',
        'attributes',
        'trace_id',
        'created_at',
    ];
    public $timestamps = false;
    protected $casts = [
        'attributes' => 'array',
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Carbon
     */
    public function getTimestamp(): Carbon
    {
        return $this->timestamp;
    }

    /**
     * @param Carbon $timestamp
     */
    public function setTimestamp(Carbon $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return array|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @param array|null $attributes
     */
    public function setAttributes(?array $attributes): void
    {
        $this->attributes = $attributes;
    }
}
