<?php
class Group_Privileges extends Backend_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(['Groups_Model', 'Group_Privileges_Model', 'Privileges_Model']);
	}

	function update($id = NULL)
	{
		$this->j_acl->has_privilege('backend_group_privileges_update');

		$id = $this->input->post('id') ? $this->input->post('id') : $id;

		$vars['breadcrumb'] = array(
			array('text' => lang('menu_groups'), 'url' => site_url('backend/groups')),
			array('text' => lang('menu_group_privileges_update')),
		);
		$vars['page_title'] = lang('menu_group_privileges_update');

		$this->form_validation->set_rules('id', lang('id'), 'trim|integer|required');

		if ($this->form_validation->run() === FALSE)
		{
			if ($group = $this->Groups_Model->read_by_id($id))
			{
				$group_privileges = $this->Group_Privileges_Model->read_by_group_id($id)->result_array();

				$vars['group'] = $group;
				$vars['group_privileges'] = array_column($group_privileges, 'privilege_id');
				$vars['privileges'] = $this->Privileges_Model->read();
	            $this->view('group_privileges/update', $vars);
			}
			else
			{
				$this->session->set_flashdata('message_danger', lang('data_not_exist'));
				redirect('backend/groups');
			}
		}
		else
		{
			$data = array(
				'user_id' => $this->input->post('id'),
				'privilege_id' => $this->input->post('privilege_id')
			);
			$this->Group_Privileges_Model->update($id, $data);
			$this->session->set_flashdata('message_success', lang('data_update_success'));
			$this->session->unset_userdata('privileges');
			redirect('backend/groups');
		}
	}
}
?>