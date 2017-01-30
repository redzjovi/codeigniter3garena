<?php
class User_Privileges extends Backend_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(['Group_Privileges_Model', 'User_Privileges_Model', 'Privileges_Model']);
	}

	function update($id = NULL)
	{
		$this->j_acl->has_privilege('backend_user_privileges_update');

		$id = $this->input->post('id') ? $this->input->post('id') : $id;

		$vars['breadcrumb'] = array(
			array('text' => lang('menu_settings')),
			array('text' => lang('menu_users'), 'url' => site_url('backend/users')),
			array('text' => lang('menu_user_privileges_update')),
		);
		$vars['page_title'] = lang('menu_user_privileges_update');

		$this->form_validation->set_rules('id', lang('id'), 'trim|integer|required');

		if ($this->form_validation->run() === FALSE)
		{
			if ($user = $this->ion_auth->user((int) $id)->row())
			{
				$group_privileges = $this->Group_Privileges_Model->read_by_user_id($id)->result_array();
				$user_privileges = $this->User_Privileges_Model->read_by_user_id($id)->result_array();

				$vars['group_privileges'] = array_unique( array_column($group_privileges, 'privilege_id') );
				$vars['privileges'] = $this->Privileges_Model->read();
	            $vars['user_privileges'] = array_column($user_privileges, 'privilege_id');
				$vars['user'] = $user;
				$this->view('user_privileges/update', $vars);
			}
			else
			{
				$this->session->set_flashdata('message_danger', lang('data_not_exist'));
				redirect('backend/users');
			}
		}
		else
		{
			$data = array(
				'user_id' => $this->input->post('id'),
				'privilege_id' => $this->input->post('privilege_id')
			);
			$this->User_Privileges_Model->update($id, $data);
			$this->session->set_flashdata('message_success', lang('data_update_success'));
			$this->session->unset_userdata('privileges');
			redirect('backend/users');
		}
	}
}
?>