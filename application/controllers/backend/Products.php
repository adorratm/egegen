<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
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
		$this->viewData->viewFolder = "products";
		$this->viewData->subViewFolder = "list";
		if (!get_active_user()) :
			redirect(base_url("panel/login"));
		endif;
		$this->viewData->settings = get_settings();
		$this->load->model("product_model");
		$this->load->model("product_image_model");
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
		$items = $this->product_model->getRows([], $_POST);
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
                        <a class="dropdown-item updateProductBtn" href="javascript:void(0)" data-url="' . base_url("panel/products/update-product/$item->id") . '"><i class="fa fa-pen me-2"></i>' . lang("edit_product") . '</a>
                        <a class="dropdown-item" href="' . base_url("panel/products/upload-product-image/$item->id") . '"><i class="fa fa-image me-2"></i>' . lang("images") . '</a>
						<a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="productTable" data-url="' . base_url("panel/products/delete/$item->id") . '"><i class="fa fa-trash me-2"></i>' . lang("delete_product") . '</a>
                    </div>
                </div>';
				$data[] = [$item->id, $item->img_url, $item->title, $actions];
			endforeach;
		endif;
		$output = [
			"draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
			"recordsTotal" => $this->product_model->rowCount([]),
			"recordsFiltered" => $this->product_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
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

	// Save Product
	public function save()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("title", lang("title"), "required|trim");
		$validate = $this->form_validation->run();
		if ($validate) :
			$data = [
				"title" => clean($this->input->post("title", true)),
			];
			$insert = $this->product_model->add($data);
			if ($insert) :
				echo json_encode(["success" => true, "title" => lang("success"), "message" => lang("product_added_successfully")]);
				return;
			endif;
			echo json_encode(["success" => false, "title" => lang("error"), "message" => lang("product_added_error")]);
			return;
		endif;
		echo json_encode(["success" => false, "title" => lang("error"), "message" => str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))))]);
	}

	// Update Form
	public function update_form($id)
	{
		$this->viewData->subViewFolder = "update";
		$this->viewData->item = $this->product_model->get(["id" => $id]);
		$this->viewData->settings = $this->general_model->get_all("settings", null, null, ["status" => 1]);
		$this->load->view("backend/{$this->viewData->viewFolder}/{$this->viewData->subViewFolder}/index", (array)$this->viewData);
	}

	// Update Product
	public function update($id)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("title", lang("title"), "required|trim");
		$validate = $this->form_validation->run();

		if ($validate) :
			$data = [
				"title" => clean($this->input->post("title", true)),
			];
			$update = $this->product_model->update(["id" => $id], $data);
			if ($update) :
				echo json_encode(["success" => true, "title" => lang("success"), "message" => lang("product_updated_successfully")]);
				return;
			endif;
			echo json_encode(["success" => false, "title" => lang("error"), "message" => lang("product_updated_error")]);
			return;
		endif;
		echo json_encode(["success" => false, "title" => lang("error"), "message" => str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))))]);
	}

	// Delete Product
	public function delete($id)
	{
		$product = $this->product_model->get(["id" => $id]);
		if (!empty($product)) :
			$delete = $this->product_model->delete(["id" => $id]);
			if ($delete) :
				$images = $this->product_image_model->get_all(["product_id" => $id]);
				if (!empty($images)) :
					foreach ($images as $key => $image) :
						if (!empty($image->img_url)) :
							if (!is_dir(FCPATH . "uploads/{$this->viewData->viewFolder}/{$image->img_url}") && file_exists(FCPATH . "uploads/{$this->viewData->viewFolder}/{$image->img_url}")) :
								unlink(FCPATH . "uploads/{$this->viewData->viewFolder}/{$image->img_url}");
							endif;
						endif;
					endforeach;
				endif;
				echo json_encode(["success" => true, "title" => lang("success"), "message" => lang("product_deleted")]);
				return;
			endif;
		endif;
		echo json_encode(["success" => false, "title" => lang("error"), "message" => lang("product_delete_error")]);
	}

	// Image Datatable
	public function imageDatatable($id)
	{
		$items = $this->product_image_model->getRows(
			["product_id" => $id],
			$_POST
		);
		$data = [];
		$i = (!empty($_POST['start']) ? $_POST['start'] : 0);
		if (!empty($items)) :
			foreach ($items as $item) :
				$i++;
				$proccessing = '
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary rounded-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        İşlemler
                    </button>
                    <div class="dropdown-menu rounded-0 dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="detailTable" data-url="' . base_url("products/fileDelete/{$item->id}") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
					</div>
                </div>';
				$checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("products/fileIsActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
				$checkbox2 = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-table="detailTable" data-url="' . base_url("products/fileIsCoverSetter/{$item->id}/$item->codes_id/$item->codes/$item->lang") . '" data-status="' . ($item->isCover == 1 ? "checked" : null) . '" id="customSwitch2' . $i . '" type="checkbox" ' . ($item->isCover == 1 ? "checked" : null) . ' class="isCover custom-control-input" >  <label class="custom-control-label" for="customSwitch2' . $i . '"></label></div>';
				$image = '<img data-src="' . base_url("uploads/{$this->viewFolder}/{$item->url}") . '" width="150" class="lazyload img-fluid">';
				$data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $image, $item->url, $item->lang, $checkbox2, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
			endforeach;
		endif;
		$output = [
			"draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
			"recordsTotal" => $this->product_image_model->rowCount(["product_id" => $id]),
			"recordsFiltered" => $this->product_image_model->countFiltered(["product_id" => $id], (!empty($_POST) ? $_POST : [])),
			"data" => $data,
		];
		// Output to JSON format
		echo json_encode($output);
	}

	// Upload Form
	public function upload_form($id)
	{
		$this->viewData->subViewFolder = "image";
		$this->viewData->item = $this->product_model->get(["id" => $id]);
		$this->viewData->items = $this->product_image_model->get_all(["id" => $id], "id ASC");
		$this->render();
	}

	// Upload Image
	public function file_upload($id)
	{
		$resize = ['height' => 1000, 'width' => 1000, 'maintain_ratio' => FALSE, 'master_dim' => 'height'];
		$image = upload_picture("file", "uploads/{$this->viewData->viewFolder}/", $resize, "*");
		if ($image["success"]) :
			$this->product_image_model->add(
				[
					"url"           => $image["file_name"],
					"product_id"      => $id,
				]
			);
		else :
			echo $image["error"];
		endif;
	}

	// Delete Product Image
	public function fileDelete($id)
	{
		$fileName = $this->product_image_model->get(["id" => $id]);
		$delete = $this->product_image_model->delete(["id" => $id]);
		if ($delete) :
			$url = FCPATH . "uploads/{$this->viewData->viewFolder}/{$fileName->img_url}";
			if (!is_dir($url) && file_exists($url)) :
				unlink($url);
			endif;
			echo json_encode(["success" => true, "title" => lang("success"), "message" => lang("image_deleted")]);
			return;
		endif;
		echo json_encode(["success" => false, "title" => lang("error"), "message" => lang("image_delete_error")]);
	}

	// Set Cover Image
	public function fileIsCoverSetter($id)
	{
		if (!empty($id)) :
			$isCover = (intval($this->input->post("data")) === 1) ? 1 : 0;
			if ($this->product_image_model->update(["id" => $id], ["isCover" => $isCover])) :
				$this->product_image_model->update(["id!=" => $id], ["isCover" => 0]);
				echo json_encode(["success" => True, "title" => lang("success"), "msg" => lang("image_is_cover")]);
			else :
				echo json_encode(["success" => False, "title" => lang("error"), "msg" => lang("image_is_cover_error")]);
			endif;
		endif;
	}
}
