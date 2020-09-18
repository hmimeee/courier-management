<?php
include_once('core.php');

if (!isset($_SESSION['userEmail'])) {
    header('Location: /login.php');
}

if (isset($_POST['del'])) {
    $order = new OrderController;
    $order = $order->destroy($_POST['del']);
    if ($order == true) {
        $message = message(1, 'Order deleted successfully!');
    } else {
        $message = message(0, 'Something went wrong!');
    }
}

if (isset($_POST['item_name'])) {
    $order = new OrderController;
    $order = $order->store($_POST);
    if ($order ==1) {
        $message = message(1, 'Order added successfully!');
    } else {
        $message = message(0, 'Something went wrong!');
    }
}

if ($_SESSION['userRole'] =='admin') {
    $orders = new OrderAdminController;
    $orders = $orders->index();
} else {
    $orders = new OrderController;
    $orders = $orders->index();
}

$pageTitle = 'Orders';
include 'header.php';

if (isset($message)) {
    echo $message;
}

?><div class="normal-table-list mg-t-30">
    <div class="basic-tb-hd row">
        <h2 class="col-md-10 col-sm-12">Orders</h2>
        <div class="col-md-2 col-sm-12 text-right">
            <?php if ($_SESSION['userRole'] !='admin') { ?>
            <button class="btn btn-success success-icon-notika waves-effect" data-toggle="modal" data-target="#newStoreModal"><i class="fa fa-plus"></i> Add Order</button>
            <?php } ?>
        </div>
    </div>

    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 50px;">#ID</th>
                    <th>Item Name</th>
                    <th>Recipient Details</th>
                    <th>Delivery Status</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <?php if ($_SESSION['userRole'] !='admin') { ?>
                        <th style="width: 100px;">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) { ?>
                    <tr>
                        <td><?php echo $order['id'];?></td>
                        <td><a href="viewOrder.php?id=<?php echo $order['id'];?>"><?php echo $order['item_name'];?></a></td>
                        <td><?php echo '<i class="fa fa-user"></i> '.$order['recipient'].'<br/><i class="fa fa-phone"></i> '.$order['recipient_number'].'<br/><i class="fa fa-map-marker"></i> '.$order['recipient_address'];?></td>
                        <td><?php $status = new StatusController; $status = $status->view($order['status_id']); echo $status['name'];?></td>
                        <td><?php echo number_format($order['amount']); ?> BDT</td>
                        <td><?php echo $order['payment_status'];?></td>
                        <?php if ($_SESSION['userRole'] !='admin') { ?>
                        <td>
                            <form method="post">
                                <a href="order.php?id=<?php echo $order['id'];?>" class="btn btn-default btn-icon-notika waves-effect"><i class="fa fa-pencil"></i></a>
                                <button name="del" value="<?php echo $order['id'];?>" class="btn btn-default btn-icon-notika waves-effect"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!--Modal create new store -->
<div class="modal fade" id="newStoreModal" role="dialog" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <form method="post">
                <div class="modal-body">
                   <div class="form-example-wrap">
                    <div class="form-example-int">
                        <div class="form-group">
                            <label>Item Name</label>
                            <div class="nk-int-st">
                                <input type="text" name="item_name" class="form-control input-sm" placeholder="Enter Item Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int mg-t-15">
                        <div class="form-group">
                            <label>Store</label>
                            <div class="nk-int-st">
                                <select name="store_id" class="selectpicker">
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
                                <input type="text" name="recipient" class="form-control input-sm" placeholder="Enter Recipient Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int">
                        <div class="form-group">
                            <label>Recipient Number</label>
                            <div class="nk-int-st">
                                <input type="text" name="recipient_number" class="form-control input-sm" placeholder="Enter Recipient Number">
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int">
                        <div class="form-group">
                            <label>Recipient Address</label>
                            <div class="nk-int-st">
                                <textarea name="recipient_address" class="form-control input-sm" placeholder="Enter Recipient Address" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int mg-t-15">
                        <div class="form-group">
                            <label>Amount</label>
                            <div class="nk-int-st">
                                <input type="text" name="amount" class="form-control input-sm" placeholder="Enter Amount">
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int mg-t-15">
                        <div class="form-group">
                            <label>Fee</label>
                            <div class="nk-int-st">
                                <input type="text" name="fee" class="form-control input-sm" placeholder="Enter Fee">
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int mg-t-15">
                        <div class="form-group">
                            <label>Payment Status</label>
                            <div class="nk-int-st">
                                <select name="payment_status" class="selectpicker">
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
                                    <option>12 Hours</option>
                                    <option>1 Day</option>
                                    <option>2 Days</option>
                                    <option>3 Days</option>
                                    <option>7 Days</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="status_id" value="1">
                    <input type="hidden" name="user_id" value="<?php echo $userId;?>">
                    <input type="hidden" name="created_at" value="<?php echo date('d-m-Y');?>">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default waves-effect">Save</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
</div>
<?php include 'footer.php';?>
