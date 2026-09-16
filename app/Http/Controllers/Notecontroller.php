<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Notecontroller extends Controller
{
    public function index(Request $request)
    {
        $ticket = Ticket::Find($request->query('ticket_id'));

        Gate::authorize('view', $ticket);

        $notes = Note::where('ticket_id', $ticket->id)->get();

        return NoteResource::collection($notes);
    }

    public function store(NoteRequest $request)
    {
        $ticket = Ticket::Find($request->input('ticket_id'));
        $user = Auth::user();

        $note = [
            'ticket_id' => $ticket->id,
            'created_by_id' => $user->id,
            'body' => $request->body,
        ];

        Note::create($note);
    }

    public function update(NoteRequest $request, Note $note)
    {
        Gate::authorize('edit', $note);

        $newData = [
            'body' => $request->body,
        ];

        $note->update($newData);
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return response()->json(['message => notitie verwijderd']);
    }
}
