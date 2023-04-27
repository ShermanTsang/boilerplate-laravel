<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Advertise
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $position
 * @property bool $isValid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Advertise extends Model
{

    protected $table = 'Advertise';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'isValid' => 'bool'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}

