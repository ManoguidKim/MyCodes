<?php

class Account extends CI_Controller {
	public function create_account() {
		$arr = array(
			'full_name' => "Charles Manuzon",
			'username' => "pogi",
			'password' => password_hash('12345', PASSWORD_DEFAULT),
			'usertype' => "admin",
		);
		$this->AccountModel->create_account($arr);
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');

		if ($this->form_validation->run() === true) {
			$username = $this->input->post('username');
			$account_details = $this->AccountModel->get_account_details_by_username($username);

			if ($account_details != Null) {
				if (password_verify($this->input->post('pass'), $account_details[0]->password)) {
					$this->session->set_userdata('UserType', $account_details[0]->usertype);
					if ($account_details[0]->usertype === 'admin') {
						redirect('page/admin');
					} else {
						redirect('desk/desk_monitoring');
					}
				} else {
					$this->session->set_userdata('Error', 'Invalid password');
					$this->load->view('login/login');
				}
			} else {
				$this->session->set_userdata('Error', 'Invalid credentials');
				$this->load->view('login/login');
			}
		} else {
			$this->load->view('login/login');
		}
	}

	public function logout() {
		$this->session->unset_userdata('UserType');
		$this->session->sess_destroy();
		redirect('account/login');
	}

	public function manage_account() {

		$this->form_validation->set_rules('text_full_name', 'Complete Name', 'trim|required');
		$this->form_validation->set_rules('text_username', 'Username', 'trim|required');
		$this->form_validation->set_rules('text_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('text_usertype', 'User Type', 'trim|required');

		if ($this->form_validation->run() === true) {

			$arr = array(
				'full_name' => $this->input->post('text_full_name'),
				'username' => $this->input->post('text_username'),
				'password' => password_hash($this->input->post('text_password'), PASSWORD_DEFAULT),
				'usertype' => $this->input->post('text_usertype'),
				'date_created' => date('Y-m-d')
			);
			$this->AccountModel->create_account($arr);
			$this->session->set_userdata('Success', 'New Account has been created');
			redirect('account/manage_account');
			
		} else {

			$system_data['account_details'] = $this->AccountModel->get_account();

			$this->load->view('template/header');
			$this->load->view('account/account_view', $system_data);
			$this->load->view('template/footer');
		}
	}
}

