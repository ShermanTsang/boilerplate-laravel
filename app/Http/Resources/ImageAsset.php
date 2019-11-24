<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageAsset extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            // 'imageAssetItem' => parent::toArray($request),
            'id' => $this->id,
            'url' => $this->url,
            'name' => $this->name,
            'key' => $this->key,
            'description' => $this->description,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
