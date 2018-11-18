<?php $this->title = "Login" ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="authentication/login" method="POST">
                            <fieldset>
                                <?php if (isset($msgErreur)): ?>
                                    <p><?= $msgErreur ?></p>
                                <?php endif; ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text"
                                           autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password"
                                           value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Connexion</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

