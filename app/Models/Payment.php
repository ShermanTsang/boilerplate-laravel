<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @property int $id
 * @property USER-DEFINED $type
 * @property USER-DEFINED $channel
 * @property USER-DEFINED $state
 * @property string $name
 * @property float $channelPoundageOfCny
 * @property string $channelSn
 * @property float $totalFeeOfCny
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $userId
 * @property string $unionOrderSn
 *
 * @property User $user
 * @property UnionOrder $union_order
 *
 * @package App\Models
 */
class Payment extends Model
{

    protected $table = 'Payment';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'type' => 'USER-DEFINED',
        'channel' => 'USER-DEFINED',
        'state' => 'USER-DEFINED',
        'channelPoundageOfCny' => 'float',
        'totalFeeOfCny' => 'float',
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

    public function union_order()
    {
        return $this->belongsTo(UnionOrder::class, 'unionOrderSn', 'sn');
    }
}
