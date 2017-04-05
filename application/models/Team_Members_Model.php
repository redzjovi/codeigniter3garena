<?php
class Team_Members_Model extends CI_Model
{
    private $table = 'team_members';

    public $rules = array(
        'registration' => array(
            array('field' => 'full_name[0]', 'label' => 'lang:captain_full_name', 'rules' => 'required|alpha_space'),
            array('field' => 'phone_number[0]', 'label' => 'lang:captain_phone_number', 'rules' => 'required|numeric|min_length[7]|max_length[14]'),
            array('field' => 'full_name[1]', 'label' => 'lang:member_full_name_1', 'rules' => 'required|alpha_space'),
            array('field' => 'phone_number[1]', 'label' => 'lang:member_phone_number_1', 'rules' => 'required|numeric|min_length[7]|max_length[14]'),
            array('field' => 'full_name[2]', 'label' => 'lang:member_full_name_2', 'rules' => 'required|alpha_space'),
            array('field' => 'phone_number[2]', 'label' => 'lang:member_phone_number_2', 'rules' => 'required|numeric|min_length[7]|max_length[14]'),
        ),
	);

    public function create($data)
    {
        $x = 1;
        foreach ($data['full_name'] as $key => $value)
        {
            $data_insert = array(
                'full_name' => $data['full_name'][$key],
                'phone_number' => $data['phone_number'][$key],
                'gender' => $data['gender'][$key],
                'captain' => ($x === 1 ? $x : '0'),
                'team_id' => $data['team_id'],
            );
            $this->db->insert($this->table, $data_insert);
    		$x++;
        }
    }
}
