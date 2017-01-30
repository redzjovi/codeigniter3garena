<?php
class Menus_Model extends CI_Model
{
	private $table = 'menus';

	public $status = array();

	function __construct()
	{
		parent::__construct();
		$this->load->helper('language');
		$this->set_status();
	}

	function create($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function read($array = FALSE, $session = FALSE)
	{
		$this->db->order_by('parent_id');
		$this->db->order_by('position');
		return $this->db->get($this->table);
	}

	function read_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table)->row_array();
	}

	function read_by_code($code, $session = FALSE)
	{
		if ($session === FALSE)
		{
			$this->db->where('code', $code);
			$this->db->order_by('position');
			$data = $this->db->get($this->table)->result_array();
		}
		else if ($session === TRUE)
		{
			if (empty($this->session->userdata($code)))
			{
				$data = $this->read_by_code($code, FALSE);
				$this->session->set_userdata($code, $data);
			}
			else
			{
				$data = $this->session->userdata($code);
			}
		}
		return $data;
	}

	function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}

	function delete($id)
	{
		$this->db->delete('menus', array('id' => $id));
	}

	function set_position($id, $position_to = '0')
	{
		$menu = $this->read_by_id($id);
		$code = $menu['code'];
		$position = $menu['position'];

		$menus = $this->read_by_code($code);

		$i = 0;
		foreach ((array) $menus as $menu)
		{
			if ($menu['position'] > $position_to)
			{
				$new_id = $menu['id'];

				$data = array('position' => $menu['position']);
				$this->db->where('id', $id);
				$this->db->update($this->table, $data);

				$data = array('position' => $position);
				$this->db->where('id', $menu['id']);
				$this->db->update($this->table, $data);

				$i++;
			}
			else if ($menu['position'] < $position_to)
			{
				$new_id = $menu['id'];

				// $data = array('position' => $menu['position']);
				// $this->db->where('id', $id);
				// $this->db->update($this->table, $data);
				//
				// $data = array('position' => $position);
				// $this->db->where('id', $menu['id']);
				// $this->db->update($this->table, $data);

				// $i++;
			}

			if ($position == $position_to) // if position_from == position_to
			{
				break;
			}
			else if ($i === 1)
			{
				echo 'id : '.$new_id.'<br />';
				echo 'position : '.$menu['position'].'<br />';
				$this->set_position($new_id, $menu['position']);
				break;
			}
		}

		if ($position === 0) // position_to === 0
		{
			$data = array('position' => $position_to);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
		}
	}

	function set_position2($id, $position_to = '0')
	{
		$menu = $this->read_by_id($id);
		$code = $menu['code'];
		$position = $menu['position'];

		$menus = $this->read_by_code($code);

		$i = 0;
		foreach ((array) $menus as $menu)
		{
			if ($menu['position'] > $position_to)
			{
				$new_id = $menu['id'];

				$data = array('position' => $menu['position']);
				$this->db->where('id', $id);
				$this->db->update($this->table, $data);

				$data = array('position' => $position);
				$this->db->where('id', $menu['id']);
				$this->db->update($this->table, $data);

				$i++;
			}
			else if ($menu['position'] < $position_to)
			{
				$new_id = $menu['id'];

				// $data = array('position' => $menu['position']);
				// $this->db->where('id', $id);
				// $this->db->update($this->table, $data);
				//
				// $data = array('position' => $position);
				// $this->db->where('id', $menu['id']);
				// $this->db->update($this->table, $data);

				// $i++;
			}

			if ($position == $position_to) // if position_from == position_to
			{
				break;
			}
			else if ($i === 1)
			{
				echo 'id : '.$new_id.'<br />';
				echo 'position : '.$menu['position'].'<br />';
				$this->set_position($new_id, $menu['position']);
				break;
			}
		}

		if ($position === 0) // position_to === 0
		{
			$data = array('position' => $position_to);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
		}
	}

	function set_status()
	{
		$this->status = array(
			'' => '- '.sprintf(lang('select_with_param'), lang('status')).' -',
			'0' => lang('inactive'),
			'1' => lang('active')
		);
		return $this;
	}
}
?>