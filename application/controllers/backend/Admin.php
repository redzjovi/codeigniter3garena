<?php
class Admin extends Backend_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
        if ($this->ion_auth->logged_in())
        {
            redirect('backend/dashboard');
        }

		$vars['page_title'] = lang('menu_admin');

		if ($this->input->post())
		{
			$this->form_validation->set_rules('email', lang('email'), 'required|valid_email');
			$this->form_validation->set_rules('password', lang('password'), 'required');
			$this->form_validation->set_rules('remember_me', lang('remember_me'), 'integer');

			if ($this->form_validation->run() === TRUE)
			{
				$remember = (bool) $this->input->post('remember_me');
				if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
				{
					redirect('backend/dashboard');
				}
				else
				{
					$vars['message'] = $this->ion_auth->errors();
				}
			}
			else
			{
				$vars['message'] = validation_errors();
			}
		}

		$this->view('admin/index', $vars, null, 'login');
	}

	function logout()
	{
		$this->ion_auth->logout();
		$this->session->sess_destroy();
		redirect('backend/admin');
	}
}
?>