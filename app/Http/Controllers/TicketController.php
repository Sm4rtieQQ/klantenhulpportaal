<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $user = $request->created_by;

        Ticket::create([
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status,
            'created_by_id' => $user['id'],
            'assigned_to_id' => $request->assigned_to,
        ]);
    }
}
