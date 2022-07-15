<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Returns messages for the chat as a collection
     * with maximum 25 elements at once.
     *
     * @param  Request  $request
     * @param  Message  $message
     * @return void
     */
    public function index(Request $request, Message $message): void
    {
        //
    }

    /**
     * Handle request to create new message with provided data.
     *
     * @param  Request  $request
     * @return void
     */
    public function store(Request $request): void
    {
        //
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
