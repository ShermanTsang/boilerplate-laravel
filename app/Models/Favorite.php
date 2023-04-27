<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Favorite
 *
 * @property int $id
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
class Favorite extends Model
{

    protected $table = 'Favorite';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
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
}
