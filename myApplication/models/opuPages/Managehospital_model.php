<?php
class ManageHospital_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function hospital_data()
    {
        $session = $this->session->userdata('user');
        $num = 30;
        if($this->input->get('page', TRUE, TRUE) AND $this->input->get('page', TRUE, TRUE) > 0)
        {
            $row = ($this->input->get('page', TRUE, TRUE) * $num) - $num;
            $page = $this->input->get('page', TRUE, TRUE);
        }
        else
        {
            $row = 0;
            $page = 1;
        }
        $this->db->select(array(
                                'hospitals.id', 
                                'hospitals.name', 
                                'state.name AS stateName', 
                                'city.name AS cityName', 
                                'opus.name AS opuName',
                                'hospitals.type',
                                'hospitals.icu',
                                'hospitals.icuBeds',
                                'hospitals.icuBedsBusy',
                                'hospitals.neuroService'
                                ));
        $this->db->from('hospitals');
        $this->db->join('states AS state', 'hospitals.state = state.id');
        $this->db->join('states AS city', 'hospitals.city = city.id');
        $this->db->join('opu AS opus', 'hospitals.opuId = opus.id');
        $where = array(
            'hospitals.status' => 1,
            'hospitals.opuId' => $session['uid']
        );
        $url = '?';
        $isOpu = false;
        $isState = false;
        $isCity = false;
        if($this->input->get('searchTools', TRUE, TRUE))
        {
            $url .= 'searchTools=true&';
            if($this->input->get('inputHospitalFilter', TRUE, TRUE) AND strlen($this->input->get('inputHospitalFilter', TRUE, TRUE)) > 0)
            {
                $this->db->like('hospitals.name', htmlCoding($this->input->get('inputHospitalFilter', TRUE, TRUE)), 'both');
                $url .= 'inputHospitalFilter=' . $this->input->get('inputHospitalFilter', TRUE, TRUE) . '&';
            }
        }
        $this->db->where($where);
        $this->db->order_by('hospitals.name', 'asc');
        $this->db->limit($num,$row);
        $query = $this->db->get();
        $data['hospitals'] = $query->result_array();

        for($i = 0; $i < count($data['hospitals']); $i++)
        {
            $hospitalData = $this->db->select()->from('hospital_data')->where(array(
                'hospitalId' => $data['hospitals'][$i]['id'],
                'status' => 1
            ))->order_by('id', 'DESC')->get();
            if($hospitalData->num_rows() > 0)
            {
                $data['hospitals'][$i]['data'] = $hospitalData->row_array();
                $data['hospitals'][$i]['haveData'] = 1;
            }
            else
            {
                $data['hospitals'][$i]['haveData'] = 2;
            }
        }

        // get full num
        $this->db->select('count("id")');
        $this->db->from('hospitals');
        $where = array(
            'hospitals.status' => 1,
            'hospitals.opuId' => $session['uid']
        );
        if($this->input->get('searchTools', TRUE, TRUE))
        {
            if($this->input->get('inputHospitalFilter', TRUE, TRUE) AND strlen($this->input->get('inputHospitalFilter', TRUE, TRUE)) > 0)
            {
                $this->db->like('hospitals.name', htmlCoding($this->input->get('inputHospitalFilter', TRUE, TRUE)), 'both');
            }
        }
        $this->db->where($where);
        $query = $this->db->get();
        $data['totalHospitals'] = $query->row_array();
        $data['totalHospitals'] = $data['totalHospitals']['count("id")'];
        $data['page'] = $page;
        $data['url'] = $url;
        $data['isOpu'] = $isOpu;
        $data['isState'] = $isState;
        $data['isCity'] = $isCity;
        return $data;
    }
}