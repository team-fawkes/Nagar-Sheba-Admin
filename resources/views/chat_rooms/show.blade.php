@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Chat Room: {{ $chatRoom->name }}</h1>

        <div id="chat">
            @foreach($messages as $message)
                <div class="message">
                    <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
                </div>
            @endforeach
        </div>

        <form id="chat-form" method="post" action="{{route('chat.message.send')}}">
            @csrf
            <input type="text" id="message" placeholder="Type a message..." required>
            <button type="submit">Send</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        var chatRoomId = {{ $chatRoom->id }};
        $(document).ready(function () {
            // Function to load chat messages
            function loadMessages() {
                $.ajax({
                    url: '/chat/' + chatRoomId + '/messages',
                    method: 'GET',
                    success: function (data) {
                        $('#chat').html(data);
                    },
                });
            }

            // Load messages initially
            loadMessages();

            // Submit chat message
            // $('#chat-form').submit(function (e) {
            //     e.preventDefault();
            //     var message = $('#message').val();
            //     $('#message').val('');
            //
            //     $.ajax({
            //         url: '/chat/messages/send',
            //         method: 'POST',
            //         data: {
            //             _token: $('meta[name="csrf-token"]').attr('content'),
            //             chat_room_id: chatRoomId,
            //             message: message,
            //         },
            //         success: function () {
            //             loadMessages();
            //         },
            //     });
            // });

            // Poll for new messages every 5 seconds
            setInterval(function () {
                loadMessages();
            }, 5000);
        });

    </script>
{{--    <script src="{{ asset('js/chat.js') }}"></script>--}}
@endsection
