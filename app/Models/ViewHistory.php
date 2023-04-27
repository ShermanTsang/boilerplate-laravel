<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ViewHistory
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $itemId
 * @property int $userId
 *
 * @property Item $item
 * @property User $user
 *
 * @package App\Models
 */
class ViewHistory extends Model
{

    protected $table = 'ViewHistory';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'itemId' => 'int',
        'userId' => 'int'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function item()
    {
        return $this->belongsTo(Item::class, 'itemId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
