<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_products extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('products', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('products', TRUE);
    }
}
