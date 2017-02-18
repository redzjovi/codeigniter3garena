<?php
class Users extends Backend_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Users_Model');
	}

	function index($group_id = NULL)
	{
		$this->j_acl->has_privilege('backend_users');

		$vars['breadcrumb'] = array(
			array('text' => lang('menu_users')),
		);
		$vars['page_title'] = lang('menu_users');
		$vars['users'] = $this->ion_auth->users($group_id)->result();
		foreach ($vars['users'] as $k => $user)
		{
			$vars['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}
		$this->view('users/index', $vars);
	}

	function create()
	{
		$this->j_acl->has_privilege('backend_user_create');

		$vars['breadcrumb'] = array(
			array('text' => lang('menu_users'), 'url' => site_url('backend/users')),
			array('text' => lang('menu_user_create')),
		);
		$vars['page_title'] = lang('menu_user_create');

		$rules = $this->Users_Model->rules['create'];
        $this->form_validation->set_rules($rules);

		if ($this->form_validation->run() === FALSE)
		{
			$vars['groups'] = $this->ion_auth->groups()->result();
			$this->view('users/create', $vars);
		}
		else
		{
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$group_ids = $this->input->post('groups');
			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone')
			);

			$this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
			$this->session->set_flashdata('message_success', $this->ion_auth->messages());
			redirect('backend/users');
		}
	}

	function update($user_id = NULL)
	{
		$this->j_acl->has_privilege('backend_user_update');

		$user_id = $this->input->post('user_id') ? $this->input->post('user_id') : $user_id;
		$vars['breadcrumb'] = array(
			array('text' => lang('menu_users'), 'url' => site_url('backend/users')),
			array('text' => lang('menu_user_update')),
		);
		$vars['page_title'] = lang('menu_user_update');

		$rules = $this->Users_Model->rules['update'];
        $this->form_validation->set_rules($rules);

		if ($this->form_validation->run() === FALSE)
		{
			if ($user = $this->ion_auth->user((int) $user_id)->row())
			{
				$vars['user'] = $user;
				$vars['groups'] = $this->ion_auth->groups()->result();
				$vars['usergroups'] = array();
				if ($usergroups = $this->ion_auth->get_users_groups($user->id)->result())
				{
					foreach ($usergroups as $group)
					{
						$vars['usergroups'][] = $group->id;
					}
				}
				$this->view('users/update', $vars);
			}
			else
			{
				$this->session->set_flashdata('message_danger', lang('data_not_exist'));
				redirect('backend/users');
			}
		}
		else
		{
			$user_id = $this->input->post('user_id');
			$new_data = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone'),
			);
			if (strlen($this->input->post('password')) >= 6) $new_data['password'] = $this->input->post('password');

			$this->ion_auth->update($user_id, $new_data);

			//Update the groups user belongs to
			$groups = $this->input->post('groups');
			if (isset($groups) && !empty($groups))
			{
				$this->ion_auth->remove_from_group('', $user_id);
				foreach ($groups as $group)
				{
					$this->ion_auth->add_to_group($group, $user_id);
				}
			}

			$this->session->set_flashdata('message_success', $this->ion_auth->messages());
			redirect('backend/users');
		}
	}

	function delete($user_id = NULL)
	{
		$this->j_acl->has_privilege('backend_user_delete');

		$this->ion_auth->delete_user($user_id);
		$this->session->set_flashdata('message_success', $this->ion_auth->messages());
		redirect('backend/users');
	}

	function check_unique_email()
	{
		return $this->Users_Model->check_unique_email();
	}

	function check_unique_username()
	{
		return $this->Users_Model->check_unique_username();
	}
}
?>