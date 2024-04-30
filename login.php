<?php
require_once '../system/application_top.php';

if ($obj->getREQUEST('login_btn')) {
    $username = $obj->StringInputCleaner($_POST['username']);
    $password = $obj->StringInputCleaner($_POST['password']);
    $msg = $usr->checkLogin($username, $password);
    //var_dump($msg);
}


//include 'captcha/securimage_show.php';
//echo  $usr->createUser("Administrator", "auth*321P", "admin@itechnepal.net");
//if($usr->updatePassword("sasuke", "newS@2018#", "suraj@itechnepal.net",'2')){  echo 'created'; }
//if($usr->updatePassword("Administrator", "N@yapatrika2021", "admin@itechnepal.net",'1')){  echo 'created'; }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet"> 
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/login-style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">

            <section id="content">
                <?php if (isset($msg) && $msg == FALSE): ?>
                    <div class="alert alert-danger fade in">
                        <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
                        <strong>Sorry!</strong> Incorrect Username or Password!!.
                    </div>
                <?php endif; ?>
                <form method="post">                    
                    <h1>Login Form</h1>
                    @csrf
                    <div>
                        <input type="text" name="username" placeholder="Username" required="" id="username" />
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password" required="" id="password" />
                    </div>
                    <?php echo $usr->check_attempt(); ?>
                    <div>
                        <input type="submit" name="login_btn" value="Log in" />
                        <a href="#">Lost your password?</a>

                    </div>
                </form><!-- form -->
                <div class="button">
                    ©  i-Tech Nepal - 2018
                </div><!-- button -->
            </section>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

    </body>
</html>