<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $coverImage
 * @property string|null $content
 * @property string $detailImages
 * @property USER-DEFINED|null $tradeState
 * @property USER-DEFINED|null $qualityState
 * @property bool $isValid
 * @property float|null $price
 * @property USER-DEFINED $currencyUnit
 * @property float|null $discountPrice
 * @property string $tags
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $categoryId
 *
 * @property ItemCategory $item_category
 * @property Collection|Scrapper[] $scrappers
 * @property Collection|Cart[] $carts
 * @property Collection|Favorite[] $favorites
 * @property Collection|UnionOrder[] $union_orders
 * @property Collection|Comment[] $comments
 * @property Collection|ViewHistory[] $view_histories
 *
 * @package App\Models
 */
class Item extends Model
{

    public static $tradeState = [
        'ON_SALE' => '售卖中',
        'SOLD' => '已售罄',
        'INVALID' => '无效',
    ];
    public static $qualityState = [
        'WHOLE_NEW' => '全新',
        'SECOND_HAND' => '二手',
        'UNKNOWN' => '未知',
    ];
    public static $currencyUnit = [
        'CNY' => '人民币',
        'JPY' => '日元',
        'USD' => '美元',
    ];

    protected $table = 'Item';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'detailImages' => 'json',
        'isValid' => 'bool',
        'price' => 'float',
        'discountPrice' => 'float',
        'tags' => 'json',
        'categoryId' => 'int'
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function item_category()
    {
        return $this->belongsTo(ItemCategory::class, 'categoryId');
    }

    public function scrapper()
    {
        return $this->morphOne(Scrapper::class, 'scrapperable', 'targetType', 'targetId');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'scrapperable', 'targetType', 'targetId');
    }

    public function auction()
    {
        return $this->hasOne(Auction::class, 'id', 'auctionId');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'itemId');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'itemId');
    }

    public function union_orders()
    {
        return $this->hasMany(UnionOrder::class, 'itemId');
    }

    public function view_histories()
    {
        return $this->hasMany(ViewHistory::class, 'itemId');
    }

    public function extras(): Attribute
    {
        return new Attribute(
            get: fn($value) => array_values(json_decode($value, true) ?: []),
            set: fn($value) => json_encode(array_values($value)),
        );
    }

}
