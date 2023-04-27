<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property int $id
 * @property string $email
 * @property string $mobile
 * @property string $password
 * @property string|null $name
 * @property Carbon|null $lastLoginAt
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection|Profile[] $profiles
 * @property Sms $sms
 * @property Collection|Cart[] $carts
 * @property Collection|Favorite[] $favorites
 * @property Collection|UnionOrder[] $union_orders
 * @property Collection|ExpressOrder[] $express_orders
 * @property Collection|ProxyPurchaseOrder[] $proxy_purchase_orders
 * @property Collection|EntrustPurchaseOrder[] $entrust_purchase_orders
 * @property Collection|Payment[] $payments
 * @property Collection|Comment[] $comments
 * @property Collection|Notify[] $notifies
 * @property Collection|ViewHistory[] $view_histories
 * @property Collection|ShippingAddress[] $shipping_addresses
 * @property Collection|WechatConnector[] $wechat_connectors
 *
 * @package App\Models
 */
class User extends Model
{

    protected $table = 'User';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $dates = [
        'lastLoginAt',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password'
    ];


    public function profile()
    {
        return $this->hasOne(Profile::class, 'userId');
    }

    public function smses()
    {
        return $this->hasMany(Sms::class, 'userId');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'userId');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'userId');
    }

    public function union_orders()
    {
        return $this->hasMany(UnionOrder::class, 'userId');
    }

    public function express_orders()
    {
        return $this->hasMany(ExpressOrder::class, 'userId');
    }

    public function proxy_purchase_orders()
    {
        return $this->hasMany(ProxyPurchaseOrder::class, 'userId');
    }

    public function entrust_purchase_orders()
    {
        return $this->hasMany(EntrustPurchaseOrder::class, 'userId');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'userId');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'userId');
    }

    public function notifies()
    {
        return $this->hasMany(Notify::class, 'userId');
    }

    public function view_histories()
    {
        return $this->hasMany(ViewHistory::class, 'userId');
    }

    public function shipping_addresses()
    {
        return $this->hasMany(ShippingAddress::class, 'userId');
    }

    public function wechat_connectors()
    {
        return $this->hasMany(WechatConnector::class, 'userId');
    }
}
