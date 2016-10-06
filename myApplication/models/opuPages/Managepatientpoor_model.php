<?php
class managePatientPoor_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function patient_data()
    {
        $session = $this->session->userdata('user');
        $where = array('patients.status' => 1, 'patients.isArchive' => 0, 'patients.tol' => 4, 'opu' => $session['uid']);
        $class = 'opu/manage_patient_poor/index/';
        $data = $this->managePatientQuery_model->patient_data_query($where, $class);
        return $data;
    }
}