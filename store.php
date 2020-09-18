<?php
include_once('core.php');

if (!isset($_SESSION['userEmail'])) {
    header('Location: /login.php');
}

if ($_SERVER['REQUEST_METHOD'] =='POST') {
    $request = $_POST;
    $store = new StoreController;
    $store = $store->update($request, $_GET['id']);
    if ($store ==1) {
        $message = message(1,'Store updated successfully!');
    }
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: /accessControl.php');
} else {

    $store = new StoreController;
    $store = $store->view($_GET['id']);
    if (!is_array($store)) {
        header('Location: /accessControl.php');
    }

    $pageTitle = 'Edit - '.$store['name'];
    include 'header.php';
    if (isset($message)) {
        echo "$message";
    }
    ?>

    <div class="contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
        <div class="contact-hd sm-form-hd">
            <h2>Edit User</h2>
        </div>
        <form method="post">
            <div class="contact-form-int">
                <div class="form-group">
                    <div class="form-single nk-int-st widget-form">
                        <input type="text" name="name" class="form-control" value="<?php echo $store['name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-single nk-int-st widget-form">
                        <textarea name="address" class="form-control" placeholder="Address"><?php echo $store['address']; ?></textarea>
                    </div>
                </div>

                <div class="contact-btn">
                    <button class="button btn waves-effect">Save</button> <a href="/stores.php" class="button btn waves-effect">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <?php } include 'footer.php'; ?>