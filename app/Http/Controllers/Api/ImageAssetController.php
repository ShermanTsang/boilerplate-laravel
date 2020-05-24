<?php

namespace App\Http\Controllers\Api;

use App\ImageAsset;
use Illuminate\Routing\Controller;
use App\Http\Resources\ImageAsset as ConfigResource;


class ImageAssetController extends Controller
{

    public function index()
    {
        $imageAssetCollection = ConfigResource::collection(ImageAsset::get());
        return api_success($imageAssetCollection);
    }

    public function show($id)
    {
        $imageAssetItem = new ConfigResource(ImageAsset::query()->where('is_display', 1)->find($id));
        return api_success($imageAssetItem);
    }

}
