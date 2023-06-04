<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_articles extends CI_Migration {
  
  public function up() {
    $this->dbforge->add_field(
      array(
        'article_id' => array(
          'type' => 'int',
          'constraint' => 11,
          'null' => false,
          'auto_increment' => true
        ),
        'article_title' => array(
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false
        ),
        'article_type' => array (
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false
        ),
        'article_desc' => array(
          'type' => 'text',
          'null' => false
        ),
        'article_content' => array(
          'type' => 'text',
          'null' => false
        ),
        'author' => array(
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false
        ),
        'created' => array(
          'type' => 'int',
          'constraint' => 21,
          'null' => true
        ),
        'updated' => array(
          'type' => 'int',
          'constraint' => 21,
          'null' => true
        ),
        'num_view' => array(
          'type' => 'int',
          'constraint' => 11,
          'null' => true
        ),
        'num_like' => array(
          'type' => 'int',
          'constraint' => 11,
          'null' => true
        ),
        'image' => array(
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false
        )
      )
    );
    $this->dbforge->add_key('article_id', true);
    $this->dbforge->create_table('articles');
  }

  public function down() {
    $this->dbforge->drop_table('articles');
  }

}