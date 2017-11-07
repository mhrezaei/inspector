<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->userauthentication_model->check_user_logedin())
        {
            redirect(base_url() . 'userAuthentication/user_authentication');
            exit;
        }
    }
    
    public function index()
	{
        $data = '';
        $this->load->view('templates/header', $this->header_model->header_data());
        $this->load->view('templates/topMain', $this->header_model->login_name_info());
        $this->load->view('templates/dataComponent', $this->header_model->data_component());
        $this->load->view('templates/loginInfo', $this->header_model->login_info());
        $this->load->view('templates/homeChart', $data);
        $this->load->view('templates/footer', $this->header_model->footer_data());
	}
    
    protected function convertData()
    {
        $query = $this->db->select('id')->from('patients')->where('xxx', 1)->limit(100)->get();
        if($query->num_rows() > 0)
        {
            $query = $query->result_array();
            for($i = 0; $i < count($query); $i++)
            {
                $patientUpdate = '';
                $test = $this->db->select()->from('tests')->where(array(
                    'pId' => $query[$i]['id'],
                    'status' => 1
                ))->order_by('id', 'desc')->limit(1)->get();
                if ($test->num_rows())
                {
                    $test = $test->row_array();
                    $patientUpdate['na'] = $test['na'];
                    $patientUpdate['k'] = $test['k'];
                    $patientUpdate['bun'] = $test['bun'];
                    $patientUpdate['urea'] = $test['urea'];
                    $patientUpdate['cr'] = $test['cr'];
                    $patientUpdate['alt'] = $test['alt'];
                    $patientUpdate['ast'] = $test['ast'];
                    $patientUpdate['wbc'] = $test['wbc'];
                    $patientUpdate['plt'] = $test['plt'];
                    $patientUpdate['hgb'] = $test['hb'];
                    $patientUpdate['bs'] = $test['bs'];
                    $patientUpdate['out'] = $test['out'];
                    $patientUpdate['ca'] = $test['ca'];
                    $patientUpdate['t'] = $test['t'];
                    $patientUpdate['b'] = $test['b'];
                    $patientUpdate['p'] = $test['p'];
                    $patientUpdate['pr'] = $test['pr'];
                    $patientUpdate['rr'] = $test['rr'];
                    $patientUpdate['fio2'] = $test['fio2'];
                    $patientUpdate['o2sat'] = $test['o2sat'];
                }

                $organ = $this->db->select()->from('organs')->where(array(
                    'pId' => $query[$i]['id'],
                    'status' => 1
                ))->order_by('id', 'desc')->limit(1)->get();
                if ($organ->num_rows())
                {
                    $organ = $organ->row_array();
                    $patientUpdate['heart'] = $organ['heart'];
                    $patientUpdate['liver'] = $organ['liver'];
                    $patientUpdate['kidneyRight'] = $organ['kidneyRight'];
                    $patientUpdate['kidneyLeft'] = $organ['kidneyLeft'];
                    $patientUpdate['lungRight'] = $organ['lungRight'];
                    $patientUpdate['lungLeft'] = $organ['lungLeft'];
                    $patientUpdate['pancreas'] = $organ['pancreas'];
                    $patientUpdate['tissue'] = $organ['tissue'];
                    $patientUpdate['bowel'] = $organ['bowel'];
                }

                $data = $this->db->select()->from('patients_log')->where(
                    array(
                        'pId' => $query[$i]['id'],
                        'status' => 1
                    )
                )->order_by('id', 'asc')->limit(1)->get();
                if ($data->num_rows())
                {
                    $data = $data->row_array();
                    if ($data['tol'])
                    {
                        $patientUpdate['firstTol'] = $data['tol'];
                    }
                    if ($data['patientStatus'])
                    {
                        $patientUpdate['firstPatientStatus'] = $data['patientStatus'];
                    }
                }

                $patientUpdate['xxx'] = 0;
                $this->db->where('id', $query[$i]['id']);
                $this->db->update('patients', $patientUpdate);
                echo $i;
                echo '<br>';
            }
        }
        else
        {
            echo 'no data';
        }
    }
}