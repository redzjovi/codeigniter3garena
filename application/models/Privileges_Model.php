<?php
class Privileges_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Group_Privileges_Model');
		$this->load->model('User_Privileges_Model');
	}

	function create($data)
	{
		$this->db->insert('privileges', $data);
	}

	function read()
    {
		$this->db->order_by('privilege_code');
		return $this->db->get('privileges');
	}

	function read_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('privileges')->row();
    }

	function read_by_privilege_code($privilege_code)
    {
        $this->db->where('privilege_code', $privilege_code);
        return $this->db->get('privileges')->row();
    }

	function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('privileges', $data);
    }

	function delete($id)
    {
        $this->db->delete('privileges', array('id' => $id));
    }

	function check_unique_privilege_code($id, $privilege_code)
	{
		$this->db->where('privilege_code', $privilege_code);
		$this->db->where_not_in('id', $id);
		return $this->db->count_all_results('privileges');
	}
}
?>