<div class="content-wrapper">
	<div class="content pt-3">
		<div class="container-fluid">
			
			<div class="row">

				<div class="col-md-9">
					<h4 class="text-muted">Manage Accounts</h4>

					<br>

					<table id="mytable" class="table table-sm table-striped table-bordered nowarp display">
						<thead>
							<tr class="bg-secondary">
								<th>#</th>
								<th>Complete Name</th>
								<th>Username</th>
								<th>Password</th>
								<th>User Type</th>
								<th>Date Created</th>
								<th width="15%">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; if ($account_details != Null) { ?>
								<?php foreach ($account_details as $account) { ?>
									<tr>
										<td><?php echo $i++ ?></td>
										<td><?php echo $account->full_name ?></td>										
										<td><?php echo $account->username ?></td>
										<td><?php echo $account->password ?></td>	
										<td><?php echo $account->usertype ?></td>										
										<td><?php echo $account->date_created ?></td>
										<td>
											<a href="" class="btn btn-sm btn-success">Edit</a>
											<a href="" class="btn btn-sm btn-danger" onclick="return  confirm('do you want to delete Y/N')">Delete</a>
										</td>
									</tr>									
								<?php } ?>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<div class="col-md-3">
					<h4 class="text-muted">Input Details</h4>

					<br>
					<?php echo form_open('account/manage_account') ?>
					<small class="text-muted">Complete Name</small>
					<input type="text" name="text_full_name" class="form-control" placeholder="Enter Complete Name">

					<small class="text-muted">Username</small>
					<input type="text" name="text_username" class="form-control" placeholder="Enter Username">

					<small class="text-muted">Password</small>
					<input type="password" name="text_password" class="form-control" placeholder="Enter Password">

					<small class="text-muted">User Type</small>
					<select class="form-control text-muted" name="text_usertype">
						<option value="">Select User Type</option>
						<option value="admin">admin</option>
						<option value="user">user</option>
					</select>

					<br>

					<button type="submit" class="btn btn-block btn-info">Save Account</button>
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>