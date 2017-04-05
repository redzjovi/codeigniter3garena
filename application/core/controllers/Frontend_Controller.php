<?php
class Frontend_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model(['Menus_Model', 'Settings_Model']);
	}

    public function view($view, $vars = array(), $return = FALSE, $layout = 'default')
    {
        $vars['ion_auth_user'] = $this->ion_auth->user()->row();

        $template = $this->Settings_Model->get_template();

        $vars['top'] = $template.'/frontend/_partials/top';
        $vars['left'] = $template.'/frontend/_partials/left';
        $vars['messages'] = $template.'/frontend/_partials/messages';
        $vars['view'] = $template.'/frontend/'.$view;
        $vars['right'] = $template.'/frontend/_partials/right';
        $vars['bottom'] = $template.'/frontend/_partials/bottom';

        $this->load->view($template.'/frontend/_partials/head', $vars);
        $this->load->view($template.'/frontend/_layouts/'.$layout, $vars);
        $this->load->view($template.'/frontend/_partials/foot', $vars);
    }
}
?>