<?php
class Privileges_Model extends CI_Model
{
	private $table = 'privileges';

	public $rules = array(
		'create' => array(
			array('field' => 'privilege_code', 'label' => 'lang:privilege_code', 'rules' => 'trim|required|is_unique[privileges.privilege_code]'),
			array('field' => 'privilege_name', 'label' => 'lang:privilege_name', 'rules' => 'trim|required'),
		),
		'update' => array(
			array('field' => 'privilege_code', 'label' => 'lang:privilege_code', 'rules' => 'trim|required|callback_check_unique_privilege_code'),
			array('field' => 'privilege_name', 'label' => 'lang:privilege_name', 'rules' => 'trim|required'),
			array('field' => 'id', 'label' => 'lang:id', 'rules' => 'trim|integer|required'),
		),
	);

	function __construct()
	{
		parent::__construct();
		$this->load->model('Group_Privileges_Model');
		$this->load->model('User_Privileges_Model');
	}

	function create($data)
	{
		$this->db->insert($this->table, $data);
	}

	function read()
    {
		$this->db->order_by('privilege_code');
		return $this->db->get($this->table);
	}

	function read_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }

	function read_by_privilege_code($privilege_code)
    {
        $this->db->where('privilege_code', $privilege_code);
        return $this->db->get($this->table)->row();
    }

	function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

	function delete($id)
    {
        $this->db->delete($this->table, array('id' => $id));
    }

	function check_unique_privilege_code()
	{
		$id = $this->input->post('id');
		$privilege_code = $this->input->post('privilege_code');
		$result = $this->count_unique_privilege_code($id, $privilege_code);

		if ($result == 0)
		{
			$response = true;
		}
		else
		{
			$this->form_validation->set_message(
				'check_unique_privilege_code',
				sprintf(lang('unique_with_param'), lang('privilege_code'))
			);
			$response = false;
		}
		return $response;
	}

	function count_unique_privilege_code($id, $privilege_code)
	{
		$this->db->where('privilege_code', $privilege_code);
		$this->db->where_not_in('id', $id);
		return $this->db->count_all_results($this->table);
	}
}
?>