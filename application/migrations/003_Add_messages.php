<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_messages extends CI_Migration {
  
  public function up() {
    $this->dbforge->add_field(
      array(
        'message_id' => array(
          'type' => 'int',
          'constraint' => 11,
          'null' => false,
          'auto_increment' => true
        ),
        'sender_name' => array(
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false
        ),
        'sender_email' => array (
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false
        ),
        'subject' => array(
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false
        ),
        'message_text' => array(
          'type' => 'text',
          'null' => false
        ),
      )
    );
    $this->dbforge->add_key('message_id', true);
    $this->dbforge->create_table('messages');
  }

  public function down() {
    $this->dbforge->drop_table('messages');
  }

}