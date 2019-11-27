<?php
ob_start("ob_gzhandler");
session_start();
if (isset($_SESSION['UserName'])) {
	$pageTitle = 'Dashboard';
	include 'init.php';


	?>
	<div class="container home-stats text-center">
		<h1 class="text-secondary mt-4 mb-5">Dashboard</h1>
		<div class="row">
			<div class="col-md-3 mb-3">
				<a href="members.php">
					<div class="stat s-member text-white p-2 fa-1x border border-secondary rounded">
						Total Member
						<span class="d-block fa-5x"><?php echo Count_Item("User_ID", "users"); ?></span>
					</div>
				</a>
			</div>
			<div class="col-md-3 mb-3">
				<a href="members.php?do=manage&page=panding">
					<div class="stat s-panding text-white p-2 fa-1x border border-secondary rounded">
						Panding Member <span class="d-block fa-5x"><?php echo Check_item('RegStatus', 'users', 0) ?></span>
					</div>
				</a>
			</div>
			<div class="col-md-3 mb-3">
				<a href="item.php">
					<div class="stat s-item text-white p-2 fa-1x border border-secondary rounded">
						Total Items <span class="d-block fa-5x"><?php echo Count_Item("I_ID", "items"); ?></span>
					</div>
				</a>
			</div>
			<div class="col-md-3 mb-3">
				<a href="item.php">
					<div class="stat s-comment text-white p-2 fa-1x border border-secondary rounded">
						Total Comments <span class="d-block fa-5x"><?php echo Count_Item("CO_ID", "comments"); ?></span>
					</div>
				</a>
			</div>
		</div>
	</div>

	<div class="container latst mt-5">
		<div class="row">
			<div class="col-md-7 mb-2">
			<div class="card">
					<div class="card-header">
					<i class="fa fa-users" aria-hidden="true"></i> Latest <?= Count_Item("*", "Users") ?> Registerd Users
						
					</div>
					<div class="card-body p-3">
					<table class="table table-striped">
					<tbody>
							<?php $rows = Get_Items("*", "users", "User_ID");
										foreach ($rows as $row) { ?>
									<tr class="row">
							
									<td class="col"><?= $row['FullName'] ?></td>
									<td class="col"><a href="item.php?do=Edit&i_id=<?= $row['I_ID'] ?>" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
									<a href="members.php?do=Edit&u_id=<?= $row['User_ID'] ?>" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
											<a href="members.php?do=Delete&u_id=<?= $row['User_ID'] ?>" class="btn btn-danger confirm"><i class="fas fa-trash-alt"></i> Delete</a>
		
								</td>
								
								</tr>
							<?php } ?>
					</tbody>
					</table>
					</div>
				</div>
				
			</div>
			<div class="col">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-tag" aria-hidden="true"></i> Latest <?= Count_Item("*", "items") ?> Items
					</div>
					<div class="card-body p-3">
					<table class="table table-striped">
					<tbody>
							<?php $rows = Get_Items("*", "items", "I_ID");
								foreach ($rows as $row) { ?>
									<tr class="row">
							
									<td class="col"><?= $row['Name'] ?></td>
									<td class="col"><a href="item.php?do=Edit&i_id=<?= $row['I_ID'] ?>" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
										<a href="item.php?do=Delete&i_id=<?= $row['I_ID'] ?>" class="btn btn-danger confirm"><i class="fas fa-trash-alt"></i> Delete</a>
									</td>
								
								</tr>
							<?php } ?>
					</tbody>
					</table>
					</div>
				</div>

			</div>
		</div>
		<?php
			$stmt = $con->prepare("SELECT
                            comments.*,users.UserName AS Member
                        FROM
                        comments
                                INNER JOIN
                                users
                                ON
                                users.User_ID = comments.User_Id");


			$stmt->execute();
			$rows = $stmt->fetchAll();
			?>
		<div class="row mt-3">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<i class="fas fa-comment"></i> <?= Count_Item("*", "comments") ?> <Strong>Comments</Strong>
					</div>
					<div class="card-body">
						<ul class="list-unstyled">
							<?php foreach ($rows as $row) { ?>
								<li>
									<h5><?= $row['Member'] ?> <span class="font-weight-normal text-muted h6"><?= $row['Comment_Date'] ?></span> </h5>
									<p><?= $row['Comment'] ?></p>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- End Container Latest Items-->
	</div>
	</div>
	</div>

<?php include $tpl . 'footer.php';
} else {
	header('Location:index.php');
	exit();
}

ob_end_flush();
?>