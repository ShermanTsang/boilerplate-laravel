<?php

namespace App\Http\Controllers;

use App\Page;

class PageController extends Controller
{

    public function item($link)
    {
        $page = Page::where('display',1)->where('link', $link)->first();
        return view('page.show', compact('page'));
    }

}
