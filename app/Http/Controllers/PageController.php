<?php

namespace App\Http\Controllers;

use App\Page;

class PageController extends Controller
{

    public function item($name)
    {
        $page = Page::query()->where('isDisplay', 1)->where('name', $name)->first();
        if ($page) {
            return view('page.show', compact('page'));
        } else {
            return redirect('/');
        }
    }

}
