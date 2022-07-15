<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\CommonResource;

class ChatResource extends CommonResource
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
            'id'        => $this->id,
            'name'      => $this->name,
            'owner'     => OwnerResource::make($this->owner),
            'guarded'   => !!$this->password,
            'messages'  => MessageResource::collection($this->messages),
        ];
    }
}
