<?php
class J_acl
{
    private $CI;

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library(['ion_auth', 'session']);
        $this->CI->load->model(['Group_Privileges_Model', 'Privileges_Model', 'User_Privileges_Model']);
	}

	function has_privilege($privilege_code, $user_id = NULL, $redirect = TRUE)
	{
		$privilege_id = $this->CI->Privileges_Model->read_by_privilege_code($privilege_code);
		if ($privilege_id)
			$privilege_id = $privilege_id->id;

		if ($user_id === NULL)
		{
			if ($this->CI->ion_auth->logged_in())
				$user_id = $this->CI->ion_auth->user()->row()->id;
		}

		$this->CI->session->unset_userdata('privileges');
		if (empty($this->CI->session->userdata('privileges')))
		{
			$group_privileges = $this->CI->Group_Privileges_Model->read_by_user_id($user_id)->result_array();
			$group_privileges = array_column($group_privileges, 'privilege_id');

			$user_privileges = $this->CI->User_Privileges_Model->read_by_user_id($user_id)->result_array();
			$user_privileges = array_column($user_privileges, 'privilege_id');

			$privileges = array_unique( array_merge($group_privileges, $user_privileges) );
			$this->CI->session->set_userdata('privileges', $privileges);
		}
		$privileges = $this->CI->session->userdata('privileges');

		$has_privilege = in_array($privilege_id, $privileges);
		if (empty($privilege_code))
			$has_privilege = TRUE;

		if ($has_privilege === FALSE && $redirect === TRUE)
			show_404();

		return $has_privilege;
	}
}
?>