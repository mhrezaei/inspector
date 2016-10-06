<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class statistics_and_information extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->userauthentication_model->check_user_logedin())
        {
            $this->userauthentication_model->log_out();
            redirect(base_url() . 'userAuthentication/user_authentication');
            exit;
        }
    }

    public function index()
    {
        $data['component'] = $this->header_model->all_data_component();
        $data['opu'] = $this->header_model->all_opu_data_component();
        $this->load->view('templates/header', $this->header_model->header_data());
        $this->load->view('templates/topMain', $this->header_model->login_name_info());
        $this->load->view('publicPages/statistics_and_information', $data);
        $this->load->view('templates/footer', $data);
    }
}