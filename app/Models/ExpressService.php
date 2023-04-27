<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpressService
 *
 * @property int $id
 * @property string $name
 * @property float|null $price
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class ExpressService extends Model
{

    protected $table = 'ExpressService';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'price' => 'float'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}
