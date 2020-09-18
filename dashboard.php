<?php
include_once('core.php');

$pageTitle = 'Dashboard';
include 'header.php';
?>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
            <div class="website-traffic-ctn">
                <h2><span class="counter">
                    <?php
                    if ($_SESSION['userRole'] =='admin') {
                        $orders = new OrderController;
                        $orders = $orders->where('status_id', '1');
                    } else {
                        $orders = new OrderAdminController;
                        $orders = $orders->where('status_id', '1');
                    }
                    echo $orders->num_rows;
                    ?>
                </span></h2>
                <p>Pending Delivery</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
            <div class="website-traffic-ctn">
                <h2><span class="counter">
                    <?php
                    if ($_SESSION['userRole'] =='admin') {
                        $orders = new OrderAdminController;
                        $orders = $orders->where('status_id', '3');
                    } else {
                        $orders = new OrderController;
                        $orders = $orders->where('status_id', '3');
                    }
                    echo $orders->num_rows;
                    ?>
                </span></h2>
                <p>Total Delivered</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
            <div class="website-traffic-ctn">
                <h2><span class="counter">
                    <?php
                    if ($_SESSION['userRole'] =='admin') {
                        $orders = new OrderAdminController;
                        $orders = $orders->where('status_id', '4');
                    } else {
                        $orders = new OrderController;
                        $orders = $orders->where('status_id', '4');
                    }
                    echo $orders->num_rows;
                    ?>
                </span></h2>
                <p>Total Returned</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
            <div class="website-traffic-ctn">
                <h2><span class="counter">
                    <?php
                    if ($_SESSION['userRole'] =='admin') {
                        $orders = new OrderAdminController;
                        $orders = $orders->where('payment_status', 'Paid');
                    } else {
                        $orders = new OrderController;
                        $orders = $orders->where('payment_status', 'Paid');
                    }
                    echo $orders->num_rows;
                    ?>
                </span></h2>
                <p>Payment Processed</p>
            </div>
        </div>
    </div>
</div>
<div class="realtime-statistic-area">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
            <div class="realtime-wrap notika-shadow mg-t-30">
                <div class="realtime-ctn">
                    <div class="realtime-title">
                        <h2>Sales</h2>
                    </div>
                </div>
                <div class="realtime-visitor-ctn">
                    <div class="realtime-vst-sg">
                        <h4><span class="counter">
                            <?php
                            if ($_SESSION['userRole'] =='admin') {
                                $orders = new OrderAdminController;
                                $orders = $orders->all();
                            } else {
                                $orders = new OrderController;
                                $orders = $orders->all();
                            }
                            echo $orders->num_rows;
                            ?>
                        </span></h4>
                        <p>Total sales (Quantity)</p>
                    </div>
                    <div class="realtime-vst-sg">
                        <h4><span class="counter">
                            <?php
                            if ($_SESSION['userRole'] =='admin') {
                                $orders = new OrderAdminController;
                                $orders = $orders->all();
                            } else {
                                $orders = new OrderController;
                                $orders = $orders->all();
                            }
                            $sale =0;
                            foreach ($orders as $order) {
                                $sale += intval($order['amount']);
                            }
                            echo $sale;
                            ?>
                        </span> BDT</h4>
                        <p>Total sales (Taka)</p>
                    </div>
                </div>
                <div class="realtime-map">
                    <div class="vectorjsmarp" id="world-map"></div>
                </div>
            </div>
        </div>
        <!-- End Realtime sts area-->
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="statistic-right-area notika-shadow mg-tb-30 sm-res-mg-t-0">
                <div class="past-day-statis">
                    <h2>Last 10 Sales</h2>
                </div>
                <table class="table table-inner table-vmiddle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th style="width: 60px">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SESSION['userRole'] =='admin') {
                            $orders = new OrderAdminController;
                            $orders = $orders->all(10);
                        } else {
                            $orders = new OrderController;
                            $orders = $orders->all(10);
                        }
                        foreach ($orders as $order) {
                            ?>
                            <tr>
                                <td><?php echo $order['id'];?></td>
                                <td><?php echo $order['item_name'];?></td>
                                <td><?php echo $order['amount'];?> BDT</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';?>