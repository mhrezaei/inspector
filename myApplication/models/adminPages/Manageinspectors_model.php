<?php
class ManageInspectors_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function inspectors_data()
    {
        $num = 30;
        if($this->input->get('page') AND $this->input->get('page') > 0)
        {
            $row = ($this->input->get('page') * $num) - $num;
            $page = $this->input->get('page');
        }
        else
        {
            $row = 0;
            $page = 1;
        }
        
        $url = '?';
        $isOpu = false;
        $orderType = 'ASC';
        // active status = 1
        // inactive by opu status = 2
        // inactive by admin = 3
        // inactive because opu has inactive = 4
        // deleted status = 12
        $where = array('inspectors.status < ' => 10);
        $this->db->select(array(
                                'inspectors.id',
                                'inspectors.name',
                                'inspectors.nationalCode',
                                'inspectors.mobile',
                                'inspectors.type',
                                'inspectors.status',
                                'opu.name AS opuName'
                                ));
        $this->db->from('inspectors');
        $this->db->join('opu', 'inspectors.opuId = opu.id');
        if($this->input->get('searchTools'))
        {
            $url .= 'searchTools=true&';
            if($this->input->get('inputInspectorFilter') AND strlen($this->input->get('inputInspectorFilter')) > 0)
            {
                $this->db->like('inspectors.name', htmlCoding($this->input->get('inputInspectorFilter')), 'both');
                $this->db->or_like('inspectors.nationalCode', htmlCoding($this->input->get('inputInspectorFilter')), 'both');
                $this->db->or_like('inspectors.mobile', htmlCoding($this->input->get('inputInspectorFilter')), 'both');
                $url .= 'inputInspectorFilter=' . $this->input->get('inputInspectorFilter') . '&';
            }
            if($this->input->get('cbOpu') > 0)
            {
                $where['inspectors.opuId'] = $this->input->get('cbOpu');
                $url .= 'cbOpu=' . $this->input->get('cbOpu') . '&';
                $isOpu = $this->input->get('cbOpu');
            }
            if($this->input->get('cbInspectorType') > 0 AND $this->input->get('cbInspectorType') < 4)
            {
                $where['inspectors.type'] = $this->input->get('cbInspectorType');
                $url .= 'cbInspectorType=' . $this->input->get('cbInspectorType') . '&';
            }
            if($this->input->get('cbOrderBy'))
            {
                $url .= 'cbOrderBy=' . $this->input->get('cbOrderBy') . '&';
                if($this->input->get('cbOrderBy') == 'ASC')
                {
                    $orderType = 'ASC';
                }
                elseif($this->input->get('cbOrderBy') == 'DESC')
                {
                    $orderType = 'DESC';
                }
                else
                {
                    $orderType = 'ASC';
                }
            }
        }
        $this->db->where($where);
        $this->db->order_by('inspectors.name', $orderType);
        $this->db->limit($num,$row);
        
         $query = $this->db->get();
         $query = $query->result_array();
        
        $data['ins'] = $query;
        $data['page'] = $page;
        $data['url'] = $url;
        $data['isOpu'] = $isOpu;
        
        $where = array('inspectors.status < ' => 10);
        $this->db->select(array(
                                'count("id")',
                                ));
        $this->db->from('inspectors');
        $this->db->join('opu', 'inspectors.opuId = opu.id');
        if($this->input->get('searchTools'))
        {
            if($this->input->get('inputInspectorFilter') AND strlen($this->input->get('inputInspectorFilter')) > 0)
            {
                $this->db->like('inspectors.name', htmlCoding($this->input->get('inputInspectorFilter')), 'both');
                $this->db->or_like('inspectors.nationalCode', htmlCoding($this->input->get('inputInspectorFilter')), 'both');
                $this->db->or_like('inspectors.mobile', htmlCoding($this->input->get('inputInspectorFilter')), 'both');
            }
            if($this->input->get('cbOpu') > 0)
            {
                $where['inspectors.opuId'] = $this->input->get('cbOpu');
            }
            if($this->input->get('cbInspectorType') > 0 AND $this->input->get('cbInspectorType') < 4)
            {
                $where['inspectors.type'] = $this->input->get('cbInspectorType');
            }
        }
        $this->db->where($where);        
         $query = $this->db->get();
         $query = $query->row_array();
         
         $data['totalInspector'] = $query['count("id")'];

        return $data;
    }
}