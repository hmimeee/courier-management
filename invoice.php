<?php
include_once('core.php');

if (!isset($_SESSION['userEmail'])) {
    header('Location: /login.php');
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: /accessControl.php');
} else {

    $invoice = new InvoiceController;
    $invoice = $invoice->view($_GET['id']);
    if (!is_array($invoice)) {
        header('Location: /accessControl.php');
    }
    $order = new OrderController;
    $order = $order->view($invoice['order_id']);

    $pageTitle = 'Invoice #'.$invoice['id'];
    ?>
    <!doctype html>
    <html class="no-js" lang="">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title><?php echo $siteName; ?> | <?php echo $pageTitle ?? '';?></title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
      ============================================ -->
      <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
      ============================================ -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
      ============================================ -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- font awesome CSS
      ============================================ -->
      <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
      ============================================ -->
      <link rel="stylesheet" href="css/owl.carousel.css">
      <link rel="stylesheet" href="css/owl.theme.css">
      <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- meanmenu CSS
      ============================================ -->
      <link rel="stylesheet" href="css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
      ============================================ -->
      <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
      ============================================ -->
      <link rel="stylesheet" href="css/normalize.css">
    <!-- mCustomScrollbar CSS
      ============================================ -->
      <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- Notika icon CSS
      ============================================ -->
      <link rel="stylesheet" href="css/notika-custom-icon.css">
    <!-- wave CSS
      ============================================ -->
      <link rel="stylesheet" href="css/wave/waves.min.css">
      <link rel="stylesheet" href="css/wave/button.css">
    <!-- main CSS
      ============================================ -->
      <link rel="stylesheet" href="css/main.css">
    <!-- style CSS
      ============================================ -->
      <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
      ============================================ -->
      <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
      ============================================ -->
      <script src="js/vendor/modernizr-2.8.3.min.js"></script>
      <!-- Data Table JS
        ============================================ -->
        <link rel="stylesheet" href="css/jquery.dataTables.min.css">
        <!-- dialog CSS
            ============================================ -->
            <link rel="stylesheet" href="css/dialog/sweetalert2.min.css">
            <link rel="stylesheet" href="css/dialog/dialog.css">
        <!-- bootstrap select CSS
            ============================================ -->
            <link rel="stylesheet" href="css/bootstrap-select/bootstrap-select.css">
        </head>

        <body>
          <!-- Start Container area-->
          <div class="container">
            <?php
            if (isset($message)) {
                echo "$message";
            }
            ?>
            <div style="padding: 20px; background-color: #00C292; color: white;font-size: 30px;"> Invoice #<?php echo $order['id']; ?></div>
            <div class="contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                <div class="contact-hd sm-form-hd">
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
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
                                    <li><i class="fa fa-truck"></i> <b><?php $status = new StatusController; $status = $status->view($order['status_id']); echo $status['name'];?></b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
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
                    </div>
                </div>
            </div>
            <div style="padding: 10px; background-color: #00C292; color: white;font-size: 15px;text-align: center;"> &copy <?php echo $siteName; ?></div>
            <script type="text/javascript">
                window.print();
            </script>
            <?php } ?>