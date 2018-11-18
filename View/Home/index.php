<?php $this->title = "Messages" ?>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Members</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="chat-panel panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments fa-fw"></i> Logged in as, <strong><?= $user['username'] ?></strong>
                        <div class="pull-right">
                            <a id="lienDeco" href="authentication/logout">Logout</a>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <ul id="users_list" class="chat">

                        </ul>
                    </div>
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
    $(document).ready(function () {
        refresh();
        setInterval(
            function () {
                refresh();
            }, 10000
        );
        function refresh() {
            $.get( "home/usersSection", function( data ) {
                $( "#users_list" ).html( data );
            });
        }
    });
</script>