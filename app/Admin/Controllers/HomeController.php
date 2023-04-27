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
//            ['name' => '文档概述', 'url' => '', 'isActive' => true],
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
