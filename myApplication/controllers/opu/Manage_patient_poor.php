<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_patient_poor extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!$this->userauthentication_model->check_user_logedin() OR !$this->userauthentication_model->is_opu())
        {
            $this->userauthentication_model->log_out();
            redirect(base_url() . 'userAuthentication/user_authentication');
            exit;
        }
        $this->load->model('opuPages/managePatientPoor_model');
        $this->load->model('publicPages/managePatientQuery_model');
        $this->load->helper('pagination');
    }
    
    public function index()
	{
        $pt['pt'] = $this->managePatientPoor_model->patient_data();
        $data = '';
        $this->load->view('templates/header', $this->header_model->header_data());
        $this->load->view('templates/topMain', $this->header_model->login_name_info());
        $this->load->view('templates/dataComponent', $this->header_model->data_component());
        $this->load->view('opuPages/managePatientPoor', $pt);
        $this->load->view('templates/footer', $data);
  	}
}