<?php
include_once('core.php');

if (!isset($_SESSION['userEmail'])) {
    header('Location: /login.php');
}

if ($_SERVER['REQUEST_METHOD'] =='POST') {
    $request = $_POST;
    $user = new UserController;
    if (!isset($_GET['id']) || empty($_GET['id'])) {
    $user = $user->update($request, $_SESSION['userId']);
} else {
    $user = $user->update($request, $_GET['id']);
}
    if ($user ==1) {
        $message = message(1,'User updated successfully!');
    } else {
        $message = message(0,'Something went wrong!');
    }
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $user = new UserController;
    $user = $user->view($_SESSION['userId']);
} else {

    $user = new UserController;
    $user = $user->view($_GET['id']);
}

if (!is_array($user)) {
    header('Location: /accessControl.php');
}

$pageTitle = 'Edit - '.$user['name'];
include 'header.php';
if (isset($message)) {
    echo "$message";
}
?>

<div class="contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
    <div class="contact-hd sm-form-hd">
        <h2>Edit <?php if ($_SESSION['userRole'] !='admin') { ?> Profile <?php } else { ?>User <?php } ?></h2>
    </div>
    <form method="post">
        <div class="contact-form-int">
            <div class="form-group">
                <div class="form-single nk-int-st widget-form">
                    <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="form-single nk-int-st widget-form">
                    <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="form-single nk-int-st widget-form">
                    <input type="number" name="phone" class="form-control" placeholder="Phone" value="<?php echo $user['phone']; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="form-single nk-int-st widget-form">
                    <textarea name="address" class="form-control" placeholder="Address"><?php echo $user['address']; ?></textarea>
                </div>
            </div>
            <?php if ($_SESSION['userRole'] =='admin') { ?>
            <div class="form-group">
                <div class="form-single nk-int-st widget-form">
                    <div class="fm-checkbox">
                        <label class=""><div class="iradio_square-green" style="position: relative;"><input type="radio" value="admin" name="role" class="i-checks" style="position: absolute; opacity: 0;" <?php if ($user['role'] =='admin'){echo 'checked'; } ?>><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Admin</label>
                        <label class=""><div class="iradio_square-green" style="position: relative;"><input type="radio" value="marchant" name="role" class="i-checks" style="position: absolute; opacity: 0;" <?php if ($user['role'] =='marchant'){echo 'checked'; } ?>><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Marchant</label>
                    </div>
                </div>
            </div>
        <?php } ?>

            <div class="contact-btn">
                <button class="button btn waves-effect">Save</button> <?php if ($_SESSION['userRole'] =='admin') { ?> <a href="/users.php" class="button btn waves-effect">Cancel</a> <?php } ?>
            </div>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>