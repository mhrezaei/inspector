<?php
class ManagePatientDeleted_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function patient_data()
    {
        $where = array('patients.status' => 12, 'patients.isArchive' => 0);
        $class = 'admin/manage_patient_deleted/index/';
        $data = $this->managePatientQuery_model->patient_data_query($where, $class);
        return $data;
    }
}