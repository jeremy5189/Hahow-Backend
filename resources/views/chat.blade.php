@extends('layouts/app')

@section('script')
<script type="text/javascript">

    $(function() {

        setTimeout(getUpdate, 1000);

        // 偵測 Form 送出事件
        $('#chat-form').submit(function(event) {

            // 阻止 Form 透過預設方法送出
            event.preventDefault();

            // 取得使用者輸入的 Message
            var message = $('#message').val();
            console.log(message);

            $.post('/chat', {
                'message': message
            }, function(resp) {
                console.log(resp);
            });

            // 清空使用者輸入框
            $('#message').val('');
            // 游標對焦
            $('#message').focus();
        });
    });

    function getUpdate() {

        $.get('/chat/all', {}, function(resp) {
            console.log(resp);
            var str = '';
            for( var index in resp ) {
                var chat = resp[index];
                str += chat.author + ': ' + chat.message + "\n";
            }
            $('#chat-disp').val(str);
        });

        setTimeout(getUpdate, 1000);
    }

</script>
@endsection

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Chat Room</div>
            <div class="panel-body">
                <form id="chat-form">
                    <div class="form-group">
                        <textarea class="form-control" rows="10" id="chat-disp" readonly="true"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" id="message" class="form-control">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
