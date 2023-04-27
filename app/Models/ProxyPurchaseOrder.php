<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProxyPurchaseOrder
 *
 * @property int $id
 * @property float|null $totalFeeOfCny
 * @property float|null $sitePoundageFeeOfCny
 * @property float|null $serviceFeeOfCny
 * @property float $exchangeRate
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int|null $expressOrderId
 * @property string $sn
 * @property int|null $userId
 *
 * @property ExpressOrder|null $express_order
 * @property UnionOrder $union_order
 * @property User|null $user
 *
 * @package App\Models
 */
class ProxyPurchaseOrder extends Model
{

    protected $table = 'ProxyPurchaseOrder';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'totalFeeOfCny' => 'float',
        'sitePoundageFeeOfCny' => 'float',
        'serviceFeeOfCny' => 'float',
        'exchangeRate' => 'float',
        'expressOrderId' => 'int',
        'userId' => 'int'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function express_order()
    {
        return $this->belongsTo(ExpressOrder::class, 'expressOrderId');
    }

    public function union_order()
    {
        return $this->belongsTo(UnionOrder::class, 'sn', 'sn');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
