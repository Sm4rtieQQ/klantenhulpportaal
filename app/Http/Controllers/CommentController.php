<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function index(request $request)
    {
        $comments = \App\Models\Comment::query();

        foreach ($request->query() as $field => $value) {
            $comments->where($field, $value);
        }

        return CommentResource::collection($comments->get());
    }
}
