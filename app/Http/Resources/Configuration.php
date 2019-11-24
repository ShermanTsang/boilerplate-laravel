<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Configuration extends JsonResource
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
            // 'configurationItem' => parent::toArray($request),
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->value,
            'description' => $this->description,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
