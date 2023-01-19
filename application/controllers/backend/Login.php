<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
        $this->viewData->viewFolder = "dashboard";
        $this->viewData->subViewFolder = "list";
        
        $this->viewData->settings = get_settings();
    }

    public function index()
    {
        if (get_active_user()) :
            redirect(base_url("panel"));
        endif;
        $this->render();
    }

    public function render()
    {
        if (get_active_user()) :
            redirect(base_url("panel"));
        endif;
        $this->load->view('backend/layout/login', (array)$this->viewData);
    }

    public function do_login()
    {
        if (get_active_user()) :
            redirect(base_url("panel"));
        endif;
        $this->load->library("form_validation");
        $this->form_validation->set_rules("email", lang("email"), "required|trim");
        $this->form_validation->set_rules("password", lang("password"), "required|trim|min_length[6]");
        $this->form_validation->set_error_delimiters('', ',');
        $this->form_validation->set_message(
            [
                "required"  => "<b>{field}</b> " . lang("must_be_filled") . "!",
                "valid_email" => "<b>{field}</b> " . lang("must_be_valid_email") . "!",
                "min_length" => "<b>{field}</b> " . lang("must_be_at_least") . " {param} " . lang("characters") . "!"
            ]
        );
        $validate = $this->form_validation->run();
        if ($validate) :
            $user = $this->general_model->get(
                "users",
                null,
                [
                    "email" => $this->input->post("email", true),
                ]
            );

            if ($user && password_verify($this->input->post("password", true), $user->password)) :
                $alert = [
                    "title" => lang("success"),
                    "text" => lang("login_success"),
                    "type" => "success"
                ];
                $this->session->set_flashdata("alert", $alert);
                $this->session->set_userdata("user", $user);
                redirect(base_url("panel"));
            endif;
        endif;
        $alert = [
            "title" => lang("error"),
            "text" => lang("login_error"),
            "type" => "error"
        ];
        if (validation_errors()) :
            $alert["text"] =  str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))));
        endif;
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("panel/login"));
    }

    public function logout()
    {
        $this->session->unset_userdata("user");
        redirect(base_url("panel/login"));
    }
}
