<?php
include_once('core.php');

if (!isset($_SESSION['userEmail'])) {
    header('Location: /login.php');
}

if ($_SERVER['REQUEST_METHOD'] =='POST') {
    $order = new OrderController;
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
            <h2>Edit Order</h2>
        </div>
        <form method="post">
            <div class="contact-form-int">
             <div class="form-example-wrap">
                <div class="form-example-int">
                    <div class="form-group">
                        <label>Item Name</label>
                        <div class="nk-int-st">
                            <input type="text" name="item_name" class="form-control input-sm" placeholder="Enter Item Name" value="<?php echo $order['item_name'];?>">
                        </div>
                    </div>
                </div>
                <div class="form-example-int mg-t-15">
                    <div class="form-group">
                        <label>Store</label>
                        <div class="nk-int-st">
                            <select name="store_id" class="selectpicker">
                                <option value="<?php echo $order['store_id'];?>">...</option>
                                <?php 
                                $stores = new StoreController; 
                                $stores = $stores->all();
                                foreach ($stores as $store) {
                                    ?>
                                    <option value="<?php echo $store['id'];?>"><?php echo $store['name'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-example-int">
                    <div class="form-group">
                        <label>Recipient Name</label>
                        <div class="nk-int-st">
                            <input type="text" name="recipient" class="form-control input-sm" placeholder="Enter Recipient Name" value="<?php echo $order['recipient'];?>">
                        </div>
                    </div>
                </div>
                <div class="form-example-int">
                    <div class="form-group">
                        <label>Recipient Number</label>
                        <div class="nk-int-st">
                            <input type="text" name="recipient_number" class="form-control input-sm" placeholder="Enter Recipient Number" value="<?php echo $order['recipient_number'];?>">
                        </div>
                    </div>
                </div>
                <div class="form-example-int">
                    <div class="form-group">
                        <label>Recipient Address</label>
                        <div class="nk-int-st">
                            <textarea name="recipient_address" class="form-control input-sm" placeholder="Enter Recipient Address" rows="4"><?php echo $order['recipient_address'];?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-example-int mg-t-15">
                    <div class="form-group">
                        <label>Amount</label>
                        <div class="nk-int-st">
                            <input type="text" name="amount" class="form-control input-sm" placeholder="Enter Amount" value="<?php echo $order['amount'];?>">
                        </div>
                    </div>
                </div>
                <div class="form-example-int mg-t-15">
                    <div class="form-group">
                        <label>Fee</label>
                        <div class="nk-int-st">
                            <input type="text" name="fee" class="form-control input-sm" placeholder="Enter Fee" value="<?php echo $order['fee'];?>">
                        </div>
                    </div>
                </div>
                <div class="form-example-int mg-t-15">
                    <div class="form-group">
                        <label>Payment Status</label>
                        <div class="nk-int-st">
                            <select name="payment_status" class="selectpicker">
                                <option value="<?php echo $order['payment_status'];?>"><?php echo $order['payment_status'];?></option>
                                <option>Unpaid</option>
                                <option>Paid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-example-int mg-t-15">
                    <div class="form-group">
                        <label>Delivery Time</label>
                        <div class="nk-int-st">
                            <select name="delivery_time" class="selectpicker">
                                <option value="<?php echo $order['delivery_time'];?>">...</option>
                                <option>12 Hours</option>
                                <option>1 Day</option>
                                <option>2 Days</option>
                                <option>3 Days</option>
                                <option>7 Days</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-btn">
                <button class="button btn waves-effect">Save</button> <a href="/orders.php" class="button btn waves-effect">Cancel</a>
            </div>
        </div>
    </form>
</div>
<?php } include 'footer.php'; ?>