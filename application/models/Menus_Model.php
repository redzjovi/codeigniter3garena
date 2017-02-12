<?php
class Menus_Model extends CI_Model
{
	private $table = 'menus';

	public $rules = array(
		'create' => array(
			array('field' => 'code', 'label' => 'lang:code', 'rules' => 'trim|required'),
			array('field' => 'status', 'label' => 'lang:status', 'rules' => 'trim|required|numeric'),
		),
		'update' => array(
			array('field' => 'code', 'label' => 'lang:code', 'rules' => 'trim|required'),
			array('field' => 'status', 'label' => 'lang:status', 'rules' => 'trim|required|numeric'),
			array('field' => 'id', 'label' => 'lang:id', 'rules' => 'trim|integer|required'),
		),
	);

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
			$this->db->select('t.*');
			$this->db->select('t2.text AS parent_text');
			$this->db->from($this->table.' AS t');
			$this->db->join($this->table.' AS t2', 't2.id = t.parent_id', 'left');
			$this->db->where('t.code', $code);
			$this->db->order_by('position');
			$data = $this->db->get()->result_array();
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
		$this->db->delete($this->table, array('id' => $id));
	}

	function set_position($id, $position_to = '0')
	{
		$menu = $this->read_by_id($id);
		$code = $menu['code'];
		$position = $menu['position'];

		$menus = $this->read_by_code($code);

		$data_id = array_column($menus, 'id');
		$data_position = array_column($menus, 'position');
		// pr($data_id);
		// pr($data_position);

		$position_from = array_search($id, $data_id);
		// pr($position_from);
		// pr($position_to);

		if ($position_from + 1 == $position_to) {}
		else
		{
			array_splice($data_id, $position_to, 0, array($id));
			// pr($data_id);

			if ($position_from > $position_to)
				unset($data_id[$position_from + 1]);
			else if ($position_from < $position_to)
				unset($data_id[$position_from]);

			$data_id = array_values($data_id);
			// pr($data_id);

			foreach ((array) $data_id as $key => $value)
			{
				$data = array('position' => $data_position[$key]);
				$this->db->where('id', $data_id[$key]);
				$this->db->update($this->table, $data);
			}
		}
		// die;
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