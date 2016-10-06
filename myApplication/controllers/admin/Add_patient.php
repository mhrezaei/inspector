<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_patient extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!$this->userauthentication_model->check_user_logedin() OR !$this->userauthentication_model->is_admin())
        {
            $this->userauthentication_model->log_out();
            redirect(base_url() . 'userAuthentication/user_authentication');
            exit;
        }
        $this->load->model('adminPages/addPatient_model');
    }
    
    public function index()
	{
        $data = '';
        $this->load->view('templates/header', $this->header_model->header_data());
        $this->load->view('templates/topMain', $this->header_model->login_name_info());
        $this->load->view('templates/dataComponent', $this->header_model->data_component());
        $this->load->view('adminPages/addPatient', $this->addPatient_model->addNewPatient());
        $this->load->view('templates/footer', $this->header_model->footer_data());
  	}
}