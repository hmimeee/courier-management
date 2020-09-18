<?php
include_once('core.php');

if (!isset($_SESSION['userEmail'])) {
    header('Location: /login.php');
}

if ($_SERVER['REQUEST_METHOD'] =='POST') {
    $order = new OrderAdminController;
    $order = $order->update($_POST, $_GET['id']);
    if ($order ==1) {
        $message = message(1,'Order updated successfully!');
    }
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: /accessControl.php');
} else {
    if ($_SESSION['userRole'] =='admin') {
        $order = new OrderAdminController;
        $order = $order->view($_GET['id']);
    } else {
        $order = new OrderController;
        $order = $order->view($_GET['id']);
    }
    if (!is_array($order)) {
        header('Location: /accessControl.php');
    }

    $pageTitle = 'Edit Order - '.$order['item_name'];
    include 'header.php';
    if (isset($message)) {
        echo "$message";
    }
    ?>

    <div class="contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
        <div class="contact-hd sm-form-hd">
            <h2 class="col-md-10 col-sm-12">Order</h2>
            <div class="col-md-2 col-sm-12 text-right">
                <a href="order.php?id=<?php echo $order['id']; ?>" class="btn btn-success success-icon-notika waves-effect"><i class="fa fa-pencil"></i> Edit Order</a>
            </div>
        </div>
        <div class="contact-inner">
            <div class="contact-hd widget-ctn-hd">
                <h2>Order Information</h2>
            </div>
            <div class="contact-dt">
                <ul class="contact-list widget-contact-list">
                    <li><i class="fa fa-shopping-cart"></i> <?php echo $order['item_name'];?></li>
                    <li><i class="fa fa-money"></i> <?php echo $order['amount'];?></li>
                    <li><i class="fa fa-dollar"></i> <?php echo $order['fee'];?></li>
                    <li><i class="fa fa-shield"></i> <?php echo $order['payment_status'];?></li>
                    <li><i class="fa fa-truck"></i> <b><?php $status = new StatusController; $status = $status->view($order['status_id']); echo $status['name'];?></b>
                        <?php if ($_SESSION['userRole'] =='admin') { ?>
                        <form method="post">
                           <div class="form-example-int mg-t-15">
                            <div class="form-group">
                                <label>Delivery Status</label>
                                <div class="nk-int-st">
                                    <select name="status_id" class="selectpicker">
                                        <option value="<?php echo $order['status_id'];?>"> <?php 
                                        $status = new StatusController; 
                                        $status = $status->view($order['status_id']);
                                        echo $status ['name'];
                                        ?></option>
                                        <?php 
                                        $status = new StatusController; 
                                        $status = $status->all();
                                        foreach ($status as $stat) {
                                            ?>
                                            <option value="<?php echo $stat['id'];?>"><?php echo $stat['name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="contact-btn">
                            <button class="button btn waves-effect">Change</button>
                        </div>
                    </form>
                <?php } ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="contact-inner">
        <div class="contact-hd widget-ctn-hd">
            <h2>Recipient Information</h2>
        </div>
        <div class="contact-dt">
            <ul class="contact-list widget-contact-list">
                <li><i class="fa fa-user"></i> <?php echo $order['recipient']; ?></li>
                <li><i class="fa fa-phone"></i> <?php echo $order['recipient_number']; ?></li>
                <li><i class="fa fa-map-marker"></i> <?php echo $order['recipient_address']; ?></li>
            </ul>
        </div>
    </div>
    <a href="orders.php" class="btn btn-success success-icon-notika waves-effect"><i class="fa fa-arrow-left"></i> Back</a>
</div>
<?php } include 'footer.php'; ?>