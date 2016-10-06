<?php
class ManageOpu_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function opu_data($page)
    {
        $num = 30;
        if($page > 0)
        {
            $row = ($page * $num) - $num;
        }
        else
        {
            $row = 0;
        }
        
        // active status = 1
        // inactive status = 2
        // deleted status = 12
        
        $this->db->select(array(
                                'opu.id',
                                'opu.name',
                                'opu.headOffice',
                                'opu.username',
                                'opu.mobile',
                                'opu.telephone',
                                'opu.status',
                                'opu.type',
                                'opu.grade',
                                'opu.pmp',
                                'opu.population',
                                'state.name AS stateName',
                                'city.name AS cityName'
                                ));
        $this->db->from('opu');
        $this->db->join('states AS state', 'opu.state = state.id');
        $this->db->join('states AS city', 'opu.city = city.id');
        if($this->input->post('inputOpuFilter', TRUE, TRUE) AND strlen($this->input->post('inputOpuFilter', TRUE, TRUE)) > 0)
        {
            $this->db->like('opu.name', htmlCoding($this->input->post('inputOpuFilter', TRUE, TRUE)), 'both');
            $this->db->or_like('opu.headOffice', htmlCoding($this->input->post('inputOpuFilter', TRUE, TRUE)), 'both');
            $this->db->or_like('opu.username', htmlCoding($this->input->post('inputOpuFilter', TRUE, TRUE)), 'both');
            $this->db->or_like('opu.mobile', htmlCoding($this->input->post('inputOpuFilter', TRUE, TRUE)), 'both');
            $this->db->or_like('opu.telephone', htmlCoding($this->input->post('inputOpuFilter', TRUE, TRUE)), 'both');
            $data['filter'] =  htmlCoding($this->input->post('inputOpuFilter', TRUE, TRUE));
        }
        else
        {
            $data['filter'] = false;
        }
        $this->db->where(array('opu.status < ' => 12));
        $this->db->order_by('opu.name', 'asc');
        $this->db->limit($num,$row);
        $query = $this->db->get();
        $data['opu'] = $query->result_array();
        if($data['opu'] AND is_array($data['opu']) AND count($data['opu']) > 0)
        {
            for($i = 0; $i < count($data['opu']); $i++)
            {
                $this->db->select('count("id")');
                $this->db->from('inspectors');
                $this->db->where(array('opuId' => $data['opu'][$i]['id'], 'status < ' => 10));
                $query = $this->db->get();
                $query = $query->row_array();
                $data['opu'][$i]['insNum'] = $query['count("id")'];
            }
        }

        if($this->input->post('inputOpuFilter', TRUE, TRUE) AND strlen($this->input->post('inputOpuFilter', TRUE, TRUE)) > 0)
        {
            $data['totalOpu'] = 1;
        }
        else
        {
            $this->db->select('count("id")');
            $this->db->from('opu');
            $this->db->where(array('status' => 1));
            $query = $this->db->get();
            $data['totalOpu'] = $query->row_array();
            $data['totalOpu'] = $data['totalOpu']['count("id")'];
        }
        

        $data['page'] = $page;
        $data['row'] = ++$row;
        
        return $data;
    }
    
    public function opu_name()
    {
        $this->db->select(array('id', 'name'));
        $this->db->from('opu');
        $this->db->where(array('status <' => 12));
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        if(is_array($query->result()) AND count($query->result()) > 0)
        {
            $data = $query->result_array();
            return $data;
        }
        else
        {
            return false;
        }
    }
}