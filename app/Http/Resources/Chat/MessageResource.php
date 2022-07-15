<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\CommonResource;

class MessageResource extends CommonResource
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
            'author' => OwnerResource::make($this->author),
            'content' => $this->content,
        ];
    }
}
