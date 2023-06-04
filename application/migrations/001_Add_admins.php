<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_admins extends CI_Migration {

  public function up() {
    $this->dbforge->add_field(
      array(
        'admin_id' => array(
          'type' => 'int',
          'constraint' => 11,
          'null' => false,
          'auto_increment' => true
        ),
        'fullname' => array(
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false,
        ),
        'username' => array(
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false,
        ),
        'email' => array(
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false,
        ),
        'password' => array(
          'type' => 'text',
          'null' => false,
        )
      )
    );
    $this->dbforge->add_key('admin_id', true);
    $this->dbforge->create_table('admins');
  }

  public function down() {
    $this->dbforge->drop_table('admins');
  }

}