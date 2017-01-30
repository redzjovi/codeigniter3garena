<?php
class Migration_Privileges extends CI_Migration
{
	public function up()
	{
		$this->dbforge->drop_table('privileges', TRUE);
		$this->dbforge->drop_table('group_privileges', TRUE);
		$this->dbforge->drop_table('user_privileges', TRUE);

		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT', 'auto_increment' => TRUE),
			'privilege_code' => array('type' => 'VARCHAR', 'constraint' => '255'),
			'privilege_name' => array('type' => 'VARCHAR', 'constraint' => '255'),
			'privilege_description' => array('type' => 'VARCHAR', 'constraint' => '255'),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('privileges');

		$data = array(
			array('privilege_code' => 'backend_dashboard', 'privilege_name' => 'Backend Dashboard'),
			array('privilege_code' => 'backend_groups', 'privilege_name' => 'Backend Groups View'),
			array('privilege_code' => 'backend_group_create', 'privilege_name' => 'Backend Group Create'),
			array('privilege_code' => 'backend_group_delete', 'privilege_name' => 'Backend Group Delete'),
			array('privilege_code' => 'backend_group_privileges_update', 'privilege_name' => 'Backend Group Privileges Update'),
			array('privilege_code' => 'backend_group_update', 'privilege_name' => 'Backend Group Update'),
			array('privilege_code' => 'backend_menus', 'privilege_name' => 'Backend Menus View'),
			array('privilege_code' => 'backend_menu_create', 'privilege_name' => 'Backend Menu Create'),
			array('privilege_code' => 'backend_menu_delete', 'privilege_name' => 'Backend Menu Delete'),
			array('privilege_code' => 'backend_menu_update', 'privilege_name' => 'Backend Menu Update'),
			array('privilege_code' => 'backend_privileges', 'privilege_name' => 'Backend Privileges View'),
			array('privilege_code' => 'backend_privilege_create', 'privilege_name' => 'Backend Privilege Create'),
			array('privilege_code' => 'backend_privilege_delete', 'privilege_name' => 'Backend Privilege Delete'),
			array('privilege_code' => 'backend_privilege_update', 'privilege_name' => 'Backend Privilege Update'),
			array('privilege_code' => 'backend_settings', 'privilege_name' => 'Backend Settings View'),
			array('privilege_code' => 'backend_users', 'privilege_name' => 'Backend Users View'),
			array('privilege_code' => 'backend_user_create', 'privilege_name' => 'Backend User Create'),
			array('privilege_code' => 'backend_user_delete', 'privilege_name' => 'Backend User Delete'),
			array('privilege_code' => 'backend_user_privileges_update', 'privilege_name' => 'Backend User Privileges Update'),
			array('privilege_code' => 'backend_user_update', 'privilege_name' => 'Backend User Update'),
		);
		$this->db->insert_batch('privileges', $data);

		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT', 'auto_increment' => TRUE),
			'group_id' => array('type' => 'INT'),
			'privilege_id' => array('type' => 'INT'),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('group_privileges');

		$data = array(
			array('group_id' => '1', 'privilege_id' => '1'),
			array('group_id' => '1', 'privilege_id' => '2'),
			array('group_id' => '1', 'privilege_id' => '3'),
			array('group_id' => '1', 'privilege_id' => '4'),
			array('group_id' => '1', 'privilege_id' => '5'),
			array('group_id' => '1', 'privilege_id' => '6'),
			array('group_id' => '1', 'privilege_id' => '7'),
			array('group_id' => '1', 'privilege_id' => '8'),
			array('group_id' => '1', 'privilege_id' => '9'),
			array('group_id' => '1', 'privilege_id' => '10'),
			array('group_id' => '1', 'privilege_id' => '11'),
			array('group_id' => '1', 'privilege_id' => '12'),
			array('group_id' => '1', 'privilege_id' => '13'),
			array('group_id' => '1', 'privilege_id' => '14'),
			array('group_id' => '1', 'privilege_id' => '15'),
			array('group_id' => '1', 'privilege_id' => '16'),
			array('group_id' => '1', 'privilege_id' => '17'),
			array('group_id' => '1', 'privilege_id' => '18'),
			array('group_id' => '1', 'privilege_id' => '19'),
			array('group_id' => '1', 'privilege_id' => '20'),
		);
		$this->db->insert_batch('group_privileges', $data);

		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT', 'auto_increment' => TRUE),
			'user_id' => array('type' => 'INT'),
			'privilege_id' => array('type' => 'INT'),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('user_privileges');
	}

	public function down()
	{
		$this->dbforge->drop_table('privileges', TRUE);
		$this->dbforge->drop_table('group_privileges', TRUE);
		$this->dbforge->drop_table('user_privileges', TRUE);
	}
}
?>