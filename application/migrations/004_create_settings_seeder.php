<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_settings_seeder extends CI_Migration
{
    private $seedData = null;

    public function __construct()
    {
        parent::__construct();
        $this->seedData = [
            'project_title' => 'Egegen Job Application Task',
            'company_name' => 'Egegen',
            'company_url' => 'https://egegen.com/',
            'img_url' => NULL
        ];
    }

    public function up()
    {
        $this->db->insert("settings", $this->seedData);
    }

    public function down()
    {
        $this->db->where("company_name", $this->seedData["company_name"])->delete('settings');
    }
}
