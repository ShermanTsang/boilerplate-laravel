<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpressCompany
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $instructionImages
 *
 * @property Collection|ExpressOrder[] $express_orders
 *
 * @package App\Models
 */
class ExpressCompany extends Model
{

    protected $table = 'ExpressCompany';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'instructionImages' => 'json'
    ];


    public function express_orders()
    {
        return $this->hasMany(ExpressOrder::class, 'expressCompanyId');
    }
}
