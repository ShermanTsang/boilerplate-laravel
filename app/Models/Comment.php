<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Comment
 *
 * @property int $id
 * @property string $text
 * @property string $images
 * @property bool $isRecommended
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $userId
 * @property int $itemId
 *
 * @property User $user
 * @property Item $item
 *
 * @package App\Models
 */
class Comment extends Model
{

    public static $targetTypeOptions = [
        'Item' => '藏品',
        'Post' => '内容',
    ];
    protected $table = 'Comment';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'images' => 'json',
        'isRecommended' => 'bool',
        'userId' => 'int',
        'itemId' => 'int'
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'itemId');
    }

    public function commentable()
    {
        return $this->morphTo(__FUNCTION__, 'targetType', 'targetId');
    }

    public function targetType(): Attribute
    {
        $laravelMorphPrefix = 'App\\Models\\';
        return new Attribute(
            get: fn($value) => $value,
            set: fn($value) => Str::startsWith($value, $laravelMorphPrefix)
                ? $value
                : ($laravelMorphPrefix . Str::ucfirst($value)),
        );
    }

}
