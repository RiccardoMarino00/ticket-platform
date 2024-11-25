<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Category;
use App\Models\Operator;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index()
    {
        $tickets = Ticket::with('operator', 'category')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        $operators = Operator::all();
        return view('tickets.create', compact('categories', 'operators'));
    }

    public function store(StoreTicketRequest $request)
    {
        $form_data = $request->validated();
        $new_ticket = Ticket::create($form_data);
        return redirect()->route('tickets.index', $new_ticket)->with('success', 'Ticket creato con successo!');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $categories = Category::all();
        $operators = Operator::all();
        return view('tickets.edit', compact('ticket', 'categories', 'operators'));
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $form_data = $request->validated();
        $ticket->update($form_data);
        return redirect()->route('tickets.index')->with('success', 'Ticket aggiornato!');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket eliminato');
    }
}
