<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 *
 * @property int $id
 * @property string|null $bio
 * @property USER-DEFINED $gender
 * @property string|null $avatarImage
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $userId
 *
 * @property User $user
 *
 * @package App\Models
 */
class Profile extends Model
{

    static array $Gender = [
        'MALE' => '男',
        'FEMALE' => '女',
        'UNKNOWN' => '-'
    ];
    protected $table = 'Profile';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'userId' => 'int'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
