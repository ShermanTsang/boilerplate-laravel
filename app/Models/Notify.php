<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notify
 *
 * @property int $id
 * @property string $subject
 * @property ARRAY|null $images
 * @property string $content
 * @property Carbon $readAt
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $userId
 *
 * @property User $user
 *
 * @package App\Models
 */
class Notify extends Model
{

    protected $table = 'Notify';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'images' => 'json',
        'userId' => 'int'
    ];

    protected $dates = [
        'readAt',
        'created_at',
        'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
