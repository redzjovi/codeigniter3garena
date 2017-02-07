<?php
class Groups_Model extends CI_Model
{
	public $rules = array(
		'create' => array(
			array('field' => 'group_name', 'label' => 'lang:group_name', 'rules' => 'trim|required|is_unique[groups.name]'),
			array('field' => 'group_description', 'label' => 'lang:group_description', 'rules' => 'trim|required'),
		),
		'update' => array(
			array('field' => 'group_id', 'label' => 'lang:group_id', 'rules' => 'trim|integer|required'),
			array('field' => 'group_name', 'label' => 'lang:group_name', 'rules' => 'trim|required|callback_check_unique_group_name'),
			array('field' => 'group_description', 'label' => 'lang:group_description', 'rules' => 'trim|required'),
		),
	);

	function read_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('groups')->row();
    }

	function check_unique_group_name()
	{
		$group_id = $this->input->post('group_id');
		$group_name = $this->input->post('group_name');
		$result = $this->count_unique_group_name($group_id, $group_name);

		if ($result == 0)
		{
			$response = true;
		}
		else
		{
			$this->form_validation->set_message(
				'check_unique_group_name',
				sprintf(lang('unique_with_param'), lang('group_name'))
			);
			$response = false;
		}
		return $response;
	}

	function count_unique_group_name($group_id, $group_name)
	{
		$this->db->where('name', $group_name);
		$this->db->where_not_in('id', $group_id);
		return $this->db->count_all_results('groups');
	}
}
?>