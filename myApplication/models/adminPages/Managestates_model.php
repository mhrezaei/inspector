<?php
class ManageStates_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function states_data()
    {
        $this->db->select(array('id', 'name'));
        $this->db->from('states');
        $this->db->where(array('parentID' => 0, 'status' => 1));
        $this->db->order_by("name", "asc"); 
        $query = $this->db->get();
        $data['states'] = $query->result_array();
        
        if(is_array($data['states']) && count($data['states']) > 0)
        {
            for($i = 0; $i < count($data['states']); $i++)
            {
                $this->db->select('count("id")')
                ->from('hospitals')
                ->where(array('status' => 1, 'state' => $data['states'][$i]['id']));
                $query = $this->db->get();
                $query = $query->row_array();
                $data['states'][$i]['hos'] = $query['count("id")'];
                // load city
                $this->db->select(array('id', 'name'));
                $this->db->from('states');
                $this->db->where(array('parentID' => $data['states'][$i]['id'], 'status' => 1));
                $this->db->order_by("name", "asc"); 
                $query = $this->db->get();
                $data['states'][$i]['city'] = $query->result_array();
                if(is_array($data['states'][$i]['city']) AND count($data['states'][$i]['city']) > 0)
                {
                    for($m = 0; $m < count($data['states'][$i]['city']); $m++)
                    {
                        $this->db->select('count("id")')
                        ->from('hospitals')
                        ->where(array('status' => 1, 'city' => $data['states'][$i]['city'][$m]['id']));
                        $query = $this->db->get();
                        $query = $query->row_array();
                        $data['states'][$i]['city'][$m]['num'] = $query['count("id")'];
                    }
                }
            }
        }
        
        return $data;
    }
}