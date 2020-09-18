<?php
include_once('core.php');

if (isset($_SESSION['userEmail'])) {
    header('Location: ./dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] =="POST") {
    $login = new UserController;
    $login = $login->login([
        'email' => $_POST['email'], 
        'password' => md5($_POST['password'])
    ]);
    $check = is_object($login);
    if ($check ==1) {
        $_SESSION["userId"] = $login->id;
        $_SESSION["userName"] = $login->name;
        $_SESSION["userEmail"] = $login->email;
        $_SESSION["userPassword"] = $login->password;
        $_SESSION["userRole"] = $login->role;
        header('Location: ./dashboard.php');
    }

    if ($check !=1) {
        $message = message(0,"Your email/password doesn't match!");
    }
}

$pageTitle = 'Login';
include 'header.php';

if (isset($message)) {
    echo $message;
}
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-example-wrap mg-t-30">
            <div class="cmp-tb-hd cmp-int-hd">
                <h2><?php echo $pageTitle ?? '';?></h2>
            </div>
            <form method="post">
                <div class="form-example-int form-horizental">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                <label class="hrzn-fm">Email Address</label>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <div class="nk-int-st">
                                    <input type="text" name="email" class="form-control input-sm" placeholder="Enter Email" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-example-int form-horizental mg-t-15">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                <label class="hrzn-fm">Password</label>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <div class="nk-int-st">
                                    <input type="password" name="password" class="form-control input-sm" placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-example-int form-horizental mg-t-15">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                            <div class="fm-checkbox">
                                <label><div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Remember me</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-example-int mg-t-15">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                            <button class="btn btn-success notika-btn-success waves-effect">Login</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php';?>