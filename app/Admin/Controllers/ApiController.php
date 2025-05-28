<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Item;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public static function getUserOptions(Request $request)
    {
        $keyword = $request->get('q');
        if (empty($keyword)) {
            return ['data' => []];
        }
        if ($keyword) {
            $result = User::query()
                ->select(DB::raw("*, concat(name,' [ 编号', id ,' | 手机',mobile,' ]') as text"))
                ->where('name', 'like', "%{$keyword}%")
                ->orWhere('mobile', 'like', "%{$keyword}%")
                ->paginate(null, ['id as id', 'name as text']);
            return $result;
        }
    }

    public static function getPostCategoryOptions(Request $request)
    {
        $keyword = $request->get('q');
        if (empty($keyword)) {
            return ['data' => []];
        }
        if ($keyword) {
            $result = PostCategory::query()
                ->select(DB::raw("*, concat(\"name\",' [ 编号', id ,' ]') as text"))
                ->where('name', 'like', "%{$keyword}%")
                ->paginate(null, ['id as id', 'name as text']);
            return $result;
        }
    }

}
