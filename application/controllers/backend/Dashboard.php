<?php
class Dashboard extends Backend_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->Privileges_Model->has_privilege('backend_dashboard');
		
		$vars['page_title'] = lang('menu_dashboard');
		$this->view('dashboard/index', $vars);
	}
}
?>