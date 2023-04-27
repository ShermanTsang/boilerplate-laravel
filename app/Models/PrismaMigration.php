<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrismaMigration
 *
 * @property string $id
 * @property string $checksum
 * @property Carbon|null $finished_at
 * @property string $migration_name
 * @property string|null $logs
 * @property Carbon|null $rolled_back_at
 * @property Carbon $started_at
 * @property int $applied_steps_count
 *
 * @package App\Models
 */
class PrismaMigration extends Model
{

    public $incrementing = false;
    protected $table = '_prisma_migrations';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'applied_steps_count' => 'int'
    ];

    protected $dates = [
        'finished_at',
        'rolled_back_at',
        'started_at'
    ];

}
