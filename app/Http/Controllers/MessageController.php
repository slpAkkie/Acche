<?php

namespace App\Http\Controllers;

use App\Http\Requests\Messages\StoreRequest;
use App\Http\Resources\Chat\MessageResource;
use App\Http\Resources\OkResource;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Returns messages for the chat as a collection
     * with maximum 25 elements at once.
     *
     * @param  Request  $request
     * @param  Chat  $message
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, Chat $chat): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return MessageResource::collection(
            $chat->messages()
                ->orderBy('created_at', 'DESC')
                ->paginate(25)
        );
    }

    /**
     * Handle request to create new message with provided data.
     *
     * @param  StoreRequest  $request
     * @param  Chat          $chat
     * @return OkResource
     */
    public function store(StoreRequest $request, Chat $chat): OkResource
    {
        (new Message([
            'content'       => $request->get('content'),
            'chat_id'       => $chat->id,
            'user_nickname' => Auth::id(),
        ]))->save();

        return OkResource::make();
    }

    /**
     * Update the specified message with provided data.
     *
     * @param  Request  $request
     * @param  Message  $message
     * @return void
     */
    public function update(Request $request, Message $message): void
    {
        //
    }

    /**
     * Remove the specified message from the chat.
     *
     * @param  Message  $message
     * @return void
     */
    public function destroy(Message $message): void
    {
        //
    }
}
