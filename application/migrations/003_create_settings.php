<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_settings extends CI_Migration
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
            'project_title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ],
            'company_name' => [
                'type' => 'VARCHAR',
                'constraint' => '70',
                'null' => TRUE,
            ],
            'company_url' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ],
            'img_url' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('settings', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('settings', TRUE);
    }
}
