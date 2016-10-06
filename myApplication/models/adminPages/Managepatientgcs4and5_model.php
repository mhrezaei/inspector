<?php
class ManagePatientGCS4and5_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function patient_data()
    {
        $where = array('patients.status' => 1, 'patients.isArchive' => 0, 'patients.tol' => 3);
        $class = 'admin/manage_patient_gcs4_5/index/';
        $data = $this->managePatientQuery_model->patient_data_query($where, $class);
        return $data;
    }
}