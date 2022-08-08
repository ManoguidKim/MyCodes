
<footer class="main-footer">
	<small>Copyright &copy; 2022 Point of Sale System All rights reserved. </small>
</footer>
</div>

<script src="<?php echo base_url('plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<script src="<?php echo base_url('dist/js/adminlte.min.js') ?>"></script>
<script src="<?php echo base_url('dist/js/demo.js') ?>"></script>

<script src="<?php echo base_url('plugins/moment/moment.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/fullcalendar/main.js') ?>"></script>

<script src="<?php echo base_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?php echo base_url('plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>

<script src="<?php echo base_url('plugins/moment/moment.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/inputmask/jquery.inputmask.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/bs-stepper/js/bs-stepper.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/dropzone/min/dropzone.min.js') ?>"></script>
<script src="<?php echo base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>

<script>
	$(document).ready(function() {
		window.setTimeout(function() {
			$("#alert").fadeTo(500, 0).slideUp(500, function() {
				$(this).remove();
			});
		}, 2000);
	});

	bsCustomFileInput.init();
	$(function() {
		$('#mytable').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": true,
			"pageLength": 25,
			"autoWidth": false,
			"responsive": true,
		});

		$('#mytable2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": true,
			"pageLength": 25,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
</body>


</html>