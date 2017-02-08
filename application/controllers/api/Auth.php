<?php
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_Model');
    }

    function check_login()
    {
        return $this->Users_Model->check_login();
    }

    function login_post()
    {
        $data = $this->input->post();
        $this->form_validation->set_data($data);

        $rules = $this->Users_Model->rules['login'];
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() === FALSE)
        {
            $this->set_response([
                'status' => FALSE,
                'message' => $this->form_validation->error_array(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else
        {
            $user = $this->ion_auth->user()->row();
            $id = $user->id;
            $key = $this->Users_Model->generate_key($id);
            $this->set_response([
                'status' => TRUE,
                'key' => $key
            ], REST_Controller::HTTP_OK); // OK (200)
        }
    }
}
?>