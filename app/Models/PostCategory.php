<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PostCategory
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $coverImage
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection|Post[] $posts
 *
 * @package App\Models
 */
class PostCategory extends Model
{

    protected $table = 'PostCategory';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function posts()
    {
        return $this->hasMany(Post::class, 'categoryId');
    }
}
