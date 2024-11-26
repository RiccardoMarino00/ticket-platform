@extends('layouts.app')
@section('content')
    <div>Ticket</div>
    <a href="{{ route('tickets.create') }}">Crea</a>
    @foreach ($tickets as $ticket)
        <p>{{ $ticket->title }}</p>
        <p>{{ $ticket->description }}</p>
    @endforeach
@endsection
