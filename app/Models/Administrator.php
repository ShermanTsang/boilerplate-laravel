<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Dcat\Admin\Models\Menu;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

/**
 * Class Administrator
 *
 * @property int $id
 * @property string $name
 * @property string|null $mobile
 * @property string|null $email
 * @property string $password
 * @property string $tags
 * @property string|null $rememberToken
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection|UnionOrder[] $union_orders
 * @property Collection|EntrustPurchaseOrder[] $entrust_purchase_orders
 *
 * @package App\Models
 */
class Administrator extends Model implements AuthenticatableContract
{

    use Authenticatable,
        HasPermissions,
        HasDateTimeFormatter;

    const DEFAULT_ID = 1;

    protected $table = 'Administrator';
    protected $dateFormat = 'Y-m-d h:i:sO';
    protected $casts = [
        'tags' => 'json'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password'
    ];


    public function __construct(array $attributes = [])
    {
        $this->init();

        parent::__construct($attributes);
    }

    protected function init()
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('admin.database.users_table'));
    }

    /**
     * Get avatar attribute.
     *
     * @return mixed|string
     */
    public function getAvatar()
    {
        $avatar = $this->avatar;

        if ($avatar) {
            if (!URL::isValidUrl($avatar)) {
                $avatar = Storage::disk(config('admin.upload.disk'))->url($avatar);
            }

            return $avatar;
        }

        return admin_asset(config('admin.default_avatar') ?: '@admin/images/default-avatar.jpg');
    }

    /**
     * A user has and belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        $pivotTable = config('admin.database.role_users_table');

        $relatedModel = config('admin.database.roles_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * 判断是否允许查看菜单.
     *
     * @param array|Menu $menu
     * @return bool
     */
    public function canSeeMenu($menu)
    {
        return true;
    }

    public function union_orders()
    {
        return $this->hasMany(UnionOrder::class, 'administratorId');
    }

    public function entrust_purchase_orders()
    {
        return $this->hasMany(EntrustPurchaseOrder::class, 'administratorId');
    }

}
