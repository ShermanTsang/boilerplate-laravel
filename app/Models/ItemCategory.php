<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemCategory
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $featureImage
 * @property bool $isValid
 * @property bool $isHot
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $channelId
 *
 * @property Channel $channel
 * @property Collection|Item[] $items
 *
 * @package App\Models
 */
class ItemCategory extends Model
{

    protected $table = 'ItemCategory';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'isValid' => 'bool',
        'isHot' => 'bool',
        'channelId' => 'int'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channelId');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'categoryId');
    }
}
