<?php

namespace App\Http\Controllers\Api;

use App\Configuration;
use Illuminate\Routing\Controller;
use App\Http\Resources\Configuration as ConfigResource;


class ConfigurationController extends Controller
{

    public function index()
    {
        $configurationCollection = ConfigResource::collection(Configuration::get());
        return api_success($configurationCollection);
    }

    public function show($id)
    {
        $configurationItem = new ConfigResource(Configuration::query()->where('is_display', 1)->find($id));
        return api_success($configurationItem);
    }

}
