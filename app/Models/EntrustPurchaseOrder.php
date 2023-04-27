<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EntrustPurchaseOrder
 *
 * @property int $id
 * @property USER-DEFINED $state
 * @property string $memo
 * @property Carbon|null $startDatetime
 * @property Carbon|null $finishDatetime
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int|null $staffId
 * @property int $userId
 *
 * @property Staff|null $staff
 * @property User $user
 *
 * @package App\Models
 */
class EntrustPurchaseOrder extends Model
{

    protected $table = 'EntrustPurchaseOrder';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'state' => 'USER-DEFINED',
        'staffId' => 'int',
        'userId' => 'int'
    ];

    protected $dates = [
        'startDatetime',
        'finishDatetime',
        'created_at',
        'updated_at'
    ];


    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
