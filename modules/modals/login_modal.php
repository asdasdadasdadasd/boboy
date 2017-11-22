<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" id="loginform" name="loginform">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" autocomplete="off" value="" required autofocus>

                                    <span class="help-block">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                
                                    <span class="help-block">
                                        <strong></strong>
                                    </span>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" name="login" class="btn btn-primary btn-block w-40">
                                    Login
                                </button>
                               
                                <div class="container-fluid text-center" style="margin-top: 8px;">
                                    <a class="btn btn-link" href="index.php?mod=register">
                                        Create new account
                                    </a></br>
                                    or</br>
                                    <a class="btn btn-link" href="index.php?mod=forgotpass">
                                        Forgot Your Password?
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  </div>
</div>