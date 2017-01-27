<?php
class J_auth
{
    private $backend = TRUE;
    private $backend_url = 'backend/admin';
    private $CI;

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('ion_auth');
    }

    public function logged_in($redirect = FALSE)
    {
        $logged_in = $this->CI->ion_auth->logged_in();
        if ($logged_in === FALSE)
        {
            if ($redirect === TRUE)
            {
                if ($this->backend === TRUE)
                    redirect($this->backend_url);
                else
                    show_404();
            }
        }

        return $logged_in;
    }

    public function set_backend($param = TRUE)
    {
        $this->backend = $param;
        return $this;
    }
}
?>