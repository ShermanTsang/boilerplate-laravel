<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProxyAuctionOrder
 *
 * @property int $id
 * @property float|null $bid
 * @property float|null $sitePoundageFeeOfCny
 * @property float|null $serviceFeeOfCny
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $sn
 *
 * @property UnionOrder $union_order
 *
 * @package App\Models
 */
class ProxyAuctionOrder extends Model
{

    protected $table = 'ProxyAuctionOrder';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'bid' => 'float',
        'sitePoundageFeeOfCny' => 'float',
        'serviceFeeOfCny' => 'float'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function union_order()
    {
        return $this->belongsTo(UnionOrder::class, 'sn', 'sn');
    }
}
