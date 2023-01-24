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
	}

	public function index()
	{
		$this->render();
	}

	public function render()
	{
		$this->load->view('backend/layout/index', (array)$this->viewData);
	}

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
                        <a class="dropdown-item updateProductBtn" href="javascript:void(0)" data-url="' . base_url("products/update-form/$item->id") . '"><i class="fa fa-pen me-2"></i>' . lang("edit_product") . '</a>
                        <a class="dropdown-item" href="' . base_url("products/upload_form/$item->id") . '"><i class="fa fa-image me-2"></i>' . lang("images") . '</a>
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
}
