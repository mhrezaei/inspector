<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_pages extends CI_Controller {

	public function __construct()
    {
        
        parent::__construct();
        if(!$this->userauthentication_model->check_user_logedin() OR !$this->userauthentication_model->is_admin())
        {
            $this->userauthentication_model->log_out();
            redirect(base_url() . 'userAuthentication/user_authentication');
            exit;
        }
        $this->load->model('adminPages/managePages_model');
        $this->load->helper('pagination');
    }
    
    public function index($page = 1)
	{
        $data = '';
        $this->load->view('templates/header', $this->header_model->header_data());
        $this->load->view('templates/topMain', $this->header_model->login_name_info());
        $this->load->view('templates/dataComponent', $this->header_model->data_component());
        $this->load->view('adminPages/managePages', $this->managePages_model->pages_data());
        $this->load->view('templates/footer', $data);
  	}
    
    public function editPage($id)
    {
        if(!isset($id))
        {
            show_404();
            exit;
        }
        if($this->input->post('txtTitle') AND strlen($this->input->post('txtTitle')) > 5 AND $this->input->post('txtContent') AND strlen($this->input->post('txtContent')) > 50)
        {
            $this->managePages_model->edit_one_page($id);
        }
        
        $data = '';
        $this->load->view('templates/header', $this->header_model->header_data());
        $this->load->view('templates/topMain', $this->header_model->login_name_info());
        $this->load->view('templates/dataComponent', $this->header_model->data_component());
        $this->load->view('adminPages/editPages', $this->managePages_model->load_one_page($id));
        $this->load->view('templates/footer', $data);
    }
    
    public function uploadImages()
    {
        if($this->input->post('uploadFile') AND $this->input->post('uploadFile') == 'yes')
        {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']    = '500';
            $config['max_width']  = '2048';
            $config['max_height']  = '1536';
            $config['file_name']  = md5(sha1(time()));

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload())
            {
                $data['error'] = array('error' => $this->upload->display_errors());
                $data['success'] = '';
                $data['status'] = 1;
            }
            else
            {
                $data['success'] = array('upload_data' => $this->upload->data());
                $data['error'] = '';
                $data['status'] = 2;
            }
        }
        else
        {
            $data['status'] = 1;
            $data['error'] = '';
            $data['success'] = '';
        }
        $this->load->view('adminPages/uploadImages', $data);
    }
}