<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\CommonResource;
use Illuminate\Support\Facades\Auth;

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
            'id' => $this->id,
            'author' => OwnerResource::make($this->author),
            'content' => $this->content,
            'owner' => $this->user_nickname === Auth::id(),
            'sent_at' => $this->sent_at,
        ];
    }
}
