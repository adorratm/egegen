<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	// Variables
	public $viewData = null;

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->viewData = new stdClass();
		$this->viewData->viewFolder = "dashboard";
		$this->viewData->subViewFolder = "list";
		if (!get_active_user()) :
			redirect(base_url("panel/login"));
		endif;
		$this->viewData->settings = get_settings();
	}

	// Index
	public function index()
	{
		$this->render();
	}

	// Render
	public function render()
	{
		$this->load->view('backend/layout/index', (array)$this->viewData);
	}
}
