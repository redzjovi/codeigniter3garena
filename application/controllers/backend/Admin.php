<?php
class Admin extends Backend_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Users_Model');
	}

	function index()
	{
		$logged_in = $this->j_auth->logged_in(FALSE);
		if ($logged_in === TRUE)
         	redirect('backend/dashboard');

		$vars['page_title'] = lang('menu_admin');

		$rules = $this->Users_Model->rules['login'];
        $this->form_validation->set_rules($rules);

		if ($this->form_validation->run() === TRUE)
		{
			redirect('backend/dashboard');
		}
		else
		{
			$vars['message'] = validation_errors();
			$this->view('admin/index', $vars, null, 'login');
		}
	}

	function logout()
	{
		$this->ion_auth->logout();
		$this->session->sess_destroy();
		redirect('backend/admin');
	}

	function check_login()
	{
		return $this->Users_Model->check_login();
	}
}
?>