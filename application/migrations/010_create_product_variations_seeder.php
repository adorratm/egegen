<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_product_variations_seeder extends CI_Migration
{
    private $seedData = null;

    public function __construct()
    {
        parent::__construct();
        $this->seedData = [
            'title' => 'Demo Product Variation',
        ];
    }

    public function up()
    {
        $this->db->insert("product_variations", $this->seedData);
        $variation_id = $this->db->insert_id();
        $product_id = $this->db->where(["title" => "Demo Product"])->get('products')->row()->id;
        if ($product_id) :
            $this->db->insert("product_w_variations", ["product_id" => $product_id, "variation_id" => $variation_id]);
        endif;
    }

    public function down()
    {
        $product_id = $this->db->where(["title" => "Demo Product"])->get('products')->row()->id;
        if ($product_id) :
            $this->db->where("product_id", $product_id)->delete('product_w_variations');
        endif;
    }
}
