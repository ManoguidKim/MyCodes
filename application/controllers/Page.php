<?php 

class Page extends CI_Controller {

	public function admin() {
		
		$total_sales_today = 0;
		$sales_details = $this->SalesModel->get_sales_today();
		foreach ($sales_details as $sales) {
			$total_sales_today += $sales->total;
		}
		$system_data['total_sales_today'] = $total_sales_today;

		$this->load->view('template/header');
		$this->load->view('dashboard/dashboard', $system_data);
		$this->load->view('template/footer');
	}

	public function product() {
		$this->form_validation->set_rules('text_product_name', 'Product Name', 'trim|required');
		$this->form_validation->set_rules('text_product_description', 'Product Description', 'trim');
		$this->form_validation->set_rules('text_product_category', 'Product Category', 'trim|required');
		$this->form_validation->set_rules('text_product_price', 'Product Price', 'trim|required');

		if ($this->form_validation->run() === true) {

			$arr = array(
				'product_name' => $this->input->post('text_product_name'),
				'product_description' => $this->input->post('text_product_description'),
				'product_category' => $this->input->post('text_product_category'),
				'product_price' => $this->input->post('text_product_price'),
			);
			$this->ProductModel->add_product($arr);
			redirect('page/product');

		} else {
			$system_data['product_details'] = $this->ProductModel->get_product_details();
			$this->load->view('template/header');
			$this->load->view('product/product', $system_data);
			$this->load->view('template/footer');
		}
		
	}

	public function delete_product($product_id) {
		$this->ProductModel->delete_product($product_id);
		redirect('page/product');
	}

	public function logout() {
		$this->load->view('login/login');
	}


	

}