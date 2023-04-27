<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UnionOrder
 *
 * @property int $id
 * @property string $sn
 * @property USER-DEFINED $state
 * @property string|null $clientRemark
 * @property string|null $staffRemark
 * @property USER-DEFINED $type
 * @property float $totalFeeOfCny
 * @property float $exchangeRate
 * @property string $feeDetails
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int|null $staffId
 * @property int $userId
 * @property int|null $itemId
 *
 * @property Staff|null $staff
 * @property User $user
 * @property Item|null $item
 * @property Collection|ExpressOrder[] $express_orders
 * @property Collection|ProxyPurchaseOrder[] $proxy_purchase_orders
 * @property Collection|ProxyAuctionOrder[] $proxy_auction_orders
 * @property Collection|Payment[] $payments
 *
 * @package App\Models
 */
class UnionOrder extends Model
{

    protected $table = 'UnionOrder';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'state' => 'USER-DEFINED',
        'type' => 'USER-DEFINED',
        'totalFeeOfCny' => 'float',
        'exchangeRate' => 'float',
        'feeDetails' => 'json',
        'staffId' => 'int',
        'userId' => 'int',
        'itemId' => 'int'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'itemId');
    }

    public function express_orders()
    {
        return $this->hasMany(ExpressOrder::class, 'sn', 'sn');
    }

    public function proxy_purchase_orders()
    {
        return $this->hasMany(ProxyPurchaseOrder::class, 'sn', 'sn');
    }

    public function proxy_auction_orders()
    {
        return $this->hasMany(ProxyAuctionOrder::class, 'sn', 'sn');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'unionOrderSn', 'sn');
    }
}
