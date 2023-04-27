<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $content
 * @property int|null $order
 * @property bool $isFeatured
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $categoryId
 *
 * @property PostCategory $post_category
 * @property Collection|Banner[] $banners
 *
 * @package App\Models
 */
class Post extends Model
{

    protected $table = 'Post';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'order' => 'int',
        'isFeatured' => 'bool',
        'categoryId' => 'int'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'categoryId');
    }

    public function banners()
    {
        return $this->hasMany(Banner::class, 'postId');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'scrapperable', 'targetType', 'targetId');
    }
}
