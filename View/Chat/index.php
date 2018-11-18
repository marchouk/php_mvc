<?php $this->title = "T'Chat" ?>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chat</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="chat-panel panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments fa-fw"></i>
                        Logged in as  <strong><?= $user['username'] ?></strong>,
                        Discuss with <strong><?= $otherUser['username'] ?></strong>
                        <div class="pull-right">
                            <a  href="home">Choose another member</a> /
                            <a  href="authentication/logout">Logout</a>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <ul id="chat_list" class="chat">

                        </ul>
                    </div>
                    <!-- /.panel-body -->
                    <div class="panel-footer">

                        <form id="postMessage" class="">
                            <div class="input-group">
                                <input id="btn-input" type="text" name="content" class="form-control input-sm"
                                       placeholder="Type your message here..."/>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-warning btn-sm" id="btn-chat">Send</button>
                                </span>
                            </div>
                        </form>

                    </div>
                    <!-- /.panel-footer -->
                </div>
                <!-- /.panel .chat-panel -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
</div>

<script>
    var $panel = $('.chat-panel .panel-body');
    $panel.scrollTop = $panel.scrollHeight;
    $(document).ready(function () {

        //window.scrollTo(0,$('.chat-panel .panel-body').scrollHeight);



        refresh();
        setInterval(
            function () {
                refresh();
            }, 10000
        );

        $("#postMessage").submit(function (e) {
            e.preventDefault();
            $.post("chat/addMessage/<?php echo $idConversation; ?>", $(this).serialize(),
                function (data, status) {
                    data = JSON.parse(data);
                    if (data.code === 200) {
                        $('#btn-input').val('');
                        refresh();
                    }
                }
            );
        });

        function refresh() {
            $.get("chat/chatSection/<?php echo $idConversation; ?>", function (data) {
                $("#chat_list").html(data);
            });
        }
    });
</script>