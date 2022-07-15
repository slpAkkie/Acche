<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\CommonResource;

class OwnerResource extends CommonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    {
        return [
            'nickname'  => $this->nickname,
            'name'      => $this->name,
        ];
    }
}
