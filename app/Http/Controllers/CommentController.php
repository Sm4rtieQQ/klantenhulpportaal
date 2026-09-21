<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use App\Mail\NewComment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $ticket = Ticket::Find($request->query('ticket_id'));

        Gate::authorize('view', $ticket);

        $comments = Comment::where('ticket_id', $ticket->id)->get();

        return CommentResource::collection($comments);
    }

    public function store(CommentRequest $request)
    {
        $ticket = Ticket::Find($request->input('ticket_id'));
        $user = Auth::user();

        Gate::authorize('view', $ticket);

        $comment = [
            'ticket_id' => $ticket->id,
            'created_by_id' => $user->id,
            'body' => $request->body,
        ];

        Mail::send(new NewComment($ticket->createdBy, $ticket));

        Comment::create($comment);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        Gate::authorize('edit', $comment);

        $newData = [
            'body' => $request->body,
        ];

        $comment->update($newData);
    }

    public function destroy(Comment $comment)
    {
        Gate::authorize('edit', $comment);

        $comment->delete();
        return response()->json(['message' => 'reactie verwijderd']);
    }
}
