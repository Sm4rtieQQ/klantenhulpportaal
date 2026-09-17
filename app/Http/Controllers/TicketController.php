<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->admin) return TicketResource::collection(Ticket::get());

        return TicketResource::collection(
            Ticket::where('created_by_id', $user->id)->get()
        );
    }

    public function store(TicketRequest $request)
    {
        $userId = $request->created_by_id;
        $user = Auth::user();

        $ticketData = [
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status,
            'created_by_id' => $userId,
            'assigned_to_id' => $request->assigned_to_id,
        ];

        $categories = $request->categories;

        if ($user->admin) {
            $ticketData = [
                ...$ticketData,
                'assigned_to_id' => $request->assigned_to_id,
                'status' => $request->status,
            ];
        };

        $ticket = Ticket::create($ticketData);
        $ticket->categories()->attach($categories);
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        Gate::authorize('view', $ticket);
        $user = Auth::user();
        $categories = $request->categories;

        $newData = [
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status,
        ];

        if ($user->admin) {
            $newData = [
                ...$newData,
                'assigned_to_id' => $request->assigned_to_id,
                'status' => $request->status,
            ];
        }

        $ticket->update($newData);
        $ticket->categories()->sync($categories);
    }
}
