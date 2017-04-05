<?php
class Teams_Model extends CI_Model
{
    private $table = 'teams';

    public $rules = array(
        'registration' => array(
            array('field' => 'team_name', 'label' => 'lang:team_name', 'rules' => 'required|alpha_numeric_dash|min_length[4]|max_length[15]|is_unique[teams.team_name]'),
            array('field' => 'agreement', 'label' => 'lang:agreement', 'rules' => 'required'),
        ),
	);

    public function create($data)
    {
        $data = array(
            'team_name' => $data['team_name'],
            'user_id' => $data['user_id'],
        );
        $this->db->insert($this->table, $data);
		return $this->db->insert_id();
    }

    public function is_registered_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
		$count = $this->db->count_all_results($this->table);

        if ($count == 0)
            $exist = false;
        else
            $exist = true;

        return $exist;
    }
}
