<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpressOrder
 *
 * @property int $id
 * @property float|null $globalExpressFee
 * @property float|null $serviceFeeOfCny
 * @property float|null $feeTotalOfCny
 * @property float $exchangeRate
 * @property string|null $expressSn
 * @property string|null $staffRemark
 * @property string $services
 * @property string $realShowImages
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $expressCompanyId
 * @property string $sn
 * @property int|null $userId
 *
 * @property ExpressCompany $express_company
 * @property UnionOrder $union_order
 * @property User|null $user
 * @property Collection|ProxyPurchaseOrder[] $proxy_purchase_orders
 *
 * @package App\Models
 */
class ExpressOrder extends Model
{

    protected $table = 'ExpressOrder';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'globalExpressFee' => 'float',
        'serviceFeeOfCny' => 'float',
        'feeTotalOfCny' => 'float',
        'exchangeRate' => 'float',
        'services' => 'json',
        'realShowImages' => 'json',
        'expressCompanyId' => 'int',
        'userId' => 'int'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function express_company()
    {
        return $this->belongsTo(ExpressCompany::class, 'expressCompanyId');
    }

    public function union_order()
    {
        return $this->belongsTo(UnionOrder::class, 'sn', 'sn');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function proxy_purchase_orders()
    {
        return $this->hasMany(ProxyPurchaseOrder::class, 'expressOrderId');
    }
}
