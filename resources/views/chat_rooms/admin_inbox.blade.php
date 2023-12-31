<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat</title>

    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" >
    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Add Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .stretch-card>.card {
            width: 100%;
            min-width: 100%
        }

        body {
            background-color: #f9f9fa;
            max-width: 600px;
            margin: 0px auto;
        }

        .flex {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto
        }

        @media (max-width:991.98px) {
            .padding {
                padding: 1.5rem
            }
        }

        @media (max-width:767.98px) {
            .padding {
                padding: 1rem
            }
        }


        .box.box-warning {
            border-top-color: #f39c12;
        }

        .box {
            position: relative;
            border-radius: 3px;
            background: #ffffff;
            border-top: 3px solid #d2d6de;
            margin-bottom: 20px;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        }
        .box-header.with-border {
            border-bottom: 1px solid #f4f4f4
        }

        .box-header.with-border {
            border-bottom: 1px solid #f4f4f4;
        }

        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative;
        }

        .box-header:before, .box-body:before, .box-footer:before, .box-header:after, .box-body:after, .box-footer:after {
            content: " ";
            display: table;
        }

        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative
        }

        .box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title {
            display: inline-block;
            font-size: 18px;
            margin: 0;
            line-height: 1;
        }

        .box-header>.box-tools {
            position: absolute;
            right: 10px;
            top: 5px;
        }

        .box-header>.box-tools [data-toggle="tooltip"] {
            position: relative;
        }

        .bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
            background-color: #f39c12 !important;
        }

        .bg-yellow{
            color: #fff !important;
        }

        .btn {
            border-radius: 3px;
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 1px solid transparent;
        }

        .btn-box-tool {
            padding: 5px;
            font-size: 12px;
            background: transparent;
            color: #97a0b3;
        }

        .direct-chat .box-body {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            position: relative;
            overflow-x: hidden;
            padding: 0;
        }

        .box-body {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            padding: 10px;
        }
        .box-header:before, .box-body:before, .box-footer:before, .box-header:after, .box-body:after, .box-footer:after {
            content: " ";
            display: table;
        }

        .direct-chat-messages {
            -webkit-transform: translate(0, 0);
            -ms-transform: translate(0, 0);
            -o-transform: translate(0, 0);
            transform: translate(0, 0);
            padding: 10px;
            height: 80vh;
            overflow: auto;
        }

        .direct-chat-messages, .direct-chat-contacts {
            -webkit-transition: -webkit-transform .5s ease-in-out;
            -moz-transition: -moz-transform .5s ease-in-out;
            -o-transition: -o-transform .5s ease-in-out;
            transition: transform .5s ease-in-out;
        }



        .direct-chat-msg {
            margin-bottom: 10px;
        }

        .direct-chat-msg, .direct-chat-text {
            display: block;
        }

        .direct-chat-info {
            display: block;
            margin-bottom: 2px;
            font-size: 12px;
        }

        .direct-chat-timestamp {
            color: #999;
        }

        .btn-group-vertical>.btn-group:after, .btn-group-vertical>.btn-group:before, .btn-toolbar:after, .btn-toolbar:before, .clearfix:after, .clearfix:before, .container-fluid:after, .container-fluid:before, .container:after, .container:before, .dl-horizontal dd:after, .dl-horizontal dd:before, .form-horizontal .form-group:after, .form-horizontal .form-group:before, .modal-footer:after, .modal-footer:before, .modal-header:after, .modal-header:before, .nav:after, .nav:before, .navbar-collapse:after, .navbar-collapse:before, .navbar-header:after, .navbar-header:before, .navbar:after, .navbar:before, .pager:after, .pager:before, .panel-body:after, .panel-body:before, .row:after, .row:before {
            display: table;
            content: " ";
        }

        .direct-chat-img {
            border-radius: 50%;
            float: left;
            width: 40px;
            height: 40px;
        }

        .direct-chat-text {
            border-radius: 5px;
            position: relative;
            padding: 5px 10px;
            background: #d2d6de;
            border: 1px solid #d2d6de;
            margin: 5px 0 0 50px;
            color: #444;
        }

        .direct-chat-msg, .direct-chat-text {
            display: block;
        }

        .direct-chat-text:before {
            border-width: 6px;
            margin-top: -6px;
        }

        .direct-chat-text:after, .direct-chat-text:before {
            position: absolute;
            right: 100%;
            top: 15px;
            border: solid transparent;
            border-right-color: #d2d6de;
            content: ' ';
            height: 0;
            width: 0;
            pointer-events: none;
        }

        .direct-chat-text:after {
            border-width: 5px;
            margin-top: -5px;
        }

        .direct-chat-text:after, .direct-chat-text:before {
            position: absolute;
            right: 100%;
            top: 15px;
            border: solid transparent;
            border-right-color: #d2d6de;
            content: ' ';
            height: 0;
            width: 0;
            pointer-events: none;
        }

        :after, :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .direct-chat-msg:after {
            clear: both;
        }

        .direct-chat-msg:after {
            content: " ";
            display: table;
        }

        .direct-chat-info {
            display: block;
            margin-bottom: 2px;
            font-size: 12px;
        }

        .right .direct-chat-img {
            float: right;
        }
        .right .direct-chat-info {
          text-align: right;
        }

        .direct-chat-warning .right>.direct-chat-text {
            background: #f39c12;
            border-color: #f39c12;
            color: #fff;
        }

        .right .direct-chat-text {
            margin-right: 50px;
            margin-left: 0;
        }

        .box-footer {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            border-top: 1px solid #f4f4f4;
            padding: 10px;
            background-color: #fff;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .box-header:before, .box-body:before, .box-footer:before, .box-header:after, .box-body:after, .box-footer:after {
            content: " ";
            display: table;
        }


        .input-group-btn {
            position: relative;
            font-size: 0;
            white-space: nowrap;
        }

        .input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
            z-index: 2;
            margin-left: -1px;
        }

        .btn-warning {
            color: #fff;
            background-color: #f0ad4e;
            border-color: #eea236;
        }
    </style>
</head>
<body>
<div class="box box-warning direct-chat direct-chat-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Chat : {{$chat_room->name}}</h3>
    </div>

    <div class="box-body">

        <div class="direct-chat-messages" id="messageList">

        </div>

    </div>

    <div class="box-footer">
        <form id="sendMessageForm">
            @csrf
            <div class="input-group">
                <input type="text" id="message" name="message" placeholder="Type Message ..." class="form-control">
                <input id="sender_id" value="{{auth('admin')->user()->id}}" class="d-none">
                <input id="sender" value="admin" class="d-none">
                <input id="chat_room_id" value="{{$chat_room->id}}" class="d-none">
                <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-flat">Send</button>
                          </span>
            </div>
        </form>
    </div>

</div>

<!-- Your jQuery scripts go here -->
<script>
    $(document).ready(function() {
        $('#sendMessageForm').submit(function(e) {
            e.preventDefault();

            // Get the message from the form
            var message = $('#message').val();
            var sender_id = $('#sender_id').val();
            var sender = $('#sender').val();
            var chat_room_id = $('#chat_room_id').val();

            // Send an AJAX request to the controller
            $.ajax({
                type: 'POST',
                url: '{{ route('send.message') }}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'message': message,
                    'sender_id': sender_id,
                    'sender': sender,
                    'chat_room_id': chat_room_id,
                },
                success: function(response) {
                    // Handle the success response from the controller
                    //alert(response.message);
                    loadMessages(roomId)
                    $('#message').val(''); // Clear the message input field
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error(xhr.responseText);
                }
            });
        });

        // Function to load messages for a specific room
        function loadMessages(roomId) {
            $.ajax({
                type: 'GET',
                url: '/room/' + roomId + '/messages',
                success: function(response) {
                    // Clear the existing list of messages
                    $('#messageList').empty();

                    // Append the new messages to the list
                    $.each(response.messages, function(index, message) {
                        if (message.sender == 'user'){
                            var html = '<div class="direct-chat-msg">'+
                                '<div class="direct-chat-info clearfix">'+
                                '<span class="direct-chat-name pull-left">'+message.name+'</span>'+
                            '<span class="direct-chat-timestamp pull-right"> '+message.time+'</span>'+
                        '</div>'+
                            '<img class="direct-chat-img" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="message user image">'+
                                '<div class="direct-chat-text">'+
                                    message.message+
                                '</div>'+
                            '</div>'
                            $('#messageList').append(html);
                        }else {
                            var html = ' <div class="direct-chat-msg right">' +
                                '<div class="direct-chat-info clearfix">' +
                                '<span class="direct-chat-name pull-right">'+message.name+'</span>' +
                                '<span class="direct-chat-timestamp pull-left"> '+message.time+'</span>' +
                                '</div>' +
                                '<img class="direct-chat-img" src="https://img.icons8.com/office/36/000000/person-female.png" alt="message user image"> ' +
                                '<div class="direct-chat-text">'+message.message+'</div>' +
                                '</div>'
                            $('#messageList').append(html);
                        }

                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Get the room ID from the URL or any other source
        var roomId = {{$chat_room->id}}; // Replace with your logic to get the room ID

        // Initial load of messages
        loadMessages(roomId);

        // You can also set up an interval to refresh the messages periodically
        setInterval(function() {
            loadMessages(roomId);
        }, 2000); // Refresh every 5 seconds (adjust as needed)
    });
</script>
</body>
</html>
