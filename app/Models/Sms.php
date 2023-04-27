<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sms
 *
 * @property USER-DEFINED $scenario
 * @property string $code
 * @property string $content
 * @property string $mobile
 * @property string|null $rawResponse
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $userId
 *
 * @property User $user
 *
 * @package App\Models
 */
class Sms extends Model
{

    public $incrementing = false;
    protected $table = 'Sms';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'scenario' => 'USER-DEFINED',
        'rawResponse' => 'json',
        'userId' => 'int'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
