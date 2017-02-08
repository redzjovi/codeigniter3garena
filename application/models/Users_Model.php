<?php
class Users_Model extends CI_Model
{
    public $rules = array(
        'login' => array(
            array('field' => 'email', 'label' => 'lang:email', 'rules' => 'required|valid_email'),
            array('field' => 'password', 'label' => 'lang:password', 'rules' => 'required'),
            array('field' => 'remember_me', 'label' => 'lang:remember_me', 'rules' => 'integer'),
            array('field' => 'login', 'label' => 'lang:login', 'rules' => 'callback_check_login'),
        ),
    );

    private $table = 'users';

    function check_login()
	{
        $email = $this->input->post('email');
		$password = $this->input->post('password');
        $remember = (bool) $this->input->post('remember_me');

        if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
        {
            $response = TRUE;
        }
        else
        {
            $this->ion_auth->set_error_delimiters('', '');
            $this->form_validation->set_message('check_login', $this->ion_auth->errors());
			$response = FALSE;
        }

        return $response;
	}

    function generate_key($id)
    {
        $key = $id.strtotime(date('Y-m-d H:i:s'));
        $key = md5($key);

        $count = $this->db->where('user_id', $id)->count_all_results('keys');

        if ($count == 0)
        {
            $data = array('user_id' => $id, 'key' => $key);
            $this->db->insert('keys', $data);
        }
        else
        {
            $data = array('key' => $key);
            $this->db->where('id', $id)->update('keys', $data);
        }

        return $key;
    }
}
?>