<div class="content-wrapper">
	<div class="content pt-3">

		<div class="container-fluid">

			<div class="row">
				<div class="col">
					<?php if ($this->session->userdata('Error')) { ?>
						<script>
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: '<?php echo $this->session->userdata('Error') ?>'
							})
						</script>
						<?php echo $this->session->unset_userdata('Error'); ?>
					<?php } else { ?>
						<?php if ($this->session->userdata('Success')) { ?>
							<script>
								Swal.fire(
									'Success!',
									'<?php echo $this->session->userdata('Success') ?>',
									'success'
								)
							</script>
							<?php echo $this->session->unset_userdata('Success'); ?>
						<?php } ?>
					<?php } ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<table id="mytable" class="table table-bordered table-sm table-striped display nowrap">
						<thead>
							<tr class="text-center bg-secondary">
								<th>Product Name</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Total PRice</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							if ($order_details != NULL) { ?>
								<?php foreach ($order_details as $order) { ?>
									<tr class="text-muted text-center text-uppercase">
										<td> <small> <?php echo $order->product_name ?> </small> </td>
										<td> <small> <?php echo $order->quantity ?> </small> </td>
										<td> <small> <?php echo $order->product_price ?> </small> </td>
										<td> <small> <?php echo number_format($order->product_price * $order->quantity) ?> </small> </td>
									</tr>
								<?php } ?>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<div class="col-md-4">

					<h5 class="text-muted">Billing Out...</h5> <br>
					<h3 class="text-muted text-uppercase">Total Payment: <?php echo number_format($total_sales) ?></h3>

					<br>

					<?php echo form_open('transaction/pay_order/' . $table_id) ?>
					<input type="number" id="text_sales" name="text_sales" class="form-control form-control-lg" value="<?php echo $total_sales ?>" hidden>
					<div class="form-group">
						<small class="text-muted">Cash Render</small>
						<input type="number" name="text_cash" id="text_cash" class="form-control form-control-lg" placeholder="Enter Cash Amount here.." onkeyup="compute_change()">
					</div>

					<div class="form-group">
						<small class="text-muted">Change</small>
						<input type="number" id="text_change" name="text_change" class="form-control form-control-lg" value="0" readonly>
					</div>

					<!-- <div class="form-group">
							<small class="text-muted">Type</small>
							<select name="text_type" class="form-control form-control-lg">
								<option value="">Select Transaction Type</option>
								<option value="Dine In">Dine In</option>
								<option value="Take Out">Take Out</option>
							</select>
						</div> -->

					<div class="form-group">
						<button type="submit" class="btn btn-info btn-lg btn-block"> Pay Amount </button>
						<a href="<?php echo base_url('desk/desk_monitoring') ?>" class="btn btn-lg btn-secondary btn-block"> Back </a>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>

		</div>

	</div>
</div>

<script src="<?php echo base_url('plugins/jquery/jquery.min.js') ?>"></script>
<script>
	function compute_change() {
		var amount_change = 0;

		var amount_cash = $('#text_cash').val();
		var amount_total_sale = $('#text_sales').val();

		amount_change = amount_cash - amount_total_sale;
		if (amount_change < 0) {
			document.getElementById("text_change").value = "";
		} else {
			document.getElementById("text_change").value = amount_change;
		}
	}
</script>