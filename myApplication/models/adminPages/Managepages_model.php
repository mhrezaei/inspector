<?php
class ManagePages_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function pages_data()
    {
        $query = $this->db->select(array(
                                        'id',
                                        'title',
                                        'content',
                                        'lastUpdateTime',
                                        'status'
                                        ))
        ->from('pages')->where(array('status < ' => 12))->get();
        
        if($query->num_rows() > 0)
        {
            $data['pages'] = $query->result_array();
        }
        else
        {
            $data['pages'] = false;
        }
        
        return $data;
    }
    
    public function load_one_page($id)
    {
        $query = $this->db->select(array(
                                        'id',
                                        'title',
                                        'content',
                                        'lastUpdateTime',
                                        'status'
                                        ))
        ->from('pages')->where(array('status < ' => 12, 'id' => $id))->get();
        
        if($query->num_rows() > 0)
        {
            $data['pages'] = $query->row_array();
        }
        else
        {
            $data['pages'] = false;
        }
        
        return $data;
    }
    
    public function edit_one_page($id)
    {
        $title = htmlCoding($this->input->post('txtTitle'));
        $content = htmlCoding($this->input->post('txtContent'));
        
        $data = array(
                    'title' => $title,
                    'content' => $content,
                    'lastUpdateTime' => time()
                    );
        $this->db->where('id', $id);
        $this->db->update('pages', $data);
        
        if($this->db->affected_rows() > 0)
        {
            return 1;
            exit;
        }
        else
        {
            return 2;
            exit;
        }
    }
}