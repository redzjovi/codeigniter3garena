<?php
class Migration_Rest extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT', 'auto_increment' => TRUE),
			'user_id' => array('type' => 'INT'),
			'key' => array('type' => 'VARCHAR', 'constraint' => '40'),
			'level' => array('INT' => 'INT', 'constraint' => '2'),
			'ignore_limits' => array('type' => 'TINYINT', 'constraint' => '1', 'default' => '0'),
			'date_created' => array('type' => 'TIMESTAMP'),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('keys');
	}

	public function down()
	{
		$this->dbforge->drop_table('keys', TRUE);
	}
}
?>