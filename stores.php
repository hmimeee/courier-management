<?php
include_once('core.php');

if (!isset($_SESSION['userEmail'])) {
    header('Location: /login.php');
}

if (isset($_POST['del'])) {
    $store = new StoreController;
    $store = $store->destroy($_POST['del']);
    if ($store == true) {
        $message = message(1, 'Store deleted successfully!');
    } else {
        $message = message(0, 'Something went wrong!');
    }
}

if (isset($_POST['name'])) {
    $store = new StoreController;
    $store = $store->store($_POST);
    if ($store ==1) {
        $message = message(1, 'Store added successfully!');
    } else {
        $message = message(0, 'Something went wrong!');
    }
}


$stores = new StoreController;
$stores = $stores->index();

$pageTitle = 'Stores';
include 'header.php';

if (isset($message)) {
    echo $message;
}

?><div class="normal-table-list mg-t-30">
    <div class="basic-tb-hd row">
        <h2 class="col-md-10 col-sm-12">Stores</h2>
        <div class="col-md-2 col-sm-12 text-right">
            <button class="btn btn-success success-icon-notika waves-effect" data-toggle="modal" data-target="#newStoreModal"><i class="fa fa-plus"></i> Add Store</button>
        </div>
    </div>
    <div class="bsc-tbl-hvr">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stores as $store) { ?>
                    <tr>
                        <td><?php echo $store['id']; ?></td>
                        <td> <a href="store.php?id=<?php echo $store['id'];?>"><?php echo $store['name'];?></a></td>
                        <td><?php echo $store['address'];?></td>
                        <td>
                            <form method="post">
                                <a href="store.php?id=<?php echo $store['id'];?>" class="btn btn-default btn-icon-notika waves-effect"><i class="fa fa-pencil"></i></a>
                                <button name="del" value="<?php echo $store['id'];?>" class="btn btn-default btn-icon-notika waves-effect"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
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
                            <label>Store Name</label>
                            <div class="nk-int-st">
                                <input type="text" name="name" class="form-control input-sm" placeholder="Enter Store Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int mg-t-15">
                        <div class="form-group">
                            <label>Address</label>
                            <div class="nk-int-st">
                                <textarea name="address" placeholder="Enter Store Address" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="user_id" value="<?php echo $userId;?>">
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
