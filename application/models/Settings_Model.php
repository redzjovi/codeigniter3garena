<?php
class Settings_Model extends CI_Model
{
    private $template = 'default';

    function get_template()
    {
        return $this->template;
    }
}