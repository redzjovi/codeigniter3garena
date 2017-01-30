<?php
class Migration_Menus extends CI_Migration
{
	public function up()
	{
		$this->dbforge->drop_table('menus', TRUE);

		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT', 'auto_increment' => TRUE),
			'code' => array('type' => 'VARCHAR', 'constraint' => '255'),
			'privilege_code' => array('type' => 'VARCHAR', 'constraint' => '255'),
			'icon' => array('type' => 'VARCHAR', 'constraint' => '255'),
			'text_language' => array('type' => 'VARCHAR', 'constraint' => '255'),
			'text' => array('type' => 'VARCHAR', 'constraint' => '255'),
			'url' => array('type' => 'VARCHAR', 'constraint' => '255'),
			'url_external' => array('type' => 'VARCHAR', 'constraint' => '255'),
			'parent_id' => array('type' => 'INT'),
			'position' => array('type' => 'INT'),
			'status' => array('type' => 'TINYINT', 'constraint' => '1'),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('menus');

		$data = array(
			array('code' => 'backend_top', 'privilege_code' => 'backend_dashboard', 'icon' => 'glyphicon glyphicon-home', 'text_language' => 'menu_dashboard', 'text' => 'Dashboard', 'url' => 'backend/dashboard', 'parent_id' => '0', 'position' => '1', 'status' => '1'),
			array('code' => 'backend_top', 'privilege_code' => 'backend_settings', 'icon' => 'glyphicon glyphicon-cog', 'text_language' => 'menu_settings', 'text' => 'Settings', 'url' => '', 'parent_id' => '0', 'position' => '2', 'status' => '1'),
			array('code' => 'backend_top', 'privilege_code' => 'backend_privileges', 'icon' => 'glyphicon glyphicon-eye-open', 'text_language' => 'menu_privileges', 'text' => 'Privileges', 'url' => 'backend/privileges', 'parent_id' => '2', 'position' => '3', 'status' => '1'),
			array('code' => 'backend_top', 'privilege_code' => 'backend_groups', 'icon' => 'glyphicon glyphicon-th-large', 'text_language' => 'menu_groups', 'text' => 'Groups', 'url' => 'backend/groups', 'parent_id' => '2', 'position' => '4', 'status' => '1'),
			array('code' => 'backend_top', 'privilege_code' => 'backend_users', 'icon' => 'glyphicon glyphicon-user', 'text_language' => 'menu_users', 'text' => 'Users', 'url' => 'backend/users', 'parent_id' => '2', 'position' => '5', 'status' => '1'),
			array('code' => 'backend_top', 'privilege_code' => 'backend_menus', 'icon' => 'glyphicon glyphicon-th-list', 'text_language' => 'menu_menus', 'text' => 'Menus', 'url' => 'backend/menus', 'parent_id' => '2', 'position' => '6', 'status' => '1'),
		);
		$this->db->insert_batch('menus', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('menus', TRUE);
	}
}
?>