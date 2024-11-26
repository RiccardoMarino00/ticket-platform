<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Category;
use App\Models\Operator;
use App\Models\Ticket;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index()
    {
        $tickets = Ticket::with('operator', 'category')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        $operators = Operator::where('is_available', true)->get();
        // if (!$operator) {
        //     return back()->withErrors('Nessun operatore disponibile');
        // }

        // $ticket = new Ticket();
        // $ticket->title = $request->input('title');
        // $ticket->description = $request->input('description');
        // $ticket->operator_id = $operator->id;
        // $ticket->save();

        // $operator->is_available = false;
        // $operator->save();

        return view('tickets.create', compact('categories', 'operators'))->with('success', 'Ticket creato con successo.');
    }

    public function store(StoreTicketRequest $request)
    {
        $form_data = $request->validated();

        $operator = Operator::where('is_available', true)->orderBy('id')->first();
        if (!$operator) {
            return back()->withErrors('Nessun operatore disponibile');
        }

        $ticket = new Ticket();
        $ticket->title = $request->input('title');
        $ticket->description = $request->input('description');
        $ticket->operator_id = $operator->id;
        $ticket->category_id = $request->input('category_id');
        $ticket->user_id = Auth::id();
        if ($operator) {
            $ticket->status = 'Assegnato';
        }
        $ticket->save();

        $operator->is_available = false;
        $operator->save();
        // $new_ticket = Ticket::create($form_data);
        return redirect()->route('tickets.index', $ticket)->with('success', 'Ticket creato con successo!');
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
