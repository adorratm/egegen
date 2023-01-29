<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
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
		$this->viewData->viewFolder = "settings";
		$this->viewData->subViewFolder = "list";
		if (!get_active_user()) :
			redirect(base_url("panel/login"));
		endif;
		$this->viewData->settings = get_settings();
		$this->load->model("settings_model");
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

	// Datatable
	public function datatable()
	{
		$items = $this->settings_model->getRows([], $_POST);
		$data = [];
		$i = (!empty($_POST['start']) ? $_POST['start'] : 0);
		if (!empty($items)) :
			foreach ($items as $item) :
				$i++;
				$actions = '
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary rounded-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ' . lang("actions") . '
                    </button>
                    <div class="dropdown-menu rounded-0 dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item updateSettingsBtn" href="javascript:void(0)" data-url="' . base_url("panel/settings/update-settings/$item->id") . '"><i class="fa fa-pen me-2"></i>' . lang("edit_settings") . '</a>
                    </div>
                </div>';
				$data[] = [$item->id, $item->project_title, $actions];
			endforeach;
		endif;
		$output = [
			"draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
			"recordsTotal" => $this->settings_model->rowCount([]),
			"recordsFiltered" => $this->settings_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
			"data" => $data,
		];
		// Output to JSON format
		echo json_encode($output);
		return;
	}

	// Update Form
	public function update_form($id)
	{
		$this->viewData->subViewFolder = "update";
		$this->viewData->item = $this->settings_model->get(["id" => $id]);
		$this->load->view("backend/{$this->viewData->viewFolder}/{$this->viewData->subViewFolder}/index", (array)$this->viewData);
	}

	// Update Settings
	public function update($id)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("project_title", lang("project_title"), "required|trim");
		$this->form_validation->set_rules("company_name", lang("company_name"), "required|trim");
		$this->form_validation->set_rules("company_url", lang("company_url"), "required|trim");
		$validate = $this->form_validation->run();

		if ($validate) :
			$data = [
				"project_title" => clean($this->input->post("project_title", true)),
				"company_name" => clean($this->input->post("company_name", true)),
				"company_url" => clean($this->input->post("company_url", true)),
			];
			$resize = ['height' => 1000, 'width' => 1000, 'maintain_ratio' => FALSE, 'master_dim' => 'height'];
			$image = upload_picture("img_url", "public/uploads/{$this->viewData->viewFolder}/", $resize, "*");
			if ($image["success"]) :
				$data["img_url"] = $image["file_name"];
				$settings = $this->settings_model->get(["id" => $id]);
				$url = FCPATH . "public/uploads/{$this->viewData->viewFolder}/{$settings->img_url}";
				if (!is_dir($url) && file_exists($url)) :
					unlink($url);
				endif;
			endif;
			$update = $this->settings_model->update(["id" => $id], $data);
			if ($update) :
				echo json_encode(["success" => true, "title" => lang("success"), "message" => lang("settings_updated_successfully")]);
				return;
			endif;
			echo json_encode(["success" => false, "title" => lang("error"), "message" => lang("settings_updated_error")]);
			return;
		endif;
		echo json_encode(["success" => false, "title" => lang("error"), "message" => str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))))]);
		return;
	}

	// Delete Settings Image
	public function delete_settings_image($id)
	{
		$settings = $this->settings_model->get(["id" => $id]);
		$url = FCPATH . "public/uploads/{$this->viewData->viewFolder}/{$settings->img_url}";
		if (!is_dir($url) && file_exists($url)) :
			unlink($url);
		endif;
		$update = $this->settings_model->update(["id" => $id], ["img_url" => null]);
		if ($update) :
			echo json_encode(["success" => true, "title" => lang("success"), "message" => lang("settings_image_deleted_successfully")]);
			return;
		endif;
		echo json_encode(["success" => false, "title" => lang("error"), "message" => lang("settings_image_delete_error")]);
		return;
	}
}
