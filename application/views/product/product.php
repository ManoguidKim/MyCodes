<div class="content-wrapper">
	<div class="content pt-3">
		<div class="container-fluid">
			
			<div class="row">

				<div class="col-md-9">
					<h4 class="text-muted">Manage Product</h4>

					<br>

					<table id="mytable" class="table table-sm table-striped table-bordered nowarp display">
						<thead>
							<tr class="bg-info">
								<th>#</th>
								<th>Product Name</th>
								<th>Description</th>
								<th>Category</th>
								<th>Price</th>
								<th width="10%">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; if ($product_details != Null) { ?>
								<?php foreach ($product_details as $prod) { ?>
									<tr>
										<td><?php echo $i++ ?></td>
										<td><?php echo $prod->product_name ?></td>
										<td><?php echo $prod->product_description ?></td>
										<td><?php echo $prod->product_category ?></td>
										<td><?php echo $prod->product_price ?></td>
										<td>
											<a href="" class="btn btn-sm btn-success">Edit</a>
											<a href="<?php echo base_url('page/delete_product/'. $prod->product_id) ?>" class="btn btn-sm btn-danger" onclick="return  confirm('do you want to delete Y/N')">Delete</a>
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
					<?php echo form_open('page/product') ?>
					<small class="text-muted">Product Name</small>
					<input type="text" name="text_product_name" class="form-control" placeholder="Enter Product Name">

					<small class="text-muted">Product Decription</small>
					<input type="text" name="text_product_description" class="form-control" placeholder="Enter Product Description">

					<small class="text-muted">Product Category</small>
					<select class="form-control text-muted" name="text_product_category">
						<option value="">Select Category</option>
						<option value="Japanese Dish">Japanese Dish</option>
						<option value="European Dish">European Dish</option>
						<option value="Filipino Dish">Filipino Dish</option>
						<option value="Beer">Beer</option>
						<option value="Brandy">Brandy</option>
						<option value="Cocktail">Cocktail</option>
						<option value="Juice">Juice</option>
					</select>

					<small class="text-muted">Product Price</small>
					<input type="number" name="text_product_price" class="form-control" placeholder="Enter Product Price">

					<br>

					<button type="submit" class="btn btn-block btn-info">Save Product</button>
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>