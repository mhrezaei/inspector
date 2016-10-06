<?php
class Pages_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function load_one_page($title)
    {
        if($title == 'about')
        {
            $id = 1;
        }
        elseif($title == 'helpOpu')
        {
            $id = 2;
        }
        elseif($title == 'helpInspector')
        {
            $id = 4;
        }
        elseif($title == 'technical')
        {
            $id = 5;
        }
        elseif($title == 'rules')
        {
            $id = 3;
        }
        else
        {
            $id = 1;
        }
        
        $query = $this->db->select(array('title', 'content', 'lastUpdateTime'))->from('pages')->where(array('id' => $id, 'status' => 1))->get();
        if($query->num_rows() > 0)
        {
            $data = $query->row_array();
        }
        else
        {
            show_404();
            exit;
            $data = FALSE;
        }
        
        return $data;
    }
}