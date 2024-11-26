@extends('layouts.app')
@section('content')
    <div>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div>
        <h2>New Ticket</h2>
        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}" required> --}}
            <label for="title">title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>

            <label for="description">Des</label>
            <input type="text" name="description" id="description" value="{{ old('description') }}" required>

            <label for="category_id">Categoria:</label>
            <select name="category_id" id="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>

            <button id="submit-btn">Crea</button>

            @foreach ($operators as $operator)
                <p>{{ $operator->name }}</p>
            @endforeach
        </form>
    </div>
@endsection
