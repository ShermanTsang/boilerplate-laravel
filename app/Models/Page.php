<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 *
 * @property int $id
 * @property string $name
 * @property string $sign
 * @property string $type
 * @property string|null $cover_image
 * @property bool $is_enabled
 * @property string|null $external_url
 * @property string|null $content
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Page extends Model
{
    protected $table = 'pages';
    protected $dateFormat = 'Y-m-d h:i:sO';
    
    protected $casts = [
        'is_enabled' => 'bool'
    ];

    protected $fillable = [
        'name',
        'sign',
        'type',
        'cover_image',
        'is_enabled',
        'external_url',
        'content',
        'description'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}