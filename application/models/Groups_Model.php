<?php
class Groups_Model extends CI_Model
{
	function read_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('groups')->row();
    }

	function check_unique_group_name($group_id, $group_name)
	{
		$this->db->where('name', $group_name);
		$this->db->where_not_in('id', $group_id);
		return $this->db->count_all_results('groups');
	}
}
?>