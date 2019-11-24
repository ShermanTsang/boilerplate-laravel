<?php

namespace App\Http\Controllers\Api;

use App\FileAsset;
use Illuminate\Routing\Controller;
use App\Http\Resources\FileAsset as ConfigResource;


class FileAssetController extends Controller
{

    public function index()
    {
        $fileAssetCollection = ConfigResource::collection(FileAsset::get());
        return api_success($fileAssetCollection);
    }

    public function show($id)
    {
        $fileAssetItem = new ConfigResource(FileAsset::where('is_display', 1)->find($id));
        return api_success($fileAssetItem);
    }

}
