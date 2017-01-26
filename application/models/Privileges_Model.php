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

	function has_privilege($privilege_code, $user_id = NULL, $redirect = TRUE)
	{
		$privilege_id = $this->read_by_privilege_code($privilege_code);
		if ($privilege_id)
			$privilege_id = $privilege_id->id;

		if ($user_id === NULL)
			$user_id = $this->ion_auth->user()->row()->id;

		$this->session->unset_userdata('privileges');
		if (empty($this->session->userdata('privileges')))
		{
			$group_privileges = $this->Group_Privileges_Model->read_by_user_id($user_id)->result_array();
			$group_privileges = array_column($group_privileges, 'privilege_id');

			$user_privileges = $this->User_Privileges_Model->read_by_user_id($user_id)->result_array();
			$user_privileges = array_column($user_privileges, 'privilege_id');

			$privileges = array_unique( array_merge($group_privileges, $user_privileges) );
			$this->session->set_userdata('privileges', $privileges);
		}
		$privileges = $this->session->userdata('privileges');

		$has_privilege = in_array($privilege_id, $privileges);
		if (empty($privilege_code))
			$has_privilege = TRUE;

		if ($has_privilege === FALSE && $redirect === TRUE)
			show_404();

		return $has_privilege;
	}
}
?>