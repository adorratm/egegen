<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_user_seeder extends CI_Migration
{
    private $seedData = null;

    public function __construct()
    {
        parent::__construct();
        $this->seedData = [
            'first_name' => 'EMRE',
            'last_name' => 'KILIÇ',
            'email' => 'emrekilic19983@gmail.com',
            'password' => password_hash('123456',PASSWORD_DEFAULT)
        ];
    }

    public function up()
    {
        $this->db->insert("users", $this->seedData);
    }

    public function down()
    {
        $this->db->where("email", $this->seedData["email"])->delete('users');
    }
}
