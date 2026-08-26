<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::get());
    }

    public function getCommentsByTicketId(int $ticketId)
    {
        $comments = Comment::where('ticket_id', $ticketId)->get();
        return CommentResource::collection($comments);
    }
}
