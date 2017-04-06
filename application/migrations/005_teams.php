<?php
class Migration_Teams extends CI_Migration
{
	public function up()
	{
        $this->dbforge->drop_table('team_members', TRUE);
		$this->dbforge->drop_table('teams', TRUE);
		$this->dbforge->drop_table('user_detail', TRUE);

		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT', 'auto_increment' => TRUE),
			'full_name' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'phone_number' => array('type' => 'VARCHAR', 'constraint' => '255'),
			'gender' => array('type' => 'TINYINT', 'constraint' => '1'),
            'captain' => array('type' => 'TINYINT', 'constraint' => '1'),
            'team_id' => array('type' => 'INT'),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('team_members');

        $this->dbforge->add_field(array(
			'id' => array('type' => 'INT', 'auto_increment' => TRUE),
			'team_name' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'user_id' => array('type' => 'INT'),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('teams');

        $this->dbforge->add_field(array(
			'id' => array('type' => 'INT', 'auto_increment' => TRUE),
			'full_name' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'phone_number' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'gender' => array('type' => 'TINYINT', 'constraint' => '1'),
            'address' => array('type' => 'TEXT'),
            'user_id' => array('type' => 'INT'),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('user_detail');

        $data = array(
			array('full_name' => 'Member One', 'phone_number' => '12345', 'gender' => '1', 'address' => '', 'user_id' => '3'),
		);
		$this->db->insert_batch('user_detail', $data);
	}

	public function down()
	{
        $this->dbforge->drop_table('team_members', TRUE);
		$this->dbforge->drop_table('teams', TRUE);
		$this->dbforge->drop_table('user_detail', TRUE);
	}
}
?>