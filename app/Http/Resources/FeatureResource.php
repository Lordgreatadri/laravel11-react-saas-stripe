<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    public static $wrap = false;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "route_name" => $this->route_name,
            "active" => $this->active,
            "required_credits" => $this->required_credits,
            "image" => $this->image ?: null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            // "features" => FeatureResource::collection($this->whenLoaded('features')),
        ];
    }
}
