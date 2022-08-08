<?php

class Desk extends CI_Controller
{

	public function manage_desk()
	{

		$this->form_validation->set_rules('text_desk', 'Desk', 'trim|required');
		$this->form_validation->set_rules('text_status', 'Desk', 'trim|required');

		if ($this->form_validation->run() === true) {

			$desk_details = array(
				'desk' => $this->input->post('text_desk'),
				'status' => $this->input->post('text_status')
			);

			// insert new desk data
			$this->DeskModel->add_desk($desk_details);
			$this->session->set_userdata('Success', 'New tables saved');
			redirect('desk/manage_desk');
		} else {


			$system_data['desk_details'] = $this->DeskModel->fetch_desk();

			$this->load->view('template/header');
			$this->load->view('table/table_view', $system_data);
			$this->load->view('template/footer');
		}
	}

	public function desk_monitoring()
	{

		$system_data['order_list'] = $this->SalesModel->get_queuing();
		$system_data['desk_details'] = $this->DeskModel->fetch_desk();
		$this->load->view('template/header');
		$this->load->view('monitoring/desk_monitoring_view', $system_data);
		$this->load->view('template/footer');
	}
}
