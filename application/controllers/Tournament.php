<?php
class Tournament extends Frontend_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'Team_Members_Model',
            'Teams_Model',
            'User_Detail_Model',
            'Users_Model',
        ]);
    }

    public function index()
    {
        $vars['page_title'] = 'Garena Tournament 3 vs 3';
        $this->view('tournament/index', $vars);
    }

    public function check_login_username()
	{
		return $this->Users_Model->check_login_username();
	}

    public function login()
    {
        $logged_in = $this->j_auth->logged_in(FALSE);
		if ($logged_in === TRUE)
         	redirect('tournament/registration');

        $rules = $this->Users_Model->rules['login_tournament'];
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() === TRUE)
        {
            redirect('tournament/registration');
        }
        else
        {
            $vars['page_title'] = lang('login');
            $this->view('tournament/login', $vars);
        }
    }

    public function logout()
	{
		$this->ion_auth->logout();
		$this->session->sess_destroy();
		redirect('tournament/login');
	}

    public function register()
    {
        $logged_in = $this->j_auth->logged_in(FALSE);
		if ($logged_in === true) // check if logged in == true
        {
            if ($this->Teams_Model->is_registered_user_id($this->ion_auth->user()->row()->id) === true) // check if registered
                redirect('tournament/successful_registration');

            redirect('tournament/registration');
        }

        $rules = $this->Users_Model->rules['register']; // rules users
        $this->form_validation->set_rules($rules);

        $rules = $this->User_Detail_Model->rules['register']; // rules user_detail
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() === TRUE)
        {
            $data = $this->input->post();
            $data['user_id'] = $this->Users_Model->tournament_register($data); // create users
            $this->User_Detail_Model->tournament_register($data); // create user detail

            $this->session->set_flashdata('message_success', lang('data_create_success'));
            redirect('tournament/login');
        }
        else
        {
            $vars['page_title'] = lang('account_registration');
            $this->view('tournament/register', $vars);
        }
    }

    public function registration()
    {
        $logged_in = $this->j_auth->logged_in(FALSE);
		if ($logged_in === FALSE) // check if logged in == false
         	redirect('tournament/login');

        if ($this->Teams_Model->is_registered_user_id($this->ion_auth->user()->row()->id) === true) // check if registered
            redirect('tournament/successful_registration');

        $rules = $this->Teams_Model->rules['registration']; // rules teams
        $this->form_validation->set_rules($rules);

        $rules = $this->Team_Members_Model->rules['registration']; // rules team member
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() === TRUE)
        {
            $data = $this->input->post();
            $data['user_id'] = $this->ion_auth->user()->row()->id;
            $data['team_id'] = $this->Teams_Model->create($data); // create team
            $this->Team_Members_Model->create($data); // create team members

            redirect('tournament/successful_registration');
        }
        else
        {
            $vars['page_title'] = lang('registration_form');
            $vars['user'] = $this->ion_auth->user()->row();
            $vars['user_detail'] = $this->User_Detail_Model->read_by_user_id($this->ion_auth->user()->row()->id);
            $this->view('tournament/registration', $vars);
        }
    }

    public function successful_registration()
    {
        $vars['page_title'] = lang('successful_registration').'!';
        $vars['user_detail'] = $this->User_Detail_Model->read_by_user_id($this->ion_auth->user()->row()->id);
        $this->view('tournament/successful_registration', $vars);
    }
}
