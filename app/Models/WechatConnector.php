<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WechatConnector
 *
 * @property int $id
 * @property string|null $openId
 * @property string|null $unionId
 * @property string|null $sessionKey
 * @property Carbon $expiredAt
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $userId
 *
 * @property User $user
 *
 * @package App\Models
 */
class WechatConnector extends Model
{

    protected $table = 'WechatConnector';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'userId' => 'int'
    ];

    protected $dates = [
        'expiredAt',
        'created_at',
        'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
