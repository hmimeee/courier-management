<?php
include_once('core.php');

if (!isset($_SESSION['userEmail'])) {
	header('Location: /login.php');
}
if ($_SESSION['userRole'] !='admin') {
	header('Location: /accessControl.php');
}

if (isset($_POST['del'])) {
	$user = new UserController;
	$user = $user->destroy($_POST['del']);
	if ($user == true) {
		$message = message(1, 'User deleted successfully!');
	} else {
		$message = message(0, 'You cannot delete admin!');
	}

}

$users = new Model\User;
$users = $users->all('users');

$pageTitle = 'Users';
include 'header.php';

if (isset($message)) {
	echo $message;
}
?>
<!-- Data Table area Start-->
<div class="data-table-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="data-table-list">
					<div class="basic-tb-hd">
						<h2>Users</h2>
					</div>
					<div class="table-responsive">
						<table id="data-table-basic" class="table table-striped">
							<thead>
								<tr>
									<th style="width: 50px;">#ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
									<th style="width: 100px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($users as $user) { ?>
									<tr>
										<td><?php echo $user['id'];?></td>
										<td><a href="user.php?id=<?php echo $user['id'];?>"><?php echo $user['name'];?></a></td>
										<td><?php echo $user['email'];?></td>
										<td><?php echo $user['role'];?></td>
										<td>
											<form method="post">
												<a href="user.php?id=<?php echo $user['id'];?>" class="btn btn-default btn-icon-notika waves-effect"><i class="fa fa-pencil"></i></a>
												<button name="del" value="<?php echo $user['id'];?>" class="btn btn-default btn-icon-notika waves-effect"><i class="fa fa-trash"></i></button>
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
			</div>
		</div>
	</div>
</div>
<!-- Data Table area End-->
<?php include 'footer.php'; ?>