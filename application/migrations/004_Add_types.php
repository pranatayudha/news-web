<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_types extends CI_Migration {
  
  public function up() {
    $this->dbforge->add_field(
      array(
        'type_id' => array(
          'type' => 'int',
          'constraint' => 11,
          'null' => false,
          'auto_increment' => true
        ),
        'type_name' => array(
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false
        ),
        'class' => array (
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false
        )
      )
    );
    $this->dbforge->add_key('type_id', true);
    $this->dbforge->create_table('types');
  }

  public function down() {
    $this->dbforge->drop_table('types');
  }

}