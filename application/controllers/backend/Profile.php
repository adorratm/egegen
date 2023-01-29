<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
		$this->viewData->viewFolder = "profile";
		$this->viewData->subViewFolder = "update";
		if (!get_active_user()) :
			redirect(base_url("panel/login"));
		endif;
		$this->viewData->settings = get_settings();
	}

	// Index
	public function index($id = null)
	{
		$alert = [
			"title" => lang("error"),
			"text" => lang("user_not_found"),
			"type" => "error"
		];
		if ($id) :
			$user = $this->general_model->get("users", null, ["id" => $id]);
			if ($user) :
				$this->viewData->user = $user;
				$this->render();
				return;
			endif;
		endif;
		$this->session->set_flashdata("alert", $alert);
		redirect(base_url("panel"));
	}

	// Render
	public function render()
	{
		$this->load->view('backend/layout/index', (array)$this->viewData);
	}

	// Update
	public function update($id = null)
	{
		$alert = [
			"title" => lang("error"),
			"text" => lang("user_not_found"),
			"type" => "error"
		];
		if ($id) :
			$user = $this->general_model->get("users", null, ["id" => $id]);
			if ($user) :
				$this->load->library("form_validation");
				$this->form_validation->set_rules("first_name", lang("first_name"), "required|trim|min_length[2]|max_length[70]");
				$this->form_validation->set_rules("last_name", lang("last_name"), "required|trim|min_length[2]|max_length[70]");
				$this->form_validation->set_rules("email", lang("email"), "required|trim|valid_email|min_length[2]|max_length[255]");
				$this->form_validation->set_rules("password", lang("password"), "trim|min_length[6]|max_length[255]");
				$this->form_validation->set_error_delimiters('', ',');
				$this->form_validation->set_message(
					[
						"required"  => "<b>{field}</b> " . lang("must_be_filled") . "!",
						"valid_email" => "<b>{field}</b> " . lang("must_be_valid_email") . "!",
						"min_length" => "<b>{field}</b> " . lang("must_be_at_least") . " {param} " . lang("characters") . "!",
						"max_length" => "<b>{field}</b> " . lang("must_be_at_least") . " {param} " . lang("characters") . "!",
					]
				);
				$validate = $this->form_validation->run();
				$alert = [
					"title" => lang("error"),
					"text" => lang("profile_update_error"),
					"type" => "error"
				];
				if ($validate) :
					$updateData = [
						'first_name' => clean($this->input->post("first_name", true)),
						'last_name' => clean($this->input->post("last_name", true)),
						'email' => clean($this->input->post("email", true)),
					];
					if (!empty(clean($this->input->post("password", true)))) :
						$updateData["password"] = password_hash(clean($this->input->post("password", true)), PASSWORD_DEFAULT);
					endif;
					$update = $this->general_model->update("users", ["id" => $id], $updateData);
					if ($update) :
						$alert = [
							"title" => lang("success"),
							"text" => lang("profile_updated"),
							"type" => "success"
						];
						$user = $this->general_model->get("users", null, ["id" => $id]);
						if ($user->id == get_active_user()->id) :
							$this->session->set_userdata("user", $user);
						endif;
					endif;
				endif;
				if (validation_errors()) :
					$alert["text"] =  str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))));
				endif;
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("panel/profile/$id"));
			endif;
		endif;
		$this->session->set_flashdata("alert", $alert);
		redirect(base_url("panel"));
	}
}
