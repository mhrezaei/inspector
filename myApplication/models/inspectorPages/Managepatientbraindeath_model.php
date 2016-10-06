<?php
class ManagePatientBrainDeath_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function patient_data()
    {
        $session = $this->session->userdata('user');
        $where = array('patients.status' => 1, 'patients.isArchive' => 0, 'patients.tol' => 1, 'opu' => $session['opuId']);
        $class = 'inspector/manage_patient_brain_death/index/';
        $data = $this->managePatientQuery_model->patient_data_query($where, $class);
        return $data;
    }
}