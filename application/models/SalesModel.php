<?php

class SalesModel extends CI_Model
{

	public function check_invoice_no($invoice_no)
	{
		$this->db->where('invoice_no', $invoice_no);
		return $this->db->get('sales')->result();
	}

	public function add_sales($sales_details)
	{
		$this->db->insert('sales', $sales_details);
	}

	public function get_sales_table($table_id, $status = null)
	{
		$this->db->where('desk_id', $table_id);

		if ($status != null) {
			$this->db->where('status', $status);
		}

		return $this->db->get('sales')->result();
	}

	public function get_queuing()
	{
		$this->db->select('*');
		$this->db->from('sales');
		$this->db->join('desk', 'sales.desk_id = desk.desk_id', 'inner');
		$this->db->where('sales.status', 'not done');
		$this->db->where('sales.remarks', 'no');
		return $this->db->get()->result();
	}

	public function finish_table_order($arr, $table_id)
	{
		$this->db->where('desk_id', $table_id);
		$this->db->where('status', 'not done');
		$this->db->update('sales', $arr);
	}

	public function update_sale_table($arr, $table_id)
	{
		$this->db->where('desk_id', $table_id);
		$this->db->where('status', 'not done');
		$this->db->update('sales', $arr);
	}

	public function get_temp_order()
	{
		$this->db->select('*');
		$this->db->from('temp_db');
		$this->db->join('product', 'product.product_id = temp_db.product_id', 'inner');
		return $this->db->get()->result();
	}

	public function add_temp_order($arr)
	{
		$this->db->insert('temp_db', $arr);
	}

	public function delete_temp_order()
	{
		$this->db->query('TRUNCATE table temp_db');
	}

	public function add_order($arr)
	{
		$this->db->insert('order', $arr);
	}

	public function get_order_invoice($invoice_no)
	{
		$this->db->select('*');
		$this->db->from('order');
		$this->db->join('product', 'product.product_id = order.product_id', 'inner');
		$this->db->where('order.invoice_no', $invoice_no);
		return $this->db->get()->result();
	}








	// Sales Dashboard
	public function get_sales_today()
	{
		$this->db->select('*');
		$this->db->from('order');
		$this->db->join('sales', 'order.invoice_no = sales.invoice_no', 'inner');
		$this->db->where('sales.status', "done");
		$this->db->where('sales.sales_date', date('Y-m-d'));
		return $this->db->get()->result();
	}
}
