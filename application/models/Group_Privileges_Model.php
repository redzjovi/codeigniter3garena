<?php
class Group_Privileges_Model extends CI_Model
{
	function read()
    {
		$this->db->order_by('privilege_code');
		return $this->db->get('group_privileges');
	}

	function read_by_group_id($id)
    {
        $this->db->where('group_id', $id);
        return $this->db->get('group_privileges');
    }

	function read_by_user_id($id)
    {
		$this->db->from('group_privileges');
		$this->db->join('users_groups', 'group_privileges.group_id = users_groups.group_id');
		$this->db->where('users_groups.user_id', $id);
        return $this->db->get();
    }

	function update($id, $data)
    {
		if ($data['privilege_id'])
		{
			foreach ((array) $data['privilege_id'] as $privilege_id)
			{
				$this->db->where('group_id', $id);
				$this->db->where('privilege_id', $privilege_id);
				$count = $this->db->count_all_results('group_privileges');

				if ($count == 0)
					$this->db->insert('group_privileges', ['group_id' => $id, 'privilege_id' => $privilege_id]);
			}
		}

		$this->db->where('group_id', $id);
		if ($data['privilege_id']);
			$this->db->where_not_in('privilege_id', $data['privilege_id']);
		$this->db->delete('group_privileges');
    }
}
?>