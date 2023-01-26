<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_product_w_variations extends CI_Migration
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
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'variation_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT  FOREIGN KEY (product_id) REFERENCES products(id)');
        $this->dbforge->add_field('CONSTRAINT  FOREIGN KEY (variation_id) REFERENCES product_variations(id)');
        $this->dbforge->create_table('product_w_variations', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('product_w_variations', TRUE);
    }
}
