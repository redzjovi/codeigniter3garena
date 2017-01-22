<?php
class Backend_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// $this->set_backend(TRUE);
        //
		// // only login users can access Admin Panel
		// $this->verify_login();
	}

	public function view($view, $vars = array(), $return = FALSE, $layout = 'default')
	{
		// $vars = array_merge($this->config_bootstrap, $vars);
		$vars['ion_auth_user'] = $this->ion_auth->user()->row();
		// $vars['left_menu'] = $this->Post_Categories_Model->read();
		// $vars['user_group'] = $this->ion_auth->get_users_groups()->result();

		$template = 'default';

		$vars['top'] = $template.'/backend/_partials/top';
		$vars['left'] = $template.'/backend/_partials/left';
		$vars['messages'] = $template.'/backend/_partials/messages';
		$vars['view'] = $template.'/backend/'.$view;
		$vars['right'] = $template.'/backend/_partials/right';
		$vars['bottom'] = $template.'/backend/_partials/bottom';

		$this->load->view($template.'/backend/_partials/head', $vars);
		$this->load->view($template.'/backend/_layouts/'.$layout, $vars);
		$this->load->view($template.'/backend/_partials/foot', $vars);
	}
}
?>