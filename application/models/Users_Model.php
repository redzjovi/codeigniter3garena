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
        'create' => array(
            array('field' => 'first_name', 'label' => 'lang:first_name', 'rules' => 'trim'),
            array('field' => 'last_name', 'label' => 'lang:last_name', 'rules' => 'trim'),
            array('field' => 'company', 'label' => 'lang:company', 'rules' => 'trim'),
            array('field' => 'phone', 'label' => 'lang:phone', 'rules' => 'trim'),
            array('field' => 'username', 'label' => 'lang:username', 'rules' => 'trim|required|is_unique[users.username]'),
            array('field' => 'email', 'label' => 'lang:email', 'rules' => 'trim|required|valid_email|is_unique[users.email]'),
            array('field' => 'password', 'label' => 'lang:password', 'rules' => 'required'),
            array('field' => 'password_confirm', 'label' => 'lang:password_confirm', 'rules' => 'required|matches[password]'),
            array('field' => 'groups[]', 'label' => 'lang:groups', 'rules' => 'required|integer'),
        ),
        'update' => array(
            array('field' => 'first_name', 'label' => 'lang:first_name', 'rules' => 'trim'),
            array('field' => 'last_name', 'label' => 'lang:last_name', 'rules' => 'trim'),
            array('field' => 'company', 'label' => 'lang:company', 'rules' => 'trim'),
            array('field' => 'phone', 'label' => 'lang:phone', 'rules' => 'trim'),
            array('field' => 'username', 'label' => 'lang:username', 'rules' => 'trim|required'),
            array('field' => 'email', 'label' => 'lang:email', 'rules' => 'trim|required|valid_email'),
            array('field' => 'password', 'label' => 'lang:password', 'rules' => 'min_length[6]'),
            array('field' => 'password_confirm', 'label' => 'lang:password_confirm', 'rules' => 'matches[password]'),
            array('field' => 'groups[]', 'label' => 'lang:groups', 'rules' => 'required|integer'),
            array('field' => 'user_id', 'label' => 'lang:user_id', 'rules' => 'trim|integer|required'),
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