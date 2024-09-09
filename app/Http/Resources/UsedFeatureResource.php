<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\FeatureResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UsedFeatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'credits' => $this->credits,
            'result' =>$this->result,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'feature' => new FeatureResource($this->feature),
            'data' => $this->data, // For storing custom data in the resource, like an array of results.
        ];
    }
}
