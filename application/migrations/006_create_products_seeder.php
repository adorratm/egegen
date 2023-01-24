<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_products_seeder extends CI_Migration
{
    private $seedData = null;

    public function __construct()
    {
        parent::__construct();
        $this->seedData = [
            'title' => 'Demo Product',
        ];
    }

    public function up()
    {
        $this->db->insert("products", $this->seedData);
    }

    public function down()
    {
        $this->db->where("title", $this->seedData["title"])->delete('products');
    }
}
