<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
<div class="vertical-alignment-helper">
  <div class="modal-dialog vertical-align-center">

    <!-- Modal content-->
    <div class="modal-content2">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading uppercase">Please login</div>
                <div class="panel-body" style="margin-top: 32px;">
                    <form id="login-form" class="form-horizontal" method="POST"  name="loginform">
                        <div id="email-log" class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" autocomplete="off" value="" required autofocus>
                            </div>
                        </div>

                        <div id="pwd-log" class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                
                                    <span class="help-block">
                                        <strong id="pwd-login-help"></strong>
                                    </span>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="submit-login" name="login" class="btn btn-primary btn-block uppercase">
                                    Login
                                </button>
                               
                                <div class="" style="margin-top: 16px;">
                                    <a style="padding-left: 0px;" class="btn btn-link" href="index.php?mod=forgotpass">
                                        Forgot Your Password?
                                    </a>
                                    <a style="padding-left: 0px;" class="btn btn-link" href="index.php?mod=register">
                                        Create New Account
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
</div>