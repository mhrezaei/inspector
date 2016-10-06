<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Forms extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('publicPages/Forms_model');
        }

        public function index()
        {
            if($this->input->post('txtUserName') AND $this->input->post('txtPassWord'))
            {
                $user = 'data';
                $pass = 'd134679852';
                if($this->input->post('txtUserName') == $user AND $this->input->post('txtPassWord') == $pass)
                {
                    $this->session->set_userdata('quest', 'forms');
                    $data['login'] = 1;
                    $data['msg'] = 2;
                }
                else
                {
                    $data['login'] = 2;
                    $data['msg'] = 1;
                }
            }
            else
            {
                if($this->userauthentication_model->check_user_logedin())
                {
                    $data['login'] = 1;
                    $data['msg'] = 2;
                }
                elseif($this->session->userdata('quest') AND $this->session->userdata('quest') == 'forms')
                {
                    $data['login'] = 1;
                    $data['msg'] = 2;
                }
                else
                {
                    $data['login'] = 2;
                    $data['msg'] = 2;
                }
            }

            $this->load->view('templates/header', $this->header_model->header_data());
            $this->load->view('templates/topMain', $this->header_model->login_name_info());
            $this->load->view('publicPages/forms', $data);
            $this->load->view('templates/footer', $this->header_model->header_data());
            //$this->manageStates_model->states_data();
        }

        public function getFile($fileID)
        {
            if($this->userauthentication_model->check_user_logedin() OR ($this->session->userdata('quest') AND $this->session->userdata('quest') == 'forms'))
            {
                if(is_numeric($fileID) AND $fileID > 0)
                {
                    $this->Forms_model->download_one_file($fileID);
                }
                else
                {
                    show_404();
                }
            }
            else
            {
                show_404();
            }
        }
}