<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Auction
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $coverImage
 * @property string|null $detailImages
 * @property string $tags
 * @property Carbon $startAt
 * @property Carbon $endAt
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $channelId
 *
 * @property Channel $channel
 *
 * @package App\Models
 */
class Auction extends Model
{

    protected $table = 'Auction';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'detailImages' => 'json',
        'tags' => 'json',
        'channelId' => 'int'
    ];

    protected $dates = [
        'startAt',
        'endAt',
        'created_at',
        'updated_at'
    ];


    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channelId');
    }

    public function scrapper()
    {
        return $this->morphOne(Scrapper::class, 'scrapperable', 'targetType', 'targetId');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'auctionId');
    }

    public function extras(): Attribute
    {
        return new Attribute(
            get: fn($value) => array_values(json_decode($value, true) ?: []),
            set: fn($value) => json_encode(array_values($value)),
        );
    }

}
