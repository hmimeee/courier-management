<?php
include_once('core.php');

if (!isset($_SESSION['userEmail'])) {
    header('Location: /login.php');
}

if (isset($_POST['del'])) {
    $invoice = new InvoiceController;
    $invoice = $invoice->destroy($_POST['del']);
    if ($invoice == true) {
        $message = message(1, 'invoice deleted successfully!');
    } else {
        $message = message(0, 'Something went wrong!');
    }
}

if (isset($_POST['order_id'])) {
    $invoice = new InvoiceController;
    $invoice = $invoice->store($_POST);
    if ($invoice ==1) {
        $message = message(1, 'invoice added successfully!');
    } else {
        $message = message(0, 'Something went wrong!');
    }
}


$invoices = new InvoiceController;
$invoices = $invoices->index();

$pageTitle = 'Invoices';
include 'header.php';

if (isset($message)) {
    echo $message;
}

?><div class="normal-table-list mg-t-30">
    <div class="basic-tb-hd row">
        <h2 class="col-md-10 col-sm-12">Invoices</h2>
        <div class="col-md-2 col-sm-12 text-right">
            <button class="btn btn-success success-icon-notika waves-effect" data-toggle="modal" data-target="#newStoreModal"><i class="fa fa-plus"></i> Add Invoice</button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 50px;">#ID</th>
                    <th>Order Name</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th style="width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invoices as $invoice) { ?>
                    <tr>
                        <td><?php echo $invoice['id'];?></td>
                        <td>
                            <a href="invoice.php?id=<?php echo $invoice['id'];?>">
                            <?php $order = new OrderController; $order = $order->view($invoice['order_id']); echo $order['item_name'];?></a>
                        </td>
                        <td><?php echo $order['amount']+$order['fee']; ?> BDT</td>
                        <td><?php echo $order['payment_status'];?></td>
                        <td>
                            <form method="post">
                                <button name="del" value="<?php echo $invoice['id'];?>" class="btn btn-default btn-icon-notika waves-effect"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
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
                        <div class="form-group">
                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                <h2>Select Order</h2>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <select name="order_id" class="selectpicker" data-live-search="true">
                                    <?php 
                                    $orders = new OrderController;
                                    $orders = $orders->index();
                                    foreach ($orders as $order) { ?>
                                        <option value="<?php echo $order['id'];?>"><?php echo $order['item_name'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                </div>
                <input type="hidden" name="user_id" value="<?php echo $userId;?>">
            </div>
            <div class="modal-footer">
                <button class="btn btn-default waves-effect">Generate Invoice</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
</div>
<?php include 'footer.php';?>
