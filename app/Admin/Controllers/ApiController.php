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

    public static function getItemOptions(Request $request)
    {
        $keyword = $request->get('q');
        if (empty($keyword)) {
            return ['data' => []];
        }
        if ($keyword) {
            $result = Item::query()
                ->select(DB::raw("*, concat(name,' [ 编号', id ,' | 名称',name,' ]') as text"))
                ->where('name', 'like', "%{$keyword}%")
                ->orWhere('id', '=', $keyword)
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

    public static function getItemCategoryOptions(Request $request)
    {
        $keyword = $request->get('q');
        if (empty($keyword)) {
            return ['data' => []];
        }
        if ($keyword) {
            $result = DB::table('ItemCategory')
                ->select(DB::raw('"ItemCategory"."id" as id,concat (\' [ 渠道: \', "Channel"."name", \' ] \', "ItemCategory"."channelId" ) AS text'))
                ->leftJoin('Channel', 'ItemCategory.channelId', '=', 'Channel.id')
                ->where('ItemCategory.name', 'like', "%{$keyword}%")
                ->paginate(20, ['id as id', 'name as text']);
            return $result;
        }
    }

    public static function getChannelOptions(Request $request)
    {
        $keyword = $request->get('q');
        if (empty($keyword)) {
            return ['data' => []];
        }
        if ($keyword) {
            $result = Channel::query()
                ->select(DB::raw("*, concat(name, ' [ 编号', id ,' ]') as text"))
                ->where('name', 'like', "%{$keyword}%")
                ->where('isValid', '=', 1)
                ->paginate(null, ['id as id', 'name as text']);
            return $result;
        }
    }

}
