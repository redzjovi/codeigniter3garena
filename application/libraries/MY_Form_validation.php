<?php
class MY_Form_validation extends CI_Form_validation
{
    public function __construct()
    {
        parent::__construct();
    }

    public function alpha_numeric_dash($string)
    {
        return ( ! preg_match("/^([-a-z0-9_])+$/i", $string)) ? FALSE : TRUE;
    }

    public function alpha_space($string)
    {
        return ( ! preg_match("/^([-a-z ])+$/i", $string)) ? FALSE : TRUE;
    }
}
