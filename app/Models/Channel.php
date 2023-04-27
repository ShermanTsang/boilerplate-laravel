<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Channel
 *
 * @property int $id
 * @property USER-DEFINED $channelType
 * @property USER-DEFINED $tradeType
 * @property string|null $siteUrl
 * @property string $name
 * @property string|null $description
 * @property string|null $logoImage
 * @property string|null $themeColor
 * @property bool $isValid
 * @property string|null $instructionContent
 * @property string|null $expressContent
 * @property string|null $expenseContent
 * @property string|null $flowContent
 * @property string|null $termContent
 * @property string|null $businessContent
 * @property bool $enableSearch
 * @property USER-DEFINED $poundageType
 * @property float|null $poundageValueOfJpy
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection|ItemCategory[] $item_categories
 * @property Collection|Auction[] $auctions
 *
 * @package App\Models
 */
class Channel extends Model
{

    public static $channelType = [
        'TARGET_WEBSITE' => '目标站点',
        'LUXURY' => '奢侈品站点',
    ];

    public static $tradeType = [
//        'EXPRESS_COMBINATION' => '物流合单',
        'PROXY_PURCHASE' => '代购（代切）',
        'PROXY_AUCTION' => '代拍（拍卖）',
        'SELFRUN' => '自销（自营）',
//        'ENTRUST_PURCHASE' => '委托购买',
    ];

    public static $poundageType = [
        'FIXED' => '固定金额',
        'PERCENTAGE' => '比例金额',
    ];

    protected $table = 'Channel';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'isValid' => 'bool',
        'enableSearch' => 'bool',
        'poundageValueOfJpy' => 'float',
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function item_categories()
    {
        return $this->hasMany(ItemCategory::class, 'channelId');
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class, 'channelId');
    }

}
