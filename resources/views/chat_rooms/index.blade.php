@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Chat Rooms</h1>

        <ul>
            @foreach($chatRooms as $chatRoom)
                <li><a href="{{ route('chat.show', $chatRoom->id) }}">{{ $chatRoom->name }}</a></li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('chat.create') }}">
            @csrf
            <label for="room-name">Create a new chat room:</label>
            <input type="text" id="room-name" name="name" required>
            <button type="submit">Create</button>
        </form>
    </div>
@endsection
