<?php
class Privileges extends Backend_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Privileges_Model');
	}

	function index()
	{
		$this->j_acl->has_privilege('backend_privileges');

		$vars['breadcrumb'] = array(
			array('text' => lang('menu_privileges')),
		);
		$vars['page_title'] = lang('menu_privileges');
		$vars['privileges'] = $this->Privileges_Model->read();
		$this->view('privileges/index', $vars);
	}

	function create()
	{
		$this->j_acl->has_privilege('backend_privilege_create');

		$vars['breadcrumb'] = array(
			array('text' => lang('menu_privileges'), 'url' => site_url('backend/privileges')),
			array('text' => lang('menu_privilege_create')),
		);
		$vars['page_title'] = lang('menu_privilege_create');

		$this->form_validation->set_rules('privilege_code', lang('privilege_code'), 'trim|required|is_unique[privileges.privilege_code]');
		$this->form_validation->set_rules('privilege_name', lang('privilege_name'), 'trim|required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->view('privileges/create', $vars);
		}
		else
		{
			$data = array(
				'privilege_code' => $this->input->post('privilege_code'),
				'privilege_name' => $this->input->post('privilege_name'),
				'privilege_description' => $this->input->post('privilege_description')
			);
			$this->Privileges_Model->create($data);
			$this->session->set_flashdata('message_success', lang('data_create_success'));
			redirect('backend/privileges');
		}
	}

	function update($id = NULL)
	{
		$this->j_acl->has_privilege('backend_privilege_update');

		$id = $this->input->post('id') ? $this->input->post('id') : $id;
		$vars['breadcrumb'] = array(
			array('text' => lang('menu_privileges'), 'url' => site_url('backend/privileges')),
			array('text' => lang('menu_privilege_update')),
		);
		$vars['page_title'] = lang('menu_privilege_update');

		$this->form_validation->set_rules('privilege_code', lang('privilege_code'), 'trim|required|callback_check_unique_privilege_code');
		$this->form_validation->set_rules('privilege_name', lang('privilege_name'), 'trim|required');
		$this->form_validation->set_rules('id', lang('id'), 'trim|integer|required');

		if ($this->form_validation->run() === FALSE)
		{
			if ($privilege = $this->Privileges_Model->read_by_id($id))
			{
				$vars['privilege'] = $privilege;
	            $this->view('privileges/update', $vars);
			}
			else
			{
				$this->session->set_flashdata('message_danger', lang('data_not_exist'));
				redirect('backend/privileges');
			}
		}
		else
		{
			$data = array(
				'privilege_code' => $this->input->post('privilege_code'),
				'privilege_name' => $this->input->post('privilege_name'),
				'privilege_description' => $this->input->post('privilege_description')
			);
			$this->Privileges_Model->update($id, $data);
			$this->session->set_flashdata('message_success', lang('data_update_success'));
			redirect('backend/privileges');
		}
	}

	function delete($id = NULL)
	{
		$this->j_acl->has_privilege('backend_privilege_delete');

		if ($id)
		{
			$this->Privileges_Model->delete($id);
			$this->session->set_flashdata('message_success', lang('data_delete_success'));
		}
		redirect('backend/privileges');
	}

	function check_unique_privilege_code()
	{
		$id = $this->input->post('id');
		$privilege_code = $this->input->post('privilege_code');
		$result = $this->Privileges_Model->check_unique_privilege_code($id, $privilege_code);

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
}
?>