<?php 

class AccountModel extends CI_Model {
	public function create_account($arr) {
		$this->db->insert('account', $arr);
	}

	public function get_account_details_by_username($username) {
		$this->db->where('username', $username);
		return $this->db->get('account')->result();
	}

	public function get_account($account_id = null) {
		if ($account_id != null) {
			$this->db->where('account_id', $account_id);
		}
		return $this->db->get('account')->result();
	}
}