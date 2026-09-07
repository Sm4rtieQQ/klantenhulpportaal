<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $ticket = Ticket::findOrFail($request->query('ticket_id'));

        Gate::authorize('view', $ticket);

        $comments = Comment::where('ticket_id', $ticket->id)->get();

        return CommentResource::collection($comments);
    }

    public function store(CommentRequest $request)
    {
        $ticket = Ticket::findOrFail($request->input('ticket_id'));
        $user = Auth::user();

        Gate::authorize('view', $ticket);

        $comment = [
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'body' => $request->comment,
        ];

        Comment::create($comment);
    }
}
