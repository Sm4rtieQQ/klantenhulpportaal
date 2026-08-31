<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Notecontroller extends Controller
{
    public function index(Request $request)
    {
        $ticket = Ticket::findOrFail($request->query('ticket_id'));

        Gate::authorize('view', $ticket);

        $notes = Note::where('ticket_id', $ticket->id)->get();

        return NoteResource::collection($notes);
    }
}
