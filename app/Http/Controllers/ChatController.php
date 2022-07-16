<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chat\StoreRequest;
use App\Http\Requests\Request;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Exceptions\ValidationFailedResource;
use App\Http\Resources\OkResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ChatController extends Controller
{
    /**
     * Returns chats for authorized user as a collection
     * with maximum 10 elements at once.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        /** @var User */
        $user = Auth::user();

        return ChatResource::collection(
            $user->chats()->where('name', 'like', '%' . $request->get('query', '') . '%')
                ->orderBy('updated_at', 'DESC')
                ->paginate(10)
        );
    }

    /**
     * Display a page for create new chat.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Chat/Create');
    }

    /**
     * Display a page for join into a chat.
     *
     * @return Response
     */
    public function join(): Response
    {
        return Inertia::render('Chat/Join');
    }

    /**
     * Handle request to allow access to the chat with provided data.
     *
     * @param  StoreRequest  $request
     * @param  Chat          $chat
     * @return OkResource
     */
    public function allowAccess(Request $request, Chat $chat)
    {
        $chat = Chat::find((int)$request->get('id'));

        if (!$chat || !$chat->checkPassword($request->get('password') || '')) {
            return ValidationFailedResource::make([
                'id' => 'Такого чата нет или пароль указан не верно',
            ]);
        }

        $chat->participants()->syncWithoutDetaching(Auth::id());

        return ChatResource::make($chat);
    }

    /**
     * Handle request to create new chat with provided data.
     *
     * @param  StoreRequest  $request
     * @return OkResource
     */
    public function store(StoreRequest $request): OkResource
    {
        // Create chat model
        $chat = new Chat([
            'name' => $request->get('name'),
            'user_nickname' => Auth::id(),
            'password' => $request->get('password') || null,
        ]);

        // Save model to the database
        // and create new participant records
        // about authorized user.
        $chat->save();
        $chat->participants()->attach(Auth::id());

        return OkResource::make();
    }

    /**
     * Display a page about chat.
     *
     * @param  Request  $request
     * @param  Chat     $chat
     * @return Response
     */
    public function show(Request $request, Chat $chat): Response
    {
        return Inertia::render('Chat/Show', [
            'chat' => ChatResource::make($chat)->toArray($request),
        ]);
    }

    /**
     * Display a page for editing the chat.
     *
     * @param  Chat  $chat
     * @return void
     */
    public function edit(Chat $chat): void
    {
        //
    }

    /**
     * Update the specified chat with provided data.
     *
     * @param  Request  $request
     * @param  Chat     $chat
     * @return void
     */
    public function update(Request $request, Chat $chat): void
    {
        //
    }

    /**
     * Remove the specified chat from the database.
     *
     * @param  Chat  $chat
     * @return void
     */
    public function destroy(Chat $chat): void
    {
        //
    }
}
