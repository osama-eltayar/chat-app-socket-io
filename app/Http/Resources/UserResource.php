<?php

namespace App\Http\Resources;

use App\Http\Resources\UserTypeResource;
use App\Models\CategoryRestrictedToUserType;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'phone' => $this->phone,
            'name' => $this->name
        ];
    }
}
