<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShippingAddress
 *
 * @property int $id
 * @property string $contactName
 * @property string $mobile
 * @property string $addressCountry
 * @property string $addressProvince
 * @property string $addressCity
 * @property string $addressDetail
 * @property bool $isDefault
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $userId
 *
 * @property User $user
 *
 * @package App\Models
 */
class ShippingAddress extends Model
{

    protected $table = 'ShippingAddress';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'isDefault' => 'bool',
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
