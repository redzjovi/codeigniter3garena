<?php
class Dashboard extends Backend_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$vars['page_title'] = lang('menu_dashboard');
		$this->view('dashboard/index', $vars);
	}
}
?>