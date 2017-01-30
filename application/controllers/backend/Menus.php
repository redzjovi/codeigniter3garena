<?php
class Menus extends Backend_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Menus_Model');
	}

	function index()
	{
		$this->j_acl->has_privilege('backend_menus');

		$vars['breadcrumb'] = array(
			array('text' => lang('menu_settings')),
			array('text' => lang('menu_menus')),
		);
		$vars['code'] = $this->input->get('code');
		$vars['menus'] = $this->Menus_Model->read_by_code($this->input->get('code'));
		$vars['page_title'] = lang('menu_menus');
		$vars['status'] = $this->Menus_Model->set_status()->status;
		$this->view('menus/index', $vars);
	}

	function create()
	{
		$this->j_acl->has_privilege('backend_menu_create');

		$vars['breadcrumb'] = array(
			array('text' => lang('menu_settings')),
			array('text' => lang('menu_menus'), 'url' => site_url('backend/menus?code='.$this->input->get('code'))),
			array('text' => lang('menu_menu_create')),
		);
		$vars['code'] = $this->input->get('code');
		$vars['menus'] = $this->Menus_Model->read_by_code($this->input->get('code'));
		$vars['page_title'] = lang('menu_menu_create');
		$vars['status'] = $this->Menus_Model->set_status()->status;

		$this->form_validation->set_rules('code', lang('code'), 'trim|required');
		$this->form_validation->set_rules('status', lang('status'), 'trim|required|numeric');

		if ($this->form_validation->run() === FALSE)
		{
			$this->view('menus/create', $vars);
		}
		else
		{
			$data = array(
				'code' => $this->input->post('code'),
				'icon' => $this->input->post('icon'),
				'text' => $this->input->post('text'),
				'url' => $this->input->post('url'),
				'url_external' => $this->input->post('url_external'),
				'parent_id' => $this->input->post('parent_id'),
				'status' => $this->input->post('status')
			);
			$id = $this->Menus_Model->create($data);
			$this->Menus_Model->set_position($id, $id);
			$this->Menus_Model->set_position($id, $this->input->post('position'));
			$this->session->set_flashdata('message_success', lang('data_create_success'));
			redirect('backend/menus?code='.$this->input->post('code'));
		}
	}

	function update($id = NULL)
	{
		$this->j_acl->has_privilege('backend_menu_update');

		$id = $this->input->post('id') ? $this->input->post('id') : $id;
		$vars['breadcrumb'] = array(
			array('text' => lang('menu_settings')),
			array('text' => lang('menu_menus'), 'url' => site_url('backend/menus?code='.$this->input->get('code'))),
			array('text' => lang('menu_menu_update')),
		);
		$vars['code'] = $this->input->get('code');
		$vars['menus'] = $this->Menus_Model->read_by_code($this->input->get('code'));
		$vars['page_title'] = lang('menu_menu_update');
		$vars['status'] = $this->Menus_Model->set_status()->status;

		$this->form_validation->set_rules('code', lang('code'), 'trim|required');
		$this->form_validation->set_rules('status', lang('status'), 'trim|required|numeric');
		$this->form_validation->set_rules('id', lang('id'), 'trim|integer|required');

		if ($this->form_validation->run() === FALSE)
		{
			if ($menu = $this->Menus_Model->read_by_id($id))
			{
				$vars['menu'] = $menu;
				$this->view('menus/update', $vars);
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
				'code' => $this->input->post('code'),
				'icon' => $this->input->post('icon'),
				'text' => $this->input->post('text'),
				'url' => $this->input->post('url'),
				'url_external' => $this->input->post('url_external'),
				'parent_id' => $this->input->post('parent_id'),
				'status' => $this->input->post('status')
			);
			$this->Menus_Model->update($id, $data);
			$this->Menus_Model->set_position($id, $this->input->post('position'));
			$this->session->set_flashdata('message_success', lang('data_update_success'));
			// redirect('backend/menus?code='.$this->input->post('code'));
		}
	}

	function delete($id = NULL)
	{
		$this->j_acl->has_privilege('backend_menu_delete');

		if ($id)
		{
			$this->Menus_Model->delete($id);
			$this->session->set_flashdata('message_success', lang('data_delete_success'));
		}
		redirect('backend/menus?code='.$this->input->get('code'));
	}
}
?>