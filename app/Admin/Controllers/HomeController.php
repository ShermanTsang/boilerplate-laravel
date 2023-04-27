<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Widgets\Tab;

class HomeController extends Controller
{

    public function index(Content $content)
    {
        $tab = Tab::make();
        $docs = [
            ['name' => '文档概述', 'url' => 'https://www.yuque.com/shareman/tgtsea/la8q9vi1og40ngp8?singleDoc#', 'isActive' => true],
            ['name' => '功能需求', 'url' => 'https://www.yuque.com/shareman/tgtsea/sabf7labfc1l28t2?singleDoc#', 'isActive' => false],
            ['name' => '项目架构', 'url' => 'https://www.yuque.com/shareman/tgtsea/st5t076xgveygu9o?singleDoc#', 'isActive' => false],
            ['name' => '教程文档', 'url' => 'https://www.yuque.com/shareman/tgtsea/fgpg8ts9gw4rol0a?singleDoc#', 'isActive' => false],
        ];
        foreach ($docs as $doc) {
            $tab->add($doc['name'], view('iframe', ['name' => $doc['name'], 'url' => $doc['url']]), $doc['isActive']);
        }

        return $content
            ->header(config('admin.name'))
            ->description('')
            ->body($tab);
    }
}
