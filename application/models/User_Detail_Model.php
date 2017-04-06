<?php
class User_Detail_Model extends CI_Model
{
    private $table = 'user_detail';

    public $gender;

    public $rules = array(
        'register' => array(
            array('field' => 'full_name', 'label' => 'lang:full_name', 'rules' => 'required|alpha_space'),
        ),
	);

    public function getGender()
    {
        $this->gender = array('1' => lang('man'), '0' => lang('woman'));
        return $this->gender;
    }

    public function tournament_register($data)
    {
        $data = array(
            'full_name' => $data['full_name'],
            'phone_number' => $data['phone_number'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'user_id' => $data['user_id'],
        );
        $this->db->insert($this->table, $data);
    }
}
