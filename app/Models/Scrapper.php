<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Scrapper
 *
 * @property int $id
 * @property string|null $rawData
 * @property string|null $sourceUrl
 * @property Carbon|null $sourceSyncAt
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $itemId
 *
 * @property Item $item
 *
 * @package App\Models
 */
class Scrapper extends Model
{

    public static $targetTypeOptions = [
        'Item' => '藏品',
        'Auction' => '拍卖会',
    ];
    protected $table = 'Scrapper';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'itemId' => 'int'
    ];
    protected $dates = [
        'sourceSyncAt',
        'created_at',
        'updated_at'
    ];

    public function scrapperable()
    {
        return $this->morphTo(__FUNCTION__, 'targetType', 'targetId');
    }

}
