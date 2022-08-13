@extends('layouts.app')
<style>
    a {
        text-decoration: none !important;                                
    }
    
    label {                                
        color: rgba(120, 144, 156,1.0) !important;                                
    }
    
    .btn:focus, .btn:active:focus, .btn.active:focus {                                
        outline: none !important;
        box-shadow: 0 0px 0px rgba(120, 144, 156,1.0) inset, 0 0 0px rgba(120, 144, 156,0.8);
    }

    .card::-webkit-scrollbar {
        width: 1px;
    }
    
    ::-webkit-scrollbar-thumb {
        border-radius: 9px;
        background: rgba(96, 125, 139,0.99);
    }

    .balon1, .balon2 {
        margin-top: 5px !important;
        margin-bottom: 5px !important;
        }


    .balon1 a {
        background: #42a5f5;
        color: #fff !important;
        border-radius: 20px 20px 3px 20px;
        display: block;
        max-width: 90%;
        padding: 7px 13px 7px 13px;
        margin-left: 15%;

        }

    .balon1:before {

        content: attr(data-is);
        position: absolute;
        right: 15px;
        bottom: -0.8em;
        display: block;
        font-size: .750rem;
        color: rgba(84, 110, 122,1.0);
        
        }

    .balon2 a {
        background: #f1f1f1;
        color: #000 !important;
        border-radius: 20px 20px 20px 3px;
        display: block;
        max-width: 75%;
        padding: 7px 13px 7px 13px;                                
        }
        
    .balon2:before {
        content: attr(data-is);
        position: absolute;
        left: 13px;
        bottom: -0.8em;
        display: block;
        font-size: .750rem;
        color: rgba(84, 110, 122,1.0);                            
        }
        
    .bg-sohbet:before {
        content: "";
        background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTAgOCkiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PGNpcmNsZSBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgY3g9IjE3NiIgY3k9IjEyIiByPSI0Ii8+PHBhdGggZD0iTTIwLjUuNWwyMyAxMW0tMjkgODRsLTMuNzkgMTAuMzc3TTI3LjAzNyAxMzEuNGw1Ljg5OCAyLjIwMy0zLjQ2IDUuOTQ3IDYuMDcyIDIuMzkyLTMuOTMzIDUuNzU4bTEyOC43MzMgMzUuMzdsLjY5My05LjMxNiAxMC4yOTIuMDUyLjQxNi05LjIyMiA5LjI3NC4zMzJNLjUgNDguNXM2LjEzMSA2LjQxMyA2Ljg0NyAxNC44MDVjLjcxNSA4LjM5My0yLjUyIDE0LjgwNi0yLjUyIDE0LjgwNk0xMjQuNTU1IDkwcy03LjQ0NCAwLTEzLjY3IDYuMTkyYy02LjIyNyA2LjE5Mi00LjgzOCAxMi4wMTItNC44MzggMTIuMDEybTIuMjQgNjguNjI2cy00LjAyNi05LjAyNS0xOC4xNDUtOS4wMjUtMTguMTQ1IDUuNy0xOC4xNDUgNS43IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+PHBhdGggZD0iTTg1LjcxNiAzNi4xNDZsNS4yNDMtOS41MjFoMTEuMDkzbDUuNDE2IDkuNTIxLTUuNDEgOS4xODVIOTAuOTUzbC01LjIzNy05LjE4NXptNjMuOTA5IDE1LjQ3OWgxMC43NXYxMC43NWgtMTAuNzV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjcxLjUiIGN5PSI3LjUiIHI9IjEuNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjE3MC41IiBjeT0iOTUuNSIgcj0iMS41Ii8+PGNpcmNsZSBmaWxsPSIjMDAwIiBjeD0iODEuNSIgY3k9IjEzNC41IiByPSIxLjUiLz48Y2lyY2xlIGZpbGw9IiMwMDAiIGN4PSIxMy41IiBjeT0iMjMuNSIgcj0iMS41Ii8+PHBhdGggZmlsbD0iIzAwMCIgZD0iTTkzIDcxaDN2M2gtM3ptMzMgODRoM3YzaC0zem0tODUgMThoM3YzaC0zeiIvPjxwYXRoIGQ9Ik0zOS4zODQgNTEuMTIybDUuNzU4LTQuNDU0IDYuNDUzIDQuMjA1LTIuMjk0IDcuMzYzaC03Ljc5bC0yLjEyNy03LjExNHpNMTMwLjE5NSA0LjAzbDEzLjgzIDUuMDYyLTEwLjA5IDcuMDQ4LTMuNzQtMTIuMTF6bS04MyA5NWwxNC44MyA1LjQyOS0xMC44MiA3LjU1Ny00LjAxLTEyLjk4N3pNNS4yMTMgMTYxLjQ5NWwxMS4zMjggMjAuODk3TDIuMjY1IDE4MGwyLjk0OC0xOC41MDV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxwYXRoIGQ9Ik0xNDkuMDUgMTI3LjQ2OHMtLjUxIDIuMTgzLjk5NSAzLjM2NmMxLjU2IDEuMjI2IDguNjQyLTEuODk1IDMuOTY3LTcuNzg1LTIuMzY3LTIuNDc3LTYuNS0zLjIyNi05LjMzIDAtNS4yMDggNS45MzYgMCAxNy41MSAxMS42MSAxMy43MyAxMi40NTgtNi4yNTcgNS42MzMtMjEuNjU2LTUuMDczLTIyLjY1NC02LjYwMi0uNjA2LTE0LjA0MyAxLjc1Ni0xNi4xNTcgMTAuMjY4LTEuNzE4IDYuOTIgMS41ODQgMTcuMzg3IDEyLjQ1IDIwLjQ3NiAxMC44NjYgMy4wOSAxOS4zMzEtNC4zMSAxOS4zMzEtNC4zMSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEuMjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPjwvZz48L3N2Zz4=');
        opacity: 0.06;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        height:100%;
        position: absolute;   
        }
        .hide {
            display: none
        }
</style>
@section('content')
@guest
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    please log in first 😁.
                </div>
            </div>
        </div>
    </div>
</div>                    
@endguest

@auth
<div class="container ">
    <div class="row justify-content-center mt-1">
        <div class="col-sm-4 col-xs-12">
            @foreach ($users as $user)
            <div class="card text-white bg-danger mb-3" style="max-width: 30rem; opacity: 0.75;">
                <div class="card-header">
                    @csrf
                    <input type="submit" class="btn btn-outline-success me-1 btn-sm px-3 friendSubmit" value="Chat" data-id="{{$user->id}}">
                    {{ucfirst($user->name)}} #{{$user->id}}
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-sm-8 col-xs-12 w-80">
            <div id="right" class="hide right">
                <div class="card" id="card_messages">
                    
                        <div class="card bg-sohbet border-0 m-0 p-0" style="height: 600px;">
                            <div class="card-header bg-info px-3 friend_name"></div>
                            <div id="sohbet" class="card border-0 m-0 p-0 position-relative bg-transparent messages" style="overflow-y: auto; height: 100vh;">
                            
                            </div>
                            <div class="card-footer text-muted">
                                <div class="input-group">
                                    @csrf
                                    <input type='hidden' id="friend_id" val="">
                                    <input type="text" class="form-control" placeholder="type your message ..." aria-label="type your message ..." id='current_text' aria-describedby="msgSubmit" required/>
                                    <input class="btn btn-outline-success" type="submit" id="msgSubmit" value="Send">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
</div>    
@endauth

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
@if($users->isNotEmpty())
<script>
    $(document).ready(function(){
        $('.friendSubmit').click(function(e){
            e.preventDefault();
            $('.messages').html('')
            let id = $(this).data('id')
            
            $.ajax({
                url: "{{ route('chooseFri')}}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    friend_id:id
                },
                success: function(result){
                    console.log(result);
                    let messages = result.messages
                    let friend = result.friend
                    $('.friend_name').html(`${friend.name} `)
                    document.getElementById('friend_id').value=friend.id
                    
                    messages.forEach(msg => {
                        let date = moment(msg.created_at, "YYYY-MM-DD hh:mm:ss +01:00");
                        
                        if (msg.sender_id=={{Auth::user()->id}}){
                            let html_me =`<div class="balon1 p-2 m-0 position-relative justify-content-end" data-is="You - ${date.fromNow()}">                          
                                <a class="float-right text-end"> ${msg.text} </a>                            
                            </div>`
                            $('.messages').append(html_me)
                        }else {
                            let html_other = `<div class="balon2 p-2 m-0 position-relative" data-is="${friend.name} - ${date.fromNow()}">
                                        <a class="float-left sohbet2"> ${msg.text} </a>                            
                                    </div>`
                            $('.messages').append(html_other)
                        }
                    });
                    $('#right').removeClass('hide')
                    let scroll_to_bottom = document.getElementById('sohbet');
		            scroll_to_bottom.scrollTop = scroll_to_bottom.scrollHeight;
                    document.getElementById('current_text').value ="";
                }
            });
        });
    });
</script>
@endif

<script>
    $(document).ready(function(){
        $('#msgSubmit').click(function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('sendMsg')}}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    friend_id: $('#friend_id').val(),
                    message: $('#current_text').val()
                },
                success: function(result){
                    document.getElementById('current_text').value ="";
                }
                
            });
        });
    });
</script>

@endsection
