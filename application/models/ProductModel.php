<?php 

class ProductModel extends CI_Model {
	public function get_product_details($product_id = null) {
		if ($product_id != null) {
			$this->db->where('product_id', $product_id);
		}
		return $this->db->get('product')->result();
	}

	public function add_product($arr) {
		$this->db->insert('product', $arr);
	}

	public function delete_product($product_id) {
		$this->db->where('product_id', $product_id);
		$this->db->delete('product');
	}
}