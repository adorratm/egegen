<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_variations extends CI_Controller
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

	public $viewData = null;

	public function __construct()
	{
		parent::__construct();
		$this->viewData = new stdClass();
		$this->viewData->viewFolder = "product-variations";
		$this->viewData->subViewFolder = "list";
		if (!get_active_user()) :
            redirect(base_url("panel/login"));
        endif;
		$this->viewData->settings = get_settings();
		$this->load->model("product_variation_model");
	}

	public function index()
	{
		$this->render();
	}

	public function render()
	{
		$this->load->view('backend/layout/index', (array)$this->viewData);
	}

	// Datatable
	public function datatable()
	{
		$items = $this->product_variation_model->getRows([], $_POST);
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
                        <a class="dropdown-item updateProductVariationBtn" href="javascript:void(0)" data-url="' . base_url("panel/product-variations/update-product-variation/$item->id") . '"><i class="fa fa-pen me-2"></i>' . lang("edit_product_variation") . '</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="productVariationTable" data-url="' . base_url("panel/product-variations/delete/$item->id") . '"><i class="fa fa-trash me-2"></i>' . lang("delete_product_variation") . '</a>
                    </div>
                </div>';
				$data[] = [$item->id, $item->title, $actions];
			endforeach;
		endif;
		$output = [
			"draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
			"recordsTotal" => $this->product_variation_model->rowCount([]),
			"recordsFiltered" => $this->product_variation_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
			"data" => $data,
		];
		// Output to JSON format
		echo json_encode($output);
	}

	// Add Form
	public function new_form()
	{
		$this->viewData->subViewFolder = "add";
		$this->viewData->settings = $this->general_model->get_all("settings", null, null, ["status" => 1]);
		$this->load->view("backend/{$this->viewData->viewFolder}/{$this->viewData->subViewFolder}/index", (array)$this->viewData);
	}

	// Save Product Variation
	public function save()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("title", lang("title"), "required|trim");
		$validate = $this->form_validation->run();
		if ($validate) :
			$data = [
				"title" => clean($this->input->post("title", true)),
			];
			$insert = $this->product_variation_model->add($data);
			if ($insert) :
				echo json_encode(["success" => true, "title" => lang("success"), "message" => lang("product_variation_added_successfully")]);
				return;
			endif;
			echo json_encode(["success" => false, "title" => lang("error"), "message" => lang("product_variation_added_error")]);
			return;
		endif;
		echo json_encode(["success" => false, "title" => lang("error"), "message" => str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))))]);
	}

	// Update Form
	public function update_form($id)
	{
		$this->viewData->subViewFolder = "update";
		$this->viewData->item = $this->product_variation_model->get(["id" => $id]);
		$this->viewData->settings = $this->general_model->get_all("settings", null, null, ["status" => 1]);
		$this->load->view("backend/{$this->viewData->viewFolder}/{$this->viewData->subViewFolder}/index", (array)$this->viewData);
	}

	// Update Product Variation
	public function update($id)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("title", lang("title"), "required|trim");
		$validate = $this->form_validation->run();

		if ($validate) :
			$data = [
				"title" => clean($this->input->post("title", true)),
			];
			$update = $this->product_variation_model->update(["id" => $id], $data);
			if ($update) :
				echo json_encode(["success" => true, "title" => lang("success"), "message" => lang("product_variation_updated_successfully")]);
				return;
			endif;
			echo json_encode(["success" => false, "title" => lang("error"), "message" => lang("product_variation_updated_error")]);
			return;
		endif;
		echo json_encode(["success" => false, "title" => lang("error"), "message" => str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))))]);
	}

	// Delete Product Variation
	public function delete($id)
	{
		$product_variation = $this->product_variation_model->get(["id" => $id]);
		if (!empty($product_variation)) :
			$delete = $this->product_variation_model->delete(["id" => $id]);
			if ($delete) :
				echo json_encode(["success" => true, "title" => lang("success"), "message" => lang("product_variation_deleted")]);
				return;
			endif;
		endif;
		echo json_encode(["success" => false, "title" => lang("error"), "message" => lang("product_variation_delete_error")]);
	}
}