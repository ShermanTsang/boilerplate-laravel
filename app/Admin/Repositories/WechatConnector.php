<?php

namespace App\Admin\Repositories;

use App\Models\WechatConnector as WechatConnectorModel;
use Dcat\Admin\Repositories\EloquentRepository;

class WechatConnector extends EloquentRepository
{
    protected $eloquentClass = WechatConnectorModel::class;
}
