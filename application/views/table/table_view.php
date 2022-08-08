<div class="content-wrapper">
	<div class="content pt-3">
		<div class="container-fluid">
			
			<div class="row">

				<div class="col-md-9">
					<h4 class="text-muted">Manage Tables</h4>

					<br>

					<table id="mytable" class="table table-sm table-striped table-bordered nowarp display">
						<thead>
							<tr class="bg-secondary">
								<th>#</th>
								<th>Table</th>
								<th>Status</th>
								<th width="15%">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; if ($desk_details != Null) { ?>
								<?php foreach ($desk_details as $desk) { ?>
									<tr>
										<td><?php echo $i++ ?></td>
										<td><?php echo $desk->desk ?></td>										
										<td><?php echo $desk->status ?></td>
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
					<?php echo form_open('desk/manage_desk') ?>
					<small class="text-muted">Product Name</small>
					<input type="text" name="text_desk" class="form-control" placeholder="Enter Desk Name">

					<small class="text-muted">Status</small>
					<select class="form-control text-muted" name="text_status">
						<option value="">Select Status</option>
						<option value="Available">Available</option>
						<option value="Not Available">Not Available</option>
					</select>

					<br>

					<button type="submit" class="btn btn-block btn-info">Save Table</button>
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>