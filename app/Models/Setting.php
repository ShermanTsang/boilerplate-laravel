<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string|null $description
 * @property string $value
 * @property USER-DEFINED $type
 * @property bool|null $isEditable
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
enum TypeEnum: string
{
    case TEXT = 'TEXT';
    case IMAGE_URL = 'IMAGE_URL';
    case FILE_URL = 'FILE_URL';
    case BOOLEAN = 'BOOLEAN';
}

class Setting extends Model
{
    static array $TypeEnum = [
        'TEXT' => '文本',
        'IMAGE_URL' => '图片地址',
        'FILE_URL' => '文件地址',
        'BOOLEAN' => '布尔值（开关）',
    ];
    protected $table = 'Setting';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'isEditable' => 'bool'
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
