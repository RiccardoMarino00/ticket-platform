<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $form_data = $request->validate([
            'title' => 'required|string|max:255', // Cambia i campi in base alla tua tabella
            'description' => 'required|string',
            'operator_id' => 'required|exists:operators,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:open,closed,in-progress', // Enum specifico
        ]);
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

    public function update(Request $request, Ticket $ticket)
    {
        $form_data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'operator_id' => 'required|exists:operators,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:open,closed,in-progress',
        ]);
        $ticket->update($form_data);
        return redirect()->route('tickets.index')->with('success', 'Ticket aggiornato!');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket eliminato');
    }
}
