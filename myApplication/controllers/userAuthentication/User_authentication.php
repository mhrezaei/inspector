<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_authentication extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->userauthentication_model->check_user_logedin())
        {
            if($this->uri->segment(3) == 'log_out')
            {
                $this->log_out();
                exit;
            }
            else
            {
                if($this->uri->segment(3) != 'change_password')
                {
                    redirect(base_url());
                    exit;
                }
            }
        }
    }
    
    public function index()
    {
        //////////////////////////////////////////
        $user = $this->input->post('username', TRUE, TRUE);
        $pass = $this->input->post('password', TRUE, TRUE);
        $security = $this->input->post('question', TRUE, TRUE);
        $securityQa = $this->input->post('txtLoginQsK', TRUE, TRUE);
        $data = array();
        if($security)
        {
            if(1 or securityQuestion($security, $securityQa, TRUE, 'userLoginQs'))
            {
                if($user AND $pass)
                {
                    if($this->userauthentication_model->login_user())
                    {
//                        showArray($user);
//                        showArray($pass);
                        showArray($this->session->userdata('user'));
//                        exit;
                        //redirect(base_url());
                    }
                    else
                    {
                        $data['err'] = '2';
                    }
                }
                else
                {
                    $data['err'] = 2;
                }
            }
            else
            {
                $data['err'] = 3;
            }
        }
        else
        {
            $data['err'] = '';
        }
        $this->load->view('userAuthentication/login', $data);
    }
    
    public function log_out()
    {
        $this->userauthentication_model->log_out();
        redirect(base_url());
        exit;
    }
    
    // change users password
    public function change_password()
    {
        $last = $this->input->post('inputLastPassword', TRUE, TRUE);
        if($last)
        {
            $data = $this->userauthentication_model->changeUserPassword();
        }
        else
        {
            $data['status'] = '';
        }
        $this->load->view('templates/header', $this->header_model->header_data());
        $this->load->view('templates/topMain', $this->header_model->login_name_info());
        $this->load->view('templates/dataComponent', $this->header_model->data_component());
        $this->load->view('publicPages/changePassword', $data);
        $this->load->view('templates/footer', $this->header_model->footer_data());
    }
}