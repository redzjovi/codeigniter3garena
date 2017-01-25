<?php
class User_Privileges_Model extends CI_Model
{
	function read()
    {
		$this->db->order_by('privilege_code');
		return $this->db->get('user_privileges');
	}

	function read_by_user_id($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->get('user_privileges');
    }

	function update($id, $data)
    {
		if ($data['privilege_id'])
		{
			foreach ((array) $data['privilege_id'] as $privilege_id)
			{
				$this->db->where('user_id', $id);
				$this->db->where('privilege_id', $privilege_id);
				$count = $this->db->count_all_results('user_privileges');

				if ($count == 0)
					$this->db->insert('user_privileges', ['user_id' => $id, 'privilege_id' => $privilege_id]);
			}
		}

		$this->db->where('user_id', $id);
		if ($data['privilege_id']);
			$this->db->where_not_in('privilege_id', $data['privilege_id']);
		$this->db->delete('user_privileges');
    }
}
?>