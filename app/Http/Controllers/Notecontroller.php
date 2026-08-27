<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class Notecontroller extends Controller
{
    public function index(Request $request)
    {
        $query = Note::query();

        foreach ($request->query() as $field => $value) {
            $query->where($field, $value);
        }

        return NoteResource::collection($query->get());
    }
}
