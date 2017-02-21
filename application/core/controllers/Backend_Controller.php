<?php
class Backend_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Menus_Model', 'Settings_Model']);
	}

	public function view($view, $vars = array(), $return = FALSE, $layout = 'default')
	{
		$vars['backend_top'] = build_tree( $this->Menus_Model->read_by_code('backend_top', FALSE) );
		$vars['ion_auth_user'] = $this->ion_auth->user()->row();

		$template = $this->Settings_Model->get_template();

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