<!DOCTYPE html>
<?php
if (isset($_SESSION['user'])) {
    session_destroy();
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
        <link rel="icon" href="style/img/images.png">
        <title>Form Login - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style/asset/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            body { 
                background: url(style/img/1.1.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            .panel-default {
                opacity: 0.9;
                margin-top:30px;
            }
            .form-group.last { margin-bottom:0px; }
        </style>
        <script src="style/asset/js/jquery-1.11.0.js"></script>
        <script src="style/asset/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-lock"></span> Login</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post" action="proses/login">
                                <div class="form-group">
                                    <label for="username" class="col-sm-3 control-label">
                                        Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="user" class="form-control" id="username" placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label">
                                        Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="pass" class="form-control" id="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"/>
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="submit" name="submit" id="login-submit" value="Login" class="btn btn-success btn-sm">
                                  
                                        <button type="reset" class="btn btn-default btn-sm">
                                            Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">

        </script>
    </body>
</html>
