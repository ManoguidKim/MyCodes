<?php

class Transaction extends CI_Controller
{

	public function order_product()
	{

		$system_data['product_details'] = $this->ProductModel->get_product_details();

		$this->load->view('template/header');
		$this->load->view('transaction/pos_view', $system_data);
		$this->load->view('template/footer');
	}

	public function set_take_order()
	{
		$this->SalesModel->delete_temp_order();

		$this->session->unset_userdata('table_id');
		$this->session->unset_userdata('table_no');

		$this->session->set_userdata('invoice_no', $this->generate_invoice_number());
		$this->session->set_userdata('remarks', "take_out");

		$system_data['temp_order_details'] = $this->SalesModel->get_temp_order();
		$system_data['product_details'] = $this->ProductModel->get_product_details();

		$this->load->view('template/header');
		$this->load->view('transaction/create_order', $system_data);
		$this->load->view('template/footer');
	}

	public function set_table_order($table_id, $table_no)
	{
		$type = $this->input->post('text_type');

		if (isset($type)) {
			$this->SalesModel->delete_temp_order();

			$table_no = str_replace("%20", " ", $table_no);

			$this->session->set_userdata('table_id', $table_id);
			$this->session->set_userdata('invoice_no', $this->generate_invoice_number());
			$this->session->set_userdata('table_no', $table_no);
			$this->session->set_userdata('remarks', "order");
			$this->session->set_userdata('order_type', $this->input->post('text_type'));

			$system_data['temp_order_details'] = $this->SalesModel->get_temp_order();
			$system_data['product_details'] = $this->ProductModel->get_product_details();

			$this->load->view('template/header');
			$this->load->view('transaction/create_order', $system_data);
			$this->load->view('template/footer');
		} else {
			$this->session->set_userdata('Success', 'Please select transaction Type');
			redirect('desk/manage_desk');
		}
	}

	public function set_table_add_order($table_id)
	{
		$this->SalesModel->delete_temp_order();

		$table_no = $this->DeskModel->fetch_desk($table_id)[0]->desk;
		$invoice_no = $this->SalesModel->get_sales_table($table_id, "not done")[0]->invoice_no;

		$this->session->set_userdata('table_id', $table_id);
		$this->session->set_userdata('invoice_no', $invoice_no);
		$this->session->set_userdata('table_no', $table_no);
		$this->session->set_userdata('remarks', "add_order");
		$this->session->set_userdata('order_type', $this->SalesModel->get_sales_table($table_id, "not done")[0]->transaction_type);

		$system_data['temp_order_details'] = $this->SalesModel->get_temp_order();
		$system_data['product_details'] = $this->ProductModel->get_product_details();

		$this->load->view('template/header');
		$this->load->view('transaction/create_order', $system_data);
		$this->load->view('template/footer');
	}

	public function create_order($product_id = null)
	{
		$this->form_validation->set_rules('text_quantity', 'Quantity', 'trim|required|numeric');

		if ($this->form_validation->run() === true) {

			$quantity = $this->input->post('text_quantity');

			$product_details = $this->ProductModel->get_product_details($product_id);

			$total_sales = $quantity * $product_details[0]->product_price;

			$arr = array(
				'product_id' => $product_id,
				'quantity' => $quantity,
				'total_sales' => $total_sales
			);
			$this->SalesModel->add_temp_order($arr);


			$system_data['temp_order_details'] = $this->SalesModel->get_temp_order();
			$system_data['product_details'] = $this->ProductModel->get_product_details();

			$this->load->view('template/header');
			$this->load->view('transaction/create_order', $system_data);
			$this->load->view('template/footer');
		} else {
			$system_data['temp_order_details'] = $this->SalesModel->get_temp_order();
			$system_data['product_details'] = $this->ProductModel->get_product_details();

			$this->load->view('template/header');
			$this->load->view('transaction/create_order', $system_data);
			$this->load->view('template/footer');
		}
	}

	public function create_order_transaction()
	{
		$temp_order_details = $this->SalesModel->get_temp_order();
		foreach ($temp_order_details as $temp_order) {
			$arr = array(
				'product_id' => $temp_order->product_id,
				'quantity' => $temp_order->quantity,
				'total' => $temp_order->total_sales,
				'order_date' => date('Y-m-d'),
				'invoice_no' => $this->session->invoice_no
			);
			$this->SalesModel->add_order($arr);
		}

		$remarks = $this->session->remarks;
		if ($remarks == "order") {
			$arr = array(
				'invoice_no' => $this->session->invoice_no,
				'sales_date' => date('Y-m-d'),
				'desk_id' => $this->session->table_id,
				'status' => "not done",
				'total_sales' => 0,
				'cash_render' => 0,
				'cash_change' => 0,
				'remarks' => 'no',
				'transaction_type' => $this->session->order_type
			);
			$this->SalesModel->add_sales($arr);
		} else {
			if ($remarks == "take_out") {
				$arr = array(
					'invoice_no' => $this->session->invoice_no,
					'sales_date' => date('Y-m-d'),
					'desk_id' => "",
					'status' => "not done",
					'total_sales' => 0,
					'cash_render' => 0,
					'cash_change' => 0,
					'remarks' => 'no',
					'transaction_type' => $this->session->order_type
				);
				$this->SalesModel->add_sales($arr);
			}
		}

		$arr = array(
			'status' => 'Occupied'
		);
		$this->DeskModel->update_desk($arr, $this->session->table_id);
		$this->SalesModel->delete_temp_order();

		redirect('desk/desk_monitoring');
	}

	public function bill_out($table_id)
	{
		$invoice_no = $this->SalesModel->get_sales_table($table_id, "not done")[0]->invoice_no;

		$order_data = $this->SalesModel->get_order_invoice($invoice_no);
		$system_data['order_details'] = $order_data;

		$total_sales = 0;
		foreach ($order_data as $order) {
			$total_sales += $order->total;
		}

		$system_data['invoice_no'] = $invoice_no;
		$system_data['total_sales'] = $total_sales;
		$system_data['table_id'] = $table_id;

		$this->load->view('template/header');
		$this->load->view('transaction/bill_out', $system_data);
		$this->load->view('template/footer');
	}

	public function done_table_orders($table_id)
	{
		$arr = array(
			'remarks' => 'yes'
		);
		$this->SalesModel->finish_table_order($arr, $table_id);
		redirect('desk/desk_monitoring');
	}

	public function pay_order($table_id)
	{

		$total_sales = (float)$this->input->post('text_sales');
		$total_cash = (float)$this->input->post('text_cash');
		$total_change = $this->input->post('text_change');

		if ($total_cash >= $total_sales) {

			$arr = array(
				'total_sales' => $total_sales,
				'cash_render' => $total_cash,
				'cash_change' => $total_change,
				'status' => 'done'
			);
			$this->SalesModel->update_sale_table($arr, $table_id);

			$arr = array(
				'status' => 'Available'
			);
			$this->DeskModel->update_desk($arr, $table_id);

			$this->session->set_userdata('Success', 'Transaction Success!');
			redirect('desk/desk_monitoring');
		} else {

			$this->session->set_userdata('Error', 'Invalid Amount');
			redirect('transaction/bill_out/' . $table_id);
		}
	}

	public function generate_invoice_number()
	{
		$generate_invoice_number = "INVOICE-" . $this->generate_random_string('NUMBER', 6);
		$sales_details = $this->SalesModel->check_invoice_no($generate_invoice_number);
		if ($sales_details != Null) {
			$this->generate_invoice_number();
		} else {
			return $generate_invoice_number;
		}
	}

	public function generate_random_string($type, $range)
	{
		$code = "";
		if ($type == "LETTER") {
			$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);

			for ($i = 0; $i < $range; $i++) {
				$code .= $characters[rand(0, $charactersLength - 1)];
			}
		} else {
			$characters = '1234567890';
			$charactersLength = strlen($characters);

			for ($i = 0; $i < $range; $i++) {
				$code .= $characters[rand(0, $charactersLength - 1)];
			}
		}
		return $code;
	}
}
