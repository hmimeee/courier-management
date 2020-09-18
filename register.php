<?php
include_once('core.php');

if (isset($_SESSION['userEmail'])) {
    header('Location: /dashboard.php');
}

$pageTitle = 'Register';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] =="POST") {
    $register = new UserController;
    echo $register->register([
        'name' => $_POST['name'], 
        'email' => $_POST['email'], 
        'password' => md5($_POST['password'])
    ]);
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
                                <label class="hrzn-fm">Full Name</label>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <div class="nk-int-st">
                                    <input type="text" name="name" class="form-control input-sm" placeholder="Enter Name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="form-example-int mg-t-15">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                            <button class="btn btn-success notika-btn-success waves-effect">Register</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php';?>