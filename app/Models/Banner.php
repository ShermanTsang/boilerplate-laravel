<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Banner
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $image
 * @property bool $isValid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int|null $postId
 *
 * @property Post|null $post
 *
 * @package App\Models
 */
class Banner extends Model
{

    protected $table = 'Banner';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'isValid' => 'bool',
        'postId' => 'int'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'postId');
    }
}
