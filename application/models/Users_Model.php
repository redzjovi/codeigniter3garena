<?php
class Users_Model extends CI_Model
{
    private $table = 'users';

    public $rules = array(
        'login' => array(
            array('field' => 'email', 'label' => 'lang:email', 'rules' => 'required|valid_email'),
            array('field' => 'password', 'label' => 'lang:password', 'rules' => 'required'),
            array('field' => 'remember_me', 'label' => 'lang:remember_me', 'rules' => 'integer'),
            array('field' => 'login', 'label' => 'lang:login', 'rules' => 'callback_check_login'),
        ),
        'login_tournament' => array(
            array('field' => 'username', 'label' => 'lang:username', 'rules' => 'required|alpha_numeric|min_length[6]|max_length[15]'),
            array('field' => 'password', 'label' => 'lang:password', 'rules' => 'required|min_length[8]|max_length[16]'),
            array('field' => 'login', 'label' => 'lang:login', 'rules' => 'callback_check_login_username'),
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
            array('field' => 'username', 'label' => 'lang:username', 'rules' => 'trim|required|callback_check_unique_username'),
            array('field' => 'email', 'label' => 'lang:email', 'rules' => 'trim|required|valid_email|callback_check_unique_email'),
            array('field' => 'password', 'label' => 'lang:password', 'rules' => 'min_length[6]'),
            array('field' => 'password_confirm', 'label' => 'lang:password_confirm', 'rules' => 'matches[password]'),
            array('field' => 'groups[]', 'label' => 'lang:groups', 'rules' => 'required|integer'),
            array('field' => 'user_id', 'label' => 'lang:user_id', 'rules' => 'trim|integer|required'),
        ),
	);

    public function check_login()
	{
        $email = $this->input->post('email');
		$password = $this->input->post('password');
        $remember = (bool) $this->input->post('remember_me');

        if ($this->ion_auth->login($username, $password, $remember))
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

    public function check_login_username()
	{
        $username = $this->input->post('username');
		$password = $this->input->post('password');
        $remember = (bool) $this->input->post('remember_me');

        $this->ion_auth_model->identity_column = 'username';
        if ($this->ion_auth->login($username, $password, $remember))
        {
            $response = TRUE;
        }
        else
        {
            $this->ion_auth->set_error_delimiters('', '');
            $this->form_validation->set_message('check_login_username', $this->ion_auth->errors());
			$response = FALSE;
        }

        return $response;
	}

    public function generate_key($id)
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

    public function check_unique_email()
	{
		$id = $this->input->post('user_id');
		$email = $this->input->post('email');
		$result = $this->count_unique_email($id, $email);

		if ($result == 0)
		{
			$response = true;
		}
		else
		{
			$this->form_validation->set_message(
				'check_unique_email',
				sprintf(lang('unique_with_param'), lang('email'))
			);
			$response = false;
		}
		return $response;
	}

    public function check_unique_username()
	{
		$id = $this->input->post('user_id');
		$username = $this->input->post('username');
		$result = $this->count_unique_username($id, $username);

		if ($result == 0)
		{
			$response = true;
		}
		else
		{
			$this->form_validation->set_message(
				'check_unique_username',
				sprintf(lang('unique_with_param'), lang('username'))
			);
			$response = false;
		}
		return $response;
	}

	public function count_unique_email($id, $email)
	{
		$this->db->where('email', $email);
		$this->db->where_not_in('id', $id);
		return $this->db->count_all_results($this->table);
	}

    public function count_unique_username($id, $username)
	{
		$this->db->where('username', $username);
		$this->db->where_not_in('id', $id);
		return $this->db->count_all_results($this->table);
	}
}
?>