<?php
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Groups extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Groups_Model');
    }

    function index_get($id = NULL)
    {
        if ($id === NULL)
        {
            $groups = $this->ion_auth->groups()->result();

            if ($groups)
            {
                $this->response($groups, REST_Controller::HTTP_OK); // OK (200)
            }
            else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Data not found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
            }
        }
        else
        {
            $group = $this->ion_auth->group((int) $id)->row();

            if ($group)
            {
                $this->set_response($group, REST_Controller::HTTP_OK); // OK (200)
            }
            else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Data not found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
            }
        }
    }

    function create_post()
    {
        $data = $this->input->post();
        $this->form_validation->set_data($data);

        $rules = $this->Groups_Model->rules['create'];
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
            $this->ion_auth->create_group($this->post('group_name'), $this->post('group_description'));
            $this->set_response(['status' => TRUE], REST_Controller::HTTP_CREATED); // CREATED (201)
        }
    }

    function update_post($id = NULL)
    {
        $data = $this->post();
        $data = array('group_id' => $id) + $data;
        $this->form_validation->set_data($data);

        $rules = $this->Groups_Model->rules['update'];
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
            $this->ion_auth->update_group($id, $this->post('group_name'), $this->post('group_description'));
            $this->set_response(['status' => TRUE], REST_Controller::HTTP_OK); // OK (200)
        }
    }

    function delete_get($id = NULL)
    {
        $this->ion_auth->delete_group($id);
        $this->set_response(['status' => TRUE], REST_Controller::HTTP_OK); // OK (200)
    }

    function check_unique_group_name()
	{
		return $this->Groups_Model->check_unique_group_name();
	}
}
?>