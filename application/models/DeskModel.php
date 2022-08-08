<?php

class DeskModel extends CI_Model
{

	public function fetch_desk($desk_id = null)
	{
		if ($desk_id != null) {
			$this->db->where('desk_id', $desk_id);
		}
		return $this->db->get('desk')->result();
	}

	public function update_desk($desk_details, $desk_id)
	{
		$this->db->where('desk_id', $desk_id);
		$this->db->update('desk', $desk_details);
	}

	public function add_desk($desk_details)
	{
		$this->db->insert('desk', $desk_details);
	}
}
