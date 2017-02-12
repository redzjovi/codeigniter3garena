<?php
class User_Privileges_Model extends CI_Model
{
	private $table = 'user_privileges';

	public $rules = array(
		'update' => array(
			array('field' => 'id', 'label' => 'lang:id', 'rules' => 'trim|integer|required'),
		),
	);

	function read()
    {
		$this->db->order_by('privilege_code');
		return $this->db->get($this->table);
	}

	function read_by_user_id($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->get($this->table);
    }

	function update($id, $data)
    {
		if ($data['privilege_id'])
		{
			foreach ((array) $data['privilege_id'] as $privilege_id)
			{
				$this->db->where('user_id', $id);
				$this->db->where('privilege_id', $privilege_id);
				$count = $this->db->count_all_results($this->table);

				if ($count == 0)
					$this->db->insert($this->table, ['user_id' => $id, 'privilege_id' => $privilege_id]);
			}
		}

		$this->db->where('user_id', $id);
		if ($data['privilege_id']);
			$this->db->where_not_in('privilege_id', $data['privilege_id']);
		$this->db->delete($this->table);
    }
}
?>