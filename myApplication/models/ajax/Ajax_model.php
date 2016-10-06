<?php
class Ajax_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function edit_state_data()
    {
        $data = array(
                       'name' => $this->input->post('cityName')
                    );

        $this->db->where('id', $this->input->post('cityId'));
        $this->db->update('states', $data);
    }
    
    // load state and city
    public function load_state()
    {
        if($this->input->post('stateID') && is_numeric($this->input->post('stateID')) && $this->input->post('stateID') > 0)
        {
            // load city
            $this->db->select(array('id', 'name'));
            $this->db->from('states');
            $this->db->where(array('status' => 1, 'parentID' => $this->input->post('stateID')));
            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $data = $query->result_array();
            return $data;
        }
        else
        {
            // load state
            $this->db->select(array('id', 'name'));
            $this->db->from('states');
            $this->db->where(array('status' => 1, 'parentID' => 0));
            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $data = $query->result_array();
            return $data;
        }
    }
    
    // load opu
    public function load_opu()
    {
        $this->db->select(array('id', 'name'));
        $this->db->from('opu');
        $this->db->where(array('status' => 1));
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    // load hospitals
    public function load_hospital()
    {
        $where = array('status' => 1);
        if($this->input->post('where'))
        {
            if($this->input->post('where') == 'state')
            {
                $where['state'] = $this->input->post('stateID');
            }
            elseif($this->input->post('where') == 'city')
            {
                $where['city'] = $this->input->post('stateID');
            }
            elseif($this->input->post('where') == 'opuId')
            {
                $where['opuId'] = $this->input->post('stateID');
            }
        }
        $this->db->select(array('id', 'name'));
        $this->db->from('hospitals');
        $this->db->where($where);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    // load load_inspectors
    public function load_inspectors()
    {
        $where = array('status <' => 12);
        if($this->input->post('opuID'))
        {
            $where['opuId'] = $this->input->post('opuID');
        }
        else
        {
            return false;
            exit;
        }
        $this->db->select(array('id', 'name'));
        $this->db->from('inspectors');
        $this->db->where($where);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    // insert new opu
    public function insert_opu()
    {
        if($this->input->post('opuName', TRUE, TRUE))
        {
            if(strlen($this->input->post('opuName', TRUE, TRUE)) > 5 AND strlen($this->input->post('headOffice', TRUE, TRUE)) > 5 AND
                strlen($this->input->post('mob', TRUE, TRUE)) == 11 AND is_numeric($this->input->post('mob', TRUE, TRUE)) AND
                strlen($this->input->post('tel', TRUE, TRUE)) == 11 AND is_numeric($this->input->post('tel', TRUE, TRUE)) AND
                strlen($this->input->post('username', TRUE, TRUE)) > 2 AND strlen($this->input->post('password', TRUE, TRUE)) > 5 AND
                $this->input->post('stateId', TRUE, TRUE) > 0 AND $this->input->post('cityId', TRUE, TRUE) > 0 AND
                $this->input->post('cbType', TRUE, TRUE) != "0" AND $this->input->post('cbGrade', TRUE, TRUE) > 0 AND
                strlen($this->input->post('population', TRUE, TRUE)) > 0 AND strlen($this->input->post('pmp', TRUE, TRUE)) > 0)
            {
                $this->db->select('id');
                $this->db->from('opu');
                $this->db->where(array('username' => $this->input->post('username', TRUE, TRUE)));
                if($this->db->count_all_results() < 1)
                {
                    // username check for duplicaed
                    $data = array(
                                    'name' => htmlCoding($this->input->post('opuName', TRUE, TRUE)),
                                    'state' => $this->input->post('stateId', TRUE, TRUE),
                                    'city' => $this->input->post('cityId', TRUE, TRUE),
                                    'headOffice' => htmlCoding($this->input->post('headOffice', TRUE, TRUE)),
                                    'mobile' => htmlCoding($this->input->post('mob', TRUE, TRUE)),
                                    'telephone' => htmlCoding($this->input->post('tel', TRUE, TRUE)),
                                    'username' => htmlCoding($this->input->post('username', TRUE, TRUE)),
                                    'password' => hashStr($this->input->post('password', TRUE, TRUE)),
                                    'authCode' => md5(randnum(25) . $this->input->post('password', TRUE, TRUE)),
                                    'population' => htmlCoding($this->input->post('population', TRUE, TRUE)),
                                    'type' => htmlCoding($this->input->post('cbType', TRUE, TRUE)),
                                    'pmp' => htmlCoding($this->input->post('pmp', TRUE, TRUE)),
                                    'grade' => htmlCoding($this->input->post('cbGrade', TRUE, TRUE)),
                                    'status' => 1
                                    );
                    $this->db->insert('opu', $data);
                    if($this->db->affected_rows() == 1)
                    {
                        return 1; // insert successful
                    }
                    else
                    {
                        return 2; // insert not successful
                    }
                }
                else
                {
                    return 3; // username is duplicated
                }
            }
            else
            {
                return 4; // data validate problem
            }
        }
        else
        {
            return 5; // data not posted
        }
    }
    
    // select one opu
    public function select_one_opu()
    {
        if($this->input->post('opuID', TRUE, TRUE) AND is_numeric($this->input->post('opuID', TRUE, TRUE)) AND $this->input->post('opuID', TRUE, TRUE) > 0)
        {
            $this->db->select(array('id', 'name', 'headOffice', 'username', 'mobile', 'telephone', 'state', 'city', 'population', 'type', 'pmp', 'grade'));
            $this->db->from('opu');
            $this->db->where(array('id' => $this->input->post('opuID', TRUE, TRUE), 'status < ' => 10));
            $query = $this->db->get();
            if(is_array($query->result()) AND count($query->result()) > 0)
            {
                $data['opu'] = $query->row_array();
                $data = json_encode($data['opu']);
                return $data;
            }
            else
            {
                return false;
            }
        }
    }
    
    //edit one opu
    public function edit_one_opu()
    {
        if($this->input->post('opuName', TRUE, TRUE))
        {
            if(strlen($this->input->post('opuName', TRUE, TRUE)) > 5 AND strlen($this->input->post('headOffice', TRUE, TRUE)) > 5 AND
                strlen($this->input->post('mob', TRUE, TRUE)) == 11 AND is_numeric($this->input->post('mob', TRUE, TRUE)) AND
                strlen($this->input->post('tel', TRUE, TRUE)) == 11 AND is_numeric($this->input->post('tel', TRUE, TRUE)) AND
                $this->input->post('stateId', TRUE, TRUE) > 0 AND $this->input->post('cityId', TRUE, TRUE) > 0 AND $this->input->post('opuId', TRUE, TRUE) > 0 AND
                $this->input->post('cbType', TRUE, TRUE) != "0" AND $this->input->post('cbGrade', TRUE, TRUE) > 0 AND
                strlen($this->input->post('population', TRUE, TRUE)) > 0 AND strlen($this->input->post('pmp', TRUE, TRUE)) > 0)
            {
                // data validate complete
                $this->db->select(array('id'));
                $this->db->from('opu');
                $this->db->where(array('id' => $this->input->post('opuId', TRUE, TRUE), 'status < ' => 10));
                $query = $this->db->get();
                if(is_array($query->result()) AND count($query->result()) > 0)
                {
                    $data = array(
                                    'name' => htmlCoding($this->input->post('opuName', TRUE, TRUE)),
                                    'state' => $this->input->post('stateId', TRUE, TRUE),
                                    'city' => $this->input->post('cityId', TRUE, TRUE),
                                    'headOffice' => htmlCoding($this->input->post('headOffice', TRUE, TRUE)),
                                    'mobile' => htmlCoding($this->input->post('mob', TRUE, TRUE)),
                                    'telephone' => htmlCoding($this->input->post('tel', TRUE, TRUE)),
                                    'population' => htmlCoding($this->input->post('population', TRUE, TRUE)),
                                    'type' => htmlCoding($this->input->post('cbType', TRUE, TRUE)),
                                    'pmp' => htmlCoding($this->input->post('pmp', TRUE, TRUE)),
                                    'grade' => htmlCoding($this->input->post('cbGrade', TRUE, TRUE))
                                    );
                    if($this->input->post('password', TRUE, TRUE) != 'notAffected' AND strlen($this->input->post('password', TRUE, TRUE)) > 5)
                    {
                        $data['password'] = hashStr($this->input->post('password', TRUE, TRUE));
                        $data['authCode'] = md5(randnum(25) . $this->input->post('password', TRUE, TRUE));
                    }
                    $this->db->where('id', $this->input->post('opuId', TRUE, TRUE));
                    $this->db->update('opu', $data);
                    if($this->db->affected_rows() == 1)
                    {
                        return 1; // update successful
                    }
                    else
                    {
                        return 2; // update not completed
                    } 
                }
                else
                {
                    return 3; // opu not found
                }
            }
            else
            {
                return 4; // data not valid
            }
        }
        else
        {
            return 5; // data not posted
        }
    }
    
    // insert new hospital
    public function add_new_hospital()
    {
        if($this->input->post('hrName', TRUE, TRUE))
        {
            if(strlen($this->input->post('hrName', TRUE, TRUE)) > 2 AND $this->input->post('opuId', TRUE, TRUE) > 0 AND
                $this->input->post('stateId', TRUE, TRUE) > 0 AND $this->input->post('cityId', TRUE, TRUE) > 0 AND
                $this->input->post('cbType', TRUE, TRUE) > 0 AND $this->input->post('cbIcu', TRUE, TRUE) > 0 AND
                $this->input->post('cbNeuro', TRUE, TRUE) > 0 AND $this->input->post('deathPerYear', TRUE, TRUE) > 0)
            {
                $random = randnum(6);
                if($this->userauthentication_model->is_admin())
                {
                    $opu = $this->input->post('opuId', TRUE, TRUE);
                }
                elseif($this->userauthentication_model->is_opu())
                {
                    $session = $this->session->userdata('user');
                    $opu = $session['uid'];
                }
                else
                {
                    exit;
                }
                $data = array(
                                'name' => htmlCoding($this->input->post('hrName', TRUE, TRUE)),
                                'state' => $this->input->post('stateId', TRUE, TRUE),
                                'city' => $this->input->post('cityId', TRUE, TRUE),
                                'opuId' => $opu,
                                'type' => $this->input->post('cbType', TRUE, TRUE),
                                'icu' => $this->input->post('cbIcu', TRUE, TRUE),
                                'icuBeds' => $this->input->post('icuBed', TRUE, TRUE),
                                'icuBedsBusy' => $this->input->post('icuBedBusy', TRUE, TRUE),
                                'neuroService' => $this->input->post('cbNeuro', TRUE, TRUE),
                                'status' => $random
                                );
                $this->db->insert('hospitals', $data);
                if($this->db->affected_rows() == 1)
                {
                    $hospital = $this->db->select('id')->from('hospitals')->where('status', $random)->get();
                    if($hospital->num_rows() > 0)
                    {
                        $hospital = $hospital->row_array();
                        $data = array('status' => 1);
                        $this->db->where('id', $hospital['id']);
                        $this->db->update('hospitals', $data);

                        // insert hospital data
                        $data = array(
                            'hospitalId' => $hospital['id'],
                            'deathPerYear' => $this->input->post('deathPerYear', TRUE, TRUE),
                            'icuDeathPerYear' => $this->input->post('deathIcuPerYear', TRUE, TRUE),
                            'title' => pdate('Y'),
                            'status' => 1
                        );
                        $this->db->insert('hospital_data', $data);
                        if($this->db->affected_rows() > 0)
                        {
                            return 1; // insert successful
                        }
                        else
                        {
                            return 2; // insert not successful
                        }
                    }
                    else
                    {
                        return 2; // insert not successful
                    }
                }
                else
                {
                    return 2; // insert not successful
                }
            }
            else
            {
                return 3; // data not valid
            }
    
        }
        else
        {
            return 4; // data not posted
        }
    }
    
    // select one hospital
    public function select_one_hospital()
    {
        if($this->input->post('hosID', TRUE, TRUE) AND is_numeric($this->input->post('hosID', TRUE, TRUE)) AND $this->input->post('hosID', TRUE, TRUE) > 0)
        {
            $this->db->select(array('id', 'name', 'state', 'city', 'opuId', 'type', 'icu', 'icuBeds', 'icuBedsBusy', 'neuroService'));
            $this->db->from('hospitals');
            $this->db->where(array('id' => $this->input->post('hosID', TRUE, TRUE), 'status < ' => 10));
            $query = $this->db->get();
            if(is_array($query->result()) AND count($query->result()) > 0)
            {
                $data['hos'] = $query->row_array();
                $data['data'] = $this->db->select(array('deathPerYear', 'icuDeathPerYear', 'title'))
                    ->from('hospital_data')->where(array('hospitalId' => $this->input->post('hosID', TRUE, TRUE), 'status' => 1))
                    ->order_by('id', 'DESC')->get();
                if($data['data']->num_rows() > 0)
                {
                    $data['hos']['data'] = $data['data']->result_array();
                    $data['hos']['haveData'] = 1;
                }
                else
                {
                    $data['hos']['haveData'] = 2;
                }
                $data = json_encode($data['hos']);
                return $data;
            }
            else
            {
                return false;
            }
        }
    }
    
    //edit one hospital
    public function edit_one_hospital()
    {
        if($this->input->post('hrName', TRUE, TRUE))
        {
            if(strlen($this->input->post('hrName', TRUE, TRUE)) > 2 AND $this->input->post('opuId', TRUE, TRUE) > 0 AND
                $this->input->post('stateId', TRUE, TRUE) > 0 AND $this->input->post('cityId', TRUE, TRUE) > 0 AND
                $this->input->post('cbType', TRUE, TRUE) > 0 AND $this->input->post('cbIcu', TRUE, TRUE) > 0 AND
                $this->input->post('cbNeuro', TRUE, TRUE) > 0 AND $this->input->post('deathPerYear', TRUE, TRUE) > 0 AND
                $this->input->post('hosId', TRUE, TRUE) > 0)
            {
                // data validate complete
                $this->db->select(array('id'));
                $this->db->from('hospitals');
                $this->db->where(array('id' => $this->input->post('hosId', TRUE, TRUE), 'status < ' => 10));
                $query = $this->db->get();
                if($query->num_rows() > 0)
                {
                    if($this->userauthentication_model->is_admin())
                    {
                        $opu = $this->input->post('opuId', TRUE, TRUE);
                    }
                    elseif($this->userauthentication_model->is_opu())
                    {
                        $session = $this->session->userdata('user');
                        $opu = $session['uid'];
                    }
                    else
                    {
                        exit;
                    }
                    $data = array(
                        'name' => htmlCoding($this->input->post('hrName', TRUE, TRUE)),
                        'state' => $this->input->post('stateId', TRUE, TRUE),
                        'city' => $this->input->post('cityId', TRUE, TRUE),
                        'opuId' => $opu,
                        'type' => $this->input->post('cbType', TRUE, TRUE),
                        'icu' => $this->input->post('cbIcu', TRUE, TRUE),
                        'icuBeds' => $this->input->post('icuBed', TRUE, TRUE),
                        'icuBedsBusy' => $this->input->post('icuBedBusy', TRUE, TRUE),
                        'neuroService' => $this->input->post('cbNeuro', TRUE, TRUE),
                        'lastUpdate' => time()
                    );
                    $this->db->where('id', $this->input->post('hosId', TRUE, TRUE));
                    $this->db->update('hospitals', $data);
                    if($this->db->affected_rows() > 0)
                    {
                        $hospitalData = $this->db->select('id')->from('hospital_data')
                            ->where(array(
                                'hospitalId' => $this->input->post('hosId', TRUE, TRUE),
                                'title' => pdate('Y'),
                                'status' => 1
                            ))->get();
                        if($hospitalData->num_rows() > 0)
                        {
                            $hospitalData = $hospitalData->row_array();
                            $data = array(
                                'deathPerYear' => $this->input->post('deathPerYear', TRUE, TRUE),
                                'icuDeathPerYear' => $this->input->post('deathIcuPerYear', TRUE, TRUE)
                            );
                            $this->db->where('id', $hospitalData['id']);
                            $this->db->update('hospital_data', $data);
                        }
                        else
                        {
                            $data = array(
                                'hospitalId' => $this->input->post('hosId', TRUE, TRUE),
                                'deathPerYear' => $this->input->post('deathPerYear', TRUE, TRUE),
                                'icuDeathPerYear' => $this->input->post('deathIcuPerYear', TRUE, TRUE),
                                'title' => pdate('Y'),
                                'status' => 1
                            );
                            $this->db->insert('hospital_data', $data);
                        }
                        return 1; // update successful
                    }
                    else
                    {
                        return 2; // update not completed
                    } 
                }
                else
                {
                    return 3; // hospital not found
                }
            }
            else
            {
                return 4; // data not valid
            }
        }
        else
        {
            return 5; // data not posted
        }
    }
    
    // insert new inspector
    public function add_new_inspector()
    {
        $session = $this->session->userdata('user');
        if($this->input->post('insName', TRUE, TRUE))
        {
            if(strlen($this->input->post('insName', TRUE, TRUE)) > 5 AND $this->input->post('opuId', TRUE, TRUE) > 0 AND
                strlen($this->input->post('insNationalCode', TRUE, TRUE)) == 10 AND is_numeric($this->input->post('insNationalCode', TRUE, TRUE)) AND
                strlen($this->input->post('insMobile', TRUE, TRUE)) == 11 AND is_numeric($this->input->post('insMobile', TRUE, TRUE)) AND
                strlen($this->input->post('insPassword', TRUE, TRUE)) > 5 AND $this->input->post('insType', TRUE, TRUE) > 0 AND
                $this->input->post('insType', TRUE, TRUE) < 4 AND nationalCode($this->input->post('insNationalCode', TRUE, TRUE)))
            {
                if($this->userauthentication_model->is_opu())
                {
                    $opu = $session['uid'];
                }
                elseif($this->userauthentication_model->is_admin())
                {
                    $opu = $this->input->post('opuId', TRUE, TRUE);
                }
                else
                {
                    exit;
                }
                $data = array(
                                'name' => htmlCoding($this->input->post('insName', TRUE, TRUE)),
                                'nationalCode' => htmlCoding($this->input->post('insNationalCode', TRUE, TRUE)),
                                'password' => hashStr(htmlCoding($this->input->post('insPassword', TRUE, TRUE))),
                                'authCode' => md5(randnum(25) . htmlCoding($this->input->post('insPassword', TRUE, TRUE))),
                                'mobile' => htmlCoding($this->input->post('insMobile', TRUE, TRUE)),
                                'type' => $this->input->post('insType', TRUE, TRUE),
                                'opuId' => $opu,
                                'status' => 1
                                );
                $this->db->insert('inspectors', $data);
                if($this->db->affected_rows() == 1)
                {
                    return 1; // insert successful
                }
                else
                {
                    return 2; // insert not successful
                }
            }
            else
            {
                return 3; // data not valid
            }
    
        }
        else
        {
            return 4; // data not posted
        }
    }
    
    // select one inspector
    public function select_one_inspector()
    {
        if($this->input->post('insID', TRUE, TRUE) AND is_numeric($this->input->post('insID', TRUE, TRUE)) AND $this->input->post('insID', TRUE, TRUE) > 0)
        {
            $this->db->select(array('id', 'name', 'nationalCode', 'mobile', 'type', 'opuId'));
            $this->db->from('inspectors');
            $this->db->where(array('id' => $this->input->post('insID', TRUE, TRUE), 'status < ' => 10));
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $data['ins'] = $query->row_array();
                $data = json_encode($data['ins']);
                return $data;
            }
            else
            {
                return false;
            }
        }
    }
    
    //edit one inspector
    public function edit_one_inspector()
    {
        $session = $this->session->userdata('user');
        if($this->input->post('insName', TRUE, TRUE))
        {
            if(strlen($this->input->post('insName', TRUE, TRUE)) > 5 AND $this->input->post('opuId', TRUE, TRUE) > 0 AND
                strlen($this->input->post('insNationalCode', TRUE, TRUE)) == 10 AND is_numeric($this->input->post('insNationalCode', TRUE, TRUE)) AND
                strlen($this->input->post('insMobile', TRUE, TRUE)) == 11 AND is_numeric($this->input->post('insMobile', TRUE, TRUE)) AND
                $this->input->post('insType', TRUE, TRUE) > 0 AND $this->input->post('insType', TRUE, TRUE) < 4 AND $this->input->post('insID', TRUE, TRUE) > 0 AND
                nationalCode($this->input->post('insNationalCode', TRUE, TRUE)))
            {
                // data validate complete

                if($this->userauthentication_model->is_opu())
                {
                    $opu = $session['uid'];
                }
                elseif($this->userauthentication_model->is_admin())
                {
                    $opu = $this->input->post('opuId', TRUE, TRUE);
                }
                else
                {
                    exit;
                }

                $this->db->select(array('id'));
                $this->db->from('inspectors');
                $this->db->where(array('id' => $this->input->post('insID', TRUE, TRUE), 'status < ' => 10));
                $query = $this->db->get();
                if($query->num_rows() > 0)
                {
                    $data = array(
                                'name' => htmlCoding($this->input->post('insName', TRUE, TRUE)),
                                'nationalCode' => htmlCoding($this->input->post('insNationalCode', TRUE, TRUE)),
                                'mobile' => htmlCoding($this->input->post('insMobile', TRUE, TRUE)),
                                'type' => $this->input->post('insType', TRUE, TRUE),
                                'opuId' => $opu
                                );
                    if($this->input->post('insPassword', TRUE, TRUE) != 'passwordNotAffected' AND strlen($this->input->post('insPassword', TRUE, TRUE)) > 5)
                    {
                        $data['password'] = hashStr(htmlCoding($this->input->post('insPassword', TRUE, TRUE)));
                        $data['authCode'] = md5(randnum(25) . htmlCoding($this->input->post('insPassword', TRUE, TRUE)));
                    }
                    $this->db->where('id', $this->input->post('insID', TRUE, TRUE));
                    $this->db->update('inspectors', $data);
                    return 1; 
                }
                else
                {
                    return 3; // hospital not found
                }
            }
            else
            {
                return 4; // data not valid
            }
        }
        else
        {
            return 5; // data not posted
        }
    }
    
    // load doc
    public function load_doc()
    {
        $this->db->select(array('id', 'text', 'parentID'))
        ->from('doc')
        ->where(array('status' => 1, 'parentID' => 0))
        ->order_by('text ASC, parentID DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        if(is_array($data) && count($data) > 0)
        {
            for($i = 0; $i < count($data); $i++)
            {
                $this->db->select(array('id', 'text', 'parentID'))
                ->from('doc')
                ->where(array('status' => 1, 'parentID' => $data[$i]['id']))
                ->order_by('text', 'ASC');
                $query = $this->db->get();
                $data[$i]['sub'] = $query->result_array();
            }
            return $data;
        }
        else
        {
            return false;
        }
    }
    
    // load tol option with tol id
    public function load_tol_option()
    {
        $session = $this->session->userdata('user');
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu() OR $this->userauthentication_model->is_inspector())
        {
            if($this->input->post('stateID') AND is_numeric($this->input->post('stateID')) AND $this->input->post('stateID') > 0 AND $this->input->post('searchType') != 'ALL')
            {
                $where = array(
                            'tOp.status' => 1,
                            'tol_to_options.status' => 1,
                            'tOp.parentID' => 0,
                            'tol_to_options.tolID' => $this->input->post('stateID')
                            );
                if($this->userauthentication_model->is_inspector())
                {
                    if($session['type'] == 1)
                    {
                        $where['tol_to_options.res1'] = 2;
                    }
                    else
                    {
                        $where['tol_to_options.res1 >= '] = 1;
                    }
                }
                else
                {
                    $where['tol_to_options.res1 >= '] = 1;
                }
                
                $this->db->select(array(
                                        'tOp.id AS tolOptionID',
                                        'tOp.name'
                                        ))
                ->from('tol_to_options')
                ->join('tol_options AS tOp', 'tOp.id = tol_to_options.tolOptionsID')
                ->where($where)
                ->order_by('tOp.id', 'ASC');
                $query = $this->db->get();
                $data = $query->result_array();
                if(is_array($data) AND count($data) > 0)
                {
                    for($i = 0; $i < count($data); $i++)
                    {
                        $this->db->select('*')
                        ->from('tol_options')
                        ->where(array('status' => 1, 'parentID' => $data[$i]['tolOptionID']))
                        ->order_by('name', 'ASC');
                        $query = $this->db->get();
                        $data[$i]['sub'] = $query->result_array();
                    }
                }
                return $data;
            }
            elseif($this->input->post('stateID') == '-1')
            {
                $this->db->select(array(
                                        'id AS tolOptionID',
                                        'name'
                                        ))
                ->from('tol_options')
                ->where(array(
                            'status' => 1,
                            'parentID' => 0
                            ))
                ->order_by('name', 'ASC');
                $query = $this->db->get();
                $data = $query->result_array();
                if(is_array($data) AND count($data) > 0)
                {
                    for($i = 0; $i < count($data); $i++)
                    {
                        /*$this->db->select('*')
                        ->from('tol_options')
                        ->where(array('status' => 1, 'parentID' => $data[$i]['id']))
                        ->order_by('name', 'ASC');
                        $query = $this->db->get();*/
                        if($data[$i]['tolOptionID'] == 2)
                        {
                            $data[$i]['name'] = 'درحال پیگیری (GCS3 مرگ مغزی نشده)';
                        }
                        if($data[$i]['tolOptionID'] == 7)
                        {
                            $data[$i]['name'] = 'درحال پیگیری (GCS3 مرگ مغزی شده)';
                        }
                        $data[$i]['sub'] = FALSE;
                    }
                }
                return $data;
            }
            elseif($this->input->post('stateID') AND is_numeric($this->input->post('stateID')) AND $this->input->post('stateID') > 0 AND $this->input->post('searchType') == 'ALL')
            {
                $this->db->select(array(
                                        'tOp.id AS tolOptionID',
                                        'tOp.name'
                                        ))
                ->from('tol_to_options')
                ->join('tol_options AS tOp', 'tOp.id = tol_to_options.tolOptionsID')
                ->where(array(
                            'tOp.status' => 1,
                            'tol_to_options.status' => 1,
                            'tOp.parentID' => 0,
                            'tol_to_options.tolID' => $this->input->post('stateID')
                            ))
                ->order_by('tOp.name', 'ASC');
                $query = $this->db->get();
                $data = $query->result_array();
                if(is_array($data) AND count($data) > 0)
                {
                    for($i = 0; $i < count($data); $i++)
                    {
                        $this->db->select('*')
                        ->from('tol_options')
                        ->where(array('status' => 1, 'parentID' => $data[$i]['tolOptionID']))
                        ->order_by('id', 'ASC');
                        $query = $this->db->get();
                        $data[$i]['sub'] = $query->result_array();
                    }
                }
                return $data;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    // active or inactive or delete inspectors
    public function change_inspector_status()
    {
        $this->db->select(array('id', 'status', 'opuId'))
        ->from('inspectors')
        ->where(array('id' => $this->input->post('insID'), 'status < ' => 10));
        $query = $this->db->get();
        $query = $query->row_array();
        
        if($query AND is_array($query) AND count($query) > 0)
        {
            if($this->input->post('insStatus') != 'delete')
            {
                $this->db->select('id')
                ->from('opu')
                ->where(array('id' => $query['opuId'], 'status' => 1));
                $opu = $this->db->get();
                $opu = $opu->row_array();
                if($opu AND is_array($opu) AND count($opu) > 0)
                {
                    // continue
                }
                else
                {
                    echo 2; // user can not change this status
                    exit;
                }
            }
            else
            {
                // continue
            }
            
            if($this->userauthentication_model->is_admin() AND $query['status'] <= 3)
            {
                if($this->input->post('insStatus') == 'inactive')
                {
                    $status = 3;
                }
                elseif($this->input->post('insStatus') == 'active')
                {
                    $status = 1;
                }
                elseif($this->input->post('insStatus') == 'delete')
                {
                    $status = 12;
                }
            }
            elseif($this->userauthentication_model->is_opu() AND $query['status'] < 3)
            {
                if($this->input->post('insStatus') == 'inactive')
                {
                    $status = 2;
                }
                elseif($this->input->post('insStatus') == 'active' AND $query['status'] != 3)
                {
                    $status = 1;
                }
                elseif($this->input->post('insStatus') == 'delete' AND $query['status'] != 3)
                {
                    $status = 12;
                }
                else
                {
                    echo 1; // opu not access to active this inspector
                    exit;
                }
            }
            else
            {
                echo 2; // user can not change this status
                exit;
            }
            
            $update = array('status' => $status);
            $this->db->where('id', $query['id']);
            $this->db->update('inspectors', $update);
            echo 3; // update success
            exit;
        }
    }
    
    // active or inactive or delete opu
    public function change_opu_status()
    {
        $this->db->select(array('id', 'status'))
        ->from('opu')
        ->where(array('id' => $this->input->post('opuId'), 'status < ' => 10));
        $query = $this->db->get();
        $query = $query->row_array();
        if($query AND is_array($query) AND count($query) > 0)
        {
            $whereIns = array('opuId' => $query['id']);
            if($this->input->post('opuStatus') == 'inactive')
            {
                $status = 2;
                $insStatus = 4;
                $whereIns['status'] = 1;
            }
            elseif($this->input->post('opuStatus') == 'active')
            {
                $status = 1;
                $insStatus = 1;
                $whereIns['status'] = 4;
            }
            elseif($this->input->post('opuStatus') == 'delete')
            {
                $status = 12;
                $insStatus = 12;
                
            }
            else
            {
                echo 'Err';
                exit;
            }
            
            $this->db->select('id')
            ->from('inspectors')
            ->where($whereIns);
            $ins = $this->db->get();
            $ins = $ins->result_array();
            if($ins AND is_array($ins) AND count($ins) > 0)
            {
                $insUpdate = array('status' => $insStatus);
                for($i = 0; $i < count($ins); $i++)
                {
                    $this->db->where('id', $ins[$i]['id']);
                    $this->db->update('inspectors', $insUpdate);
                }
            }
                        
            $update = array('status' => $status);
            $this->db->where('id', $query['id']);
            $this->db->update('opu', $update);
            echo 3; // update success
            exit;
        }
        else
        {
            echo 2; // opu not found
            exit;
        }
    }
    
    // load one patient data
    public function load_one_patient()
    {
        $session = $this->session->userdata('user');
        if($this->input->post('pID', TRUE, TRUE))
        {
            $where = array('patients.status' => 1, 'patients.id' => $this->input->post('pID', TRUE, TRUE));
            if($this->userauthentication_model->is_opu())
            {
                $where['opu'] = $session['uid'];
            }
            elseif($this->userauthentication_model->is_inspector())
            {
                $where['opu'] = $session['opuId'];
            }
            $this->db->select(array(
                                'patients.id', 
                                'patients.fullName', 
                                'patients.nationalCode', 
                                'patients.age', 
                                'patients.firstGCS', 
                                'patients.secondGCS',
                                'patients.fileNumber',
                                'patients.bodyType', 
                                'patients.isUnKnown', 
                                'patients.docDetail', 
                                'patients.presentation', 
                                'patients.appRegisterTime', 
                                'patients.inspectorRegisterTime', 
                                'patients.patientStatusDetail', 
                                'patients.patientStatus', 
                                'patients.patientDetail', 
                                'patients.doc', 
                                'patients.tol', 
                                'patients.coordinatorName', 
                                'patients.hospitalizationTime', 
                                'patients.gcs3ByDrTime', 
                                'patients.brainDeathTime', 
                                'patients.cardiacDeathTime', 
                                'patients.organDonationTime', 
                                'docT.text AS docText', 
                                'tolOp.name AS tolOpName', 
                                'patients.breathing',
                                'patients.bodyMovement',
                                'patients.faceMovement',
                                'patients.gag',
                                'patients.cough',
                                'patients.cornea',
                                'patients.pupil',
                                'patients.dollEye',
                                'patients.sedation',
                                'patients.section',
                                'patients.hospital',
                                'patients.typeOfSection',
                                'hos.name AS hosName',
                                'opu.id AS opuId',
                                'states.name AS cityName'
                                ));
            $this->db->from('patients');
            $this->db->join('doc AS docT' ,'docT.id = patients.doc');
            $this->db->join('tol_options AS tolOp' ,'tolOp.id = patients.patientStatus');
            $this->db->join('hospitals AS hos' ,'hos.id = patients.hospital');
            $this->db->join('opu' ,'opu.id = patients.opu');
            $this->db->join('states' ,'states.id = patients.city');

            $this->db->where($where);
            $query = $this->db->get();

            if($query->num_rows() > 0)
            {
                $data['pt'] = $query->row_array();

                // convert time to persian date
                if($data['pt']['hospitalizationTime'] > 0)
                {
                    $data['pt']['hospitalizationTime'] = pdate('Y/m/d', $data['pt']['hospitalizationTime']);
                }
                if($data['pt']['gcs3ByDrTime'] > 0)
                {
                    $data['pt']['gcs3ByDrTime'] = pdate('Y/m/d', $data['pt']['gcs3ByDrTime']);
                }
                if($data['pt']['brainDeathTime'] > 0)
                {
                    $data['pt']['brainDeathTime'] = pdate('Y/m/d', $data['pt']['brainDeathTime']);
                }
                if($data['pt']['cardiacDeathTime'] > 0)
                {
                    $data['pt']['cardiacDeathTime'] = pdate('Y/m/d', $data['pt']['cardiacDeathTime']);
                }
                if($data['pt']['organDonationTime'] > 0)
                {
                    $data['pt']['organDonationTime'] = pdate('Y/m/d', $data['pt']['organDonationTime']);
                }
                
                $data['pt']['appRegisterTime'] = pdate('Y/m/d - H:i', $data['pt']['appRegisterTime']);

                // find other patient log
                $query = $this->db->select(array(
                    'breathingDetail',
                    'bodyMovementDetail',
                    'faceMovementDetail'
                ))->from('patients_log')->where(array(
                    'pId' => $data['pt']['id'],
                    'status' => 1
                ))->order_by('id', 'DESC')->limit(1)->get();
                if($query->num_rows() > 0)
                {
                    $query = $query->row_array();

                    $data['pt']['breathingDetail'] = $query['breathingDetail'];
                    $data['pt']['bodyMovementDetail'] = $query['bodyMovementDetail'];
                    $data['pt']['faceMovementDetail'] = $query['faceMovementDetail'];

                    return json_encode($data['pt']);
                }
                else
                {
                    echo 'Err';
                    exit;
                }
            }
            else
            {
                echo 'Err';
                exit;
            }
        }
        else
        {
            echo 'Err';
            exit;
        }
    }
    
    // transfer patient
    public function transfer_patient()
    {
        $session = $this->session->userdata('user');
        $state = $this->input->post('cbTState', TRUE, TRUE);
        $city = $this->input->post('cbTCity', TRUE, TRUE);
        $hospital = $this->input->post('cbTHospital', TRUE, TRUE);
        $time = $this->input->post('tTime', TRUE, TRUE);
        $id = $this->input->post('pId', TRUE, TRUE);
        
        
        // find opu id
        $this->db->select('opuId')
        ->from('hospitals')
        ->where(array('id' => $hospital));
        $opu = $this->db->get();
        $opu = $opu->row_array();
        if($opu['opuId'] > 0)
        {
            $opu = $opu['opuId'];
        }
        else
        {
            echo 'Err';
            exit;
        }
        // find opu id
        
        
        if($state > 0 AND $city > 0 AND $hospital > 0 AND strlen($time) > 6 AND $id > 0 AND $opu > 0)
        {
            $where = array('patients.status' => 1, 'patients.id' => $id);
            if($this->userauthentication_model->is_opu())
            {
                $where['pLog.opu'] = $session['uid'];
            }
            elseif($this->userauthentication_model->is_inspector())
            {
                $where['pLog.opu'] = $session['opuId'];
            }

            // find patient
            $pt = $this->db->select('id')->from('patients')->where(array('id' => $id, 'status' => 1))->get();
            if($pt->num_rows() > 0)
            {
                $lastLog = $this->db->select()->from('patients_log')->where(array('pId' => $id, 'status' => 1))->order_by('id', 'DESC')->limit(1)->get();
                $lastLog = $lastLog->row_array();
                $lastLog['opu'] = $opu;
                $lastLog['state'] = $state;
                $lastLog['city'] = $city;
                $lastLog['hospital'] = $hospital;
                $lastLog['patientStatus'] = 1;
                $lastLog['lastUpdateTime'] = time();
                $lastLog['id'] = null;

                // change old log to transfer
                $allLog = $this->db->select('id')->from('patients_log')->where(array('pId' => $id, 'status' => 1))->get();
                if($allLog->num_rows() > 0)
                {
                    $updateData = array('isTransfer' => 1);
                    $this->db->where('pId', $id);
                    $this->db->update('patients_log', $updateData);
                }

                // insert new log for patient
                $this->db->insert('patients_log', $lastLog);

                // update patient recoed
                $data['status'] = 15;
                $data['presentation'] = 3;
                $data['patientStatus'] = 1;
                $data['opu'] = $opu;
                $data['state'] = $state;
                $data['city'] = $city;
                $data['hospital'] = $hospital;
                $time = explode('/', $time);
                $time = pmktime(0, 0, 0, $time[1], $time[2], $time[0]);
                $data['patientTransferTime'] = $time;

                $this->db->where('id', $id);
                $this->db->update('patients', $data);

                // return result
                echo 1;
                exit;

            }
            else
            {
                echo 'Err';
                exit;
            }
        }
        else
        {
            echo 'Err';
            exit;
        }
    }
    
    // edit patient data
    public function edit_patient_data()
    {
        $session = $this->session->userdata('user');
        if ($this->input->post("inputPT", TRUE, TRUE) AND is_numeric($this->input->post("inputPT", TRUE, TRUE))) {
            $id = $this->input->post("inputPT", TRUE, TRUE);
            $chisUnknown = $this->input->post("chisUnknown", TRUE, TRUE);
            $inputFileNumber = $this->input->post("inputFileNumber", TRUE, TRUE);
            $inputFullName = $this->input->post("inputFullName", TRUE, TRUE);
            $inputAge = $this->input->post("inputAge", TRUE, TRUE);
            $inputNationalCode = $this->input->post("inputNationalCode", TRUE, TRUE);
            $cbBodyType = $this->input->post("cbBodyType", TRUE, TRUE);
            $inputFirstGCS = $this->input->post("inputFirstGCS", TRUE, TRUE);
            $inputSecondGCS = $this->input->post("inputSecondGCS", TRUE, TRUE);
            $inputCoordinatorName = $this->input->post("inputCoordinatorName", TRUE, TRUE);
            $cbDoc = $this->input->post("cbDoc", TRUE, TRUE);
            $inputDocDetail = $this->input->post("inputDocDetail", TRUE, TRUE);
            $inputPatientDetail = $this->input->post("inputPatientDetail", TRUE, TRUE);
            $cbHospitalsEdit = $this->input->post("cbHospitalsEdit", TRUE, TRUE);
            $cbSectionEdit = $this->input->post("cbSectionEdit", TRUE, TRUE);
            $inputTypeOfSection = $this->input->post("inputTypeOfSection", TRUE, TRUE);
            $cbPresentioan = $this->input->post("cbPresentioan", TRUE, TRUE);
            $cbBreathing = $this->input->post("cbBreathing", TRUE, TRUE);
            $inputBreathingDetail = $this->input->post("inputBreathingDetail", TRUE, TRUE);
            $cbCornea = $this->input->post("cbCornea", TRUE, TRUE);
            $cbPupil = $this->input->post("cbPupil", TRUE, TRUE);
            $cbFaceMove = $this->input->post("cbFaceMove", TRUE, TRUE);
            $inputFaceMovementDetail = $this->input->post("inputFaceMovementDetail", TRUE, TRUE);
            $cbBodyMove = $this->input->post("cbBodyMove", TRUE, TRUE);
            $inputBodyMovementDetail = $this->input->post("inputBodyMovementDetail", TRUE, TRUE);
            $cbDoll = $this->input->post("cbDoll", TRUE, TRUE);
            $cbGag = $this->input->post("cbGag", TRUE, TRUE);
            $cbCough = $this->input->post("cbCough", TRUE, TRUE);
            $cbTol = $this->input->post("cbTol", TRUE, TRUE);
            $cbPatientStatusEdit = $this->input->post("cbPatientStatusEdit", TRUE, TRUE);
            $inputPatientStatusDetail = $this->input->post("inputPatientStatusDetail", TRUE, TRUE);
            $inputT = $this->input->post("inputT", TRUE, TRUE);
            $inputPR = $this->input->post("inputPR", TRUE, TRUE);
            $inputFIO2 = $this->input->post("inputFIO2", TRUE, TRUE);
            $inputBPb = $this->input->post("inputBPb", TRUE, TRUE);
            $inputBPp = $this->input->post("inputBPp", TRUE, TRUE);
            $inputRR = $this->input->post("inputRR", TRUE, TRUE);
            $inputO2SAT = $this->input->post("inputO2SAT", TRUE, TRUE);
            $cbSedation = $this->input->post("cbSedation2", TRUE, TRUE);
            $inputNa = $this->input->post("inputNa", TRUE, TRUE);
            $inputBUN = $this->input->post("inputBUN", TRUE, TRUE);
            $inputUrea = $this->input->post("inputUrea", TRUE, TRUE);
            $inputALT = $this->input->post("inputALT", TRUE, TRUE);
            $inputWBC = $this->input->post("inputWBC", TRUE, TRUE);
            $inputHb = $this->input->post("inputHb", TRUE, TRUE);
            $inputK = $this->input->post("inputK", TRUE, TRUE);
            $inputCr = $this->input->post("inputCr", TRUE, TRUE);
            $inputCa = $this->input->post("inputCa", TRUE, TRUE);
            $inputAST = $this->input->post("inputAST", TRUE, TRUE);
            $inputPLT = $this->input->post("inputPLT", TRUE, TRUE);
            $inputBs = $this->input->post("inputBs", TRUE, TRUE);
            $inputOut = $this->input->post("inputOut", TRUE, TRUE);
            $chHeart = $this->input->post("chHeart", TRUE, TRUE);
            $chLiver = $this->input->post("chLiver", TRUE, TRUE);
            $chKidneyRight = $this->input->post("chKidneyRight", TRUE, TRUE);
            $chKidneyLeft = $this->input->post("chKidneyLeft", TRUE, TRUE);
            $chLungRight = $this->input->post("chLungRight", TRUE, TRUE);
            $chLungLeft = $this->input->post("chLungLeft", TRUE, TRUE);
            $chPancreas = $this->input->post("chPancreas", TRUE, TRUE);
            $chTissue = $this->input->post("chTissue", TRUE, TRUE);
            $chBowel = $this->input->post("chBowel", TRUE, TRUE);
            $pcal1 = $this->input->post("pcal1", TRUE, TRUE);
            $pcal2 = $this->input->post("pcal2", TRUE, TRUE);
            $pcal3 = $this->input->post("pcal3", TRUE, TRUE);
            $pcal5 = $this->input->post("pcal5", TRUE, TRUE);
            $pcal6 = $this->input->post("pcal6", TRUE, TRUE);

            // check is unKnown patient
            if ($chisUnknown)
            {
                $inputFullName = 'ناشناس';
                $inputNationalCode = '-';
                $inputAge = '-';
                $chisUnknown = 1;
            }
            else
            {
                $chisUnknown = 0;
            }

            // check organs
            $chHeart = $chHeart ? 1 : 0;
            $chLiver = $chLiver ? 1 : 0;
            $chKidneyRight = $chKidneyRight ? 1 : 0;
            $chKidneyLeft = $chKidneyLeft ? 1 : 0;
            $chLungRight = $chLungRight ? 1 : 0;
            $chLungLeft = $chLungLeft ? 1 : 0;
            $chPancreas = $chPancreas ? 1 : 0;
            $chTissue = $chTissue ? 1 : 0;
            $chBowel = $chBowel ? 1 : 0;

            // check tests
            if ($inputT >= 20 AND $inputT <= 50 AND
                $inputRR >= 0 AND $inputRR <= 100 AND
                $inputPR >= 0 AND $inputPR <= 200 AND
                $inputFIO2 >= 0 AND $inputFIO2 <= 100 AND
                $inputOut >= 0 AND $inputOut <= 3000 AND
                $inputBPb >= 0 AND $inputBPb <= 300 AND
                $inputBPp >= 0 AND $inputBPp <= 200 AND
                $inputO2SAT >= 0 AND $inputO2SAT <= 100 AND
                $inputNa >= 0 AND $inputNa <= 300 AND
                $inputK >= 0 AND $inputK <= 20 AND
                (($inputBUN >= 0 AND $inputBUN <= 200) || ($inputUrea >= 0 AND $inputUrea <= 500)) AND
                $inputALT >= 0 AND $inputALT <= 2000 AND
                $inputAST >= 0 AND $inputAST <= 2000 AND
                $inputHb >= 0 AND $inputHb <= 30 AND
                $inputWBC >= 0 AND $inputWBC <= 100000 AND
                $inputPLT >= 1000 AND $inputPLT <= 999000 AND
                $inputBs >= 0 AND $inputBs <= 1000 AND
                $inputCr >= 0 AND $inputCr <= 20 AND
                $inputCa >= 0 AND $inputCa <= 20
            )
            {
                $tests = 1;
            }
            else
            {
                $tests = 0;
            }

            // check have tests for GCS4
            if (strlen($inputT) > 0 || strlen($inputRR) > 0 || strlen($inputPR) > 0 || strlen($inputFIO2) > 0 || strlen($inputOut) > 0 ||
                strlen($inputBPb) > 0 || strlen($inputBPp) > 0 || strlen($inputO2SAT) > 0 || strlen($inputNa) > 0 || strlen($inputK) > 0 ||
                strlen($inputALT) > 0 || strlen($inputAST) > 0 || strlen($inputHb) > 0 || strlen($inputWBC) > 0 || strlen($inputPLT) > 0 ||
                strlen($inputBs) > 0 || strlen($inputCr) > 0 || strlen($inputCa) > 0 || strlen($inputBUN) > 0 || strlen($inputUrea) > 0
            )
            {
                $haveTests = 1;
            }
            else
            {
                $haveTests = 0;
            }

            // check sedation
            $cbSedation = $cbSedation ? 'Yes' : 'No';

            // validate data
            $insert = 1;
            if(strlen($inputFileNumber) > 0 AND $cbDoc > 0 AND $inputSecondGCS >= 3 AND $inputSecondGCS <= 15 AND
                $cbPresentioan > 0 AND $cbHospitalsEdit > 0 AND $cbSectionEdit > 0 AND $cbTol > 0 AND
                $cbPatientStatusEdit > 0 AND (strlen($inputFullName) > 5 OR $inputFullName == '-') AND
                (strlen($inputAge) > 0 OR $inputAge == '-') AND strlen($pcal1) > 6)
            {
                if($cbTol == 1)
                {
                    if($cbPatientStatusEdit == 6)
                    {
                        $allOrgan = $chHeart + $chKidneyLeft + $chKidneyRight + $chLungLeft + $chLungRight + $chLiver + $chPancreas + $chTissue + $chBowel;
                        if($cbBreathing == 'N' AND $cbCornea == 'N' AND $cbPupil == 'N' AND $cbFaceMove == 'N' AND $cbBodyMove == 'N' AND
                        $cbDoll == 'N' AND $cbGag == 'N' AND $cbCough == 'N' AND strlen($inputCoordinatorName) > 5 AND
                        strlen($pcal3) > 6 AND strlen($pcal5) > 6 AND $allOrgan > 0 AND $inputSecondGCS == 3)
                        {
                            $insert = 1;
                        }
                        else
                        {
                            $insert = 0;
                        }
                    }
                    elseif(($cbPatientStatusEdit >= 9 AND $cbPatientStatusEdit <= 15) || $cbPatientStatusEdit == 23)
                    {
                        if(strlen($pcal3) > 6 AND strlen($pcal6) > 6)
                        {
                            if($cbTol == 1)
                            {
                                if($cbBreathing == 'N' AND $cbCornea == 'N' AND $cbPupil == 'N' AND $cbFaceMove == 'N' AND $cbBodyMove == 'N' AND
                                    $cbDoll == 'N' AND $cbGag == 'N' AND $cbCough == 'N' AND $inputSecondGCS == 3)
                                {
                                    $insert = 1;
                                }
                                else
                                {
                                    $insert = 0;
                                }
                            }
                            else
                            {
                                $insert = 1;
                            }
                        }
                        else
                        {
                            $insert = 0;
                        }
                    }
                    else
                    {
                        $insert = 1;
                    }
                }
                else
                {
                    if($cbPatientStatusEdit == 3)
                    {
                        if(strlen($pcal6) > 6)
                        {
                            $insert = 1;
                        }
                        else
                        {
                            $insert = 0;
                        }
                    }
                }
            }
            else
            {
                $insert = 0;
            }
            // validate data

            // find patient
            $where = array('patients.status' => 1, 'patients.id' => $id);
            if ($this->userauthentication_model->is_opu())
            {
                $where['opu'] = $session['uid'];
            }
            elseif ($this->userauthentication_model->is_inspector())
            {
                $where['opu'] = $session['opuId'];
            }

            $this->db->select();
            $this->db->from('patients');
            $this->db->where($where);
            $query = $this->db->get();
            if ($query->num_rows() > 0)
            {
                $pt = $query->row_array();
                if ($tests == 1 AND $haveTests == 1 AND $insert == 1)
                {
                    // find last test for check edit
                    $ptTest = $this->db->select()->from('tests')->where(array(
                        'pId' => $id,
                        'status' => 1
                    ))->order_by('id', 'DESC')->limit(1)->get();
                    if ($ptTest->num_rows() > 0)
                    {
                        $ptTest = $ptTest->row_array();
                        if ($ptTest['na'] != $inputNa || $ptTest['k'] != $inputK || $ptTest['bun'] != $inputBUN ||
                            $ptTest['urea'] != $inputUrea || $ptTest['cr'] != $inputCr || $ptTest['alt'] != $inputALT ||
                            $ptTest['ast'] != $inputAST || $ptTest['wbc'] != $inputWBC || $ptTest['plt'] != $inputPLT ||
                            $ptTest['hb'] != $inputHb || $ptTest['bs'] != $inputBs || $ptTest['out'] != $inputOut ||
                            $ptTest['ca'] != $inputCa || $ptTest['t'] != $inputT || $ptTest['b'] != $inputBPb ||
                            $ptTest['p'] != $inputBPp || $ptTest['pr'] != $inputPR || $ptTest['rr'] != $inputRR ||
                            $ptTest['fio2'] != $inputFIO2 || $ptTest['o2sat'] != $inputO2SAT || $ptTest['sedation'] != $cbSedation
                        )
                        {
                            $insertData = array(
                                'pId' => $id,
                                'status' => 1,
                                'na' => $inputNa,
                                'k' => $inputK,
                                'bun' => $inputBUN,
                                'urea' => $inputUrea,
                                'cr' => $inputCr,
                                'alt' => $inputALT,
                                'ast' => $inputAST,
                                'wbc' => $inputWBC,
                                'plt' => $inputPLT,
                                'hb' => $inputHb,
                                'bs' => $inputBs,
                                'out' => $inputOut,
                                'ca' => $inputCa,
                                't' => $inputT,
                                'b' => $inputBPb,
                                'p' => $inputBPp,
                                'pr' => $inputPR,
                                'rr' => $inputRR,
                                'fio2' => $inputFIO2,
                                'o2sat' => $inputO2SAT,
                                'sedation' => $cbSedation,
                            );
                            $this->db->insert('tests', $insertData);
                        }
                    }
                    else
                    {
                        $insertData = array(
                            'pId' => $id,
                            'status' => 1,
                            'na' => $inputNa,
                            'k' => $inputK,
                            'bun' => $inputBUN,
                            'urea' => $inputUrea,
                            'cr' => $inputCr,
                            'alt' => $inputALT,
                            'ast' => $inputAST,
                            'wbc' => $inputWBC,
                            'plt' => $inputPLT,
                            'hb' => $inputHb,
                            'bs' => $inputBs,
                            'out' => $inputOut,
                            'ca' => $inputCa,
                            't' => $inputT,
                            'b' => $inputBPb,
                            'p' => $inputBPp,
                            'pr' => $inputPR,
                            'rr' => $inputRR,
                            'fio2' => $inputFIO2,
                            'o2sat' => $inputO2SAT,
                            'sedation' => $cbSedation,
                        );
                        $this->db->insert('tests', $insertData);
                        if ($this->db->affected_rows() > 0) {
                            $insertTest = 1;
                        } else {
                            $insertTest = 2;
                        }
                    }

                    // insert patient log
                    if ($this->userauthentication_model->is_admin())
                    {
                        $ins = 0;
                        $opuid = NULL;
                    }
                    elseif ($this->userauthentication_model->is_opu())
                    {
                        $ins = -1;
                        $opuid = $session['uid'];
                    }
                    elseif ($this->userauthentication_model->is_inspector())
                    {
                        $ins = $session['uid'];
                        $opuid = NULL;
                    }

                    $patientLog = array(
                        'pId' => $id,
                        'status' => 1,
                        'breathing' => $cbBreathing,
                        'breathingDetail' => $inputBreathingDetail,
                        'bodyMovement' => $cbBodyMove,
                        'bodyMovementDetail' => $inputBodyMovementDetail,
                        'faceMovement' => $cbFaceMove,
                        'faceMovementDetail' => $inputFaceMovementDetail,
                        'gag' => $cbGag,
                        'cough' => $cbCough,
                        'cornea' => $cbCornea,
                        'pupil' => $cbPupil,
                        'dollEye' => $cbDoll,
                        'secondGCS' => $inputSecondGCS,
                        'sedation' => $cbSedation,
                        'state' => $pt['state'],
                        'city' => $pt['city'],
                        'opu' => $pt['opu'],
                        'inspector' => $ins,
                        'hospital' => $cbHospitalsEdit,
                        'section' => $cbSectionEdit,
                        'typeOfSection' => $inputTypeOfSection,
                        'lastUpdateTime' => time(),
                        'isTransfer' => 0,
                        'tol' => $cbTol,
                        'patientStatus' => $cbPatientStatusEdit,
                        'patientStatusDetail' => $inputPatientStatusDetail
                    );
                    $this->db->insert('patients_log', $patientLog);
                    // insert patient log

                    // update patient record
                    $patientUpdate = array(
                        'fileNumber' => $inputFileNumber,
                        'fullName' => $inputFullName,
                        'age' => $inputAge,
                        'bodyType' => $cbBodyType,
                        'nationalCode' => $inputNationalCode,
                        'isUnknown' => $chisUnknown,
                        'doc' => $cbDoc,
                        'docDetail' => $inputDocDetail,
                        'tol' => $cbTol,
                        'patientStatus' => $cbPatientStatusEdit,
                        'patientStatusDetail' => $inputPatientStatusDetail,
                        'patientDetail' => $inputPatientDetail,
                        'presentation' => $cbPresentioan,
                        'coordinatorName' => $inputCoordinatorName,
                        'breathing' => $cbBreathing,
                        'bodyMovement' => $cbBodyMove,
                        'faceMovement' => $cbFaceMove,
                        'gag' => $cbGag,
                        'cough' => $cbCough,
                        'cornea' => $cbCornea,
                        'pupil' => $cbPupil,
                        'dollEye' => $cbDoll,
                        'secondGCS' => $inputSecondGCS,
                        'sedation' => $cbSedation,
                        'lastInspector' => $ins,
                        'hospital' => $cbHospitalsEdit,
                        'section' => $cbSectionEdit,
                        'typeOfSection' => $inputTypeOfSection,
                        'lastUpdate' => time(),
                        'na' => $inputNa,
                        'k' => $inputK,
                        'bun' => $inputBUN,
                        'urea' => $inputUrea,
                        'cr' => $inputCr,
                        'alt' => $inputALT,
                        'ast' => $inputAST,
                        'wbc' => $inputWBC,
                        'plt' => $inputPLT,
                        'hgb' => $inputHb,
                        'bs' => $inputBs,
                        'out' => $inputOut,
                        'ca' => $inputCa,
                        't' => $inputT,
                        'b' => $inputBPb,
                        'p' => $inputBPp,
                        'pr' => $inputPR,
                        'rr' => $inputRR,
                        'fio2' => $inputFIO2,
                        'o2sat' => $inputO2SAT,
                    );

                    // insert organ for organ donation patient where cbTol == 1 AND patientStatus == 6
                    if($cbTol == 1 AND $cbPatientStatusEdit == 6)
                    {
                        // delete old record for patient organs
                        $this->db->where('pId', $id);
                        $this->db->delete('organs');
                        // delete old record for patient organs
                        
                        $patientUpdate['heart'] = $chHeart; 
                        $patientUpdate['liver'] = $chLiver; 
                        $patientUpdate['kidneyRight'] = $chKidneyRight; 
                        $patientUpdate['kidneyLeft'] = $chKidneyLeft; 
                        $patientUpdate['lungRight'] = $chLungRight; 
                        $patientUpdate['lungLeft'] = $chLungLeft; 
                        $patientUpdate['pancreas'] = $chPancreas; 
                        $patientUpdate['tissue'] = $chTissue; 
                        $patientUpdate['bowel'] = $chBowel; 
                        $insertData = array(
                            'pId' => $id,
                            'status' => 1,
                            'heart' => $chHeart,
                            'liver' => $chLiver,
                            'kidneyRight' => $chKidneyRight,
                            'kidneyLeft' => $chKidneyLeft,
                            'lungRight' => $chLungRight,
                            'lungLeft' => $chLungLeft,
                            'pancreas' => $chPancreas,
                            'tissue' => $chTissue,
                            'bowel' => $chBowel
                        );
                        $this->db->insert('organs', $insertData);
                    }

                    if($pcal1)
                    {
                        $patientUpdate['hospitalizationTime'] = explode('/', $pcal1);
                        $patientUpdate['hospitalizationTime'] = pmktime(0, 0, 0, $patientUpdate['hospitalizationTime'][1], $patientUpdate['hospitalizationTime'][2], $patientUpdate['hospitalizationTime'][0]);
                    }
                    if($pcal2)
                    {
                        $patientUpdate['gcs3ByDrTime'] = explode('/', $pcal2);
                        $patientUpdate['gcs3ByDrTime'] = pmktime(0, 0, 0, $patientUpdate['gcs3ByDrTime'][1], $patientUpdate['gcs3ByDrTime'][2], $patientUpdate['gcs3ByDrTime'][0]);
                    }
                    if($pcal3)
                    {
                        $patientUpdate['brainDeathTime'] = explode('/', $pcal3);
                        $patientUpdate['brainDeathTime'] = pmktime(0, 0, 0, $patientUpdate['brainDeathTime'][1], $patientUpdate['brainDeathTime'][2], $patientUpdate['brainDeathTime'][0]);
                    }
                    if($pcal5)
                    {
                        $patientUpdate['organDonationTime'] = explode('/', $pcal5);
                        $patientUpdate['organDonationTime'] = pmktime(0, 0, 0, $patientUpdate['organDonationTime'][1], $patientUpdate['organDonationTime'][2], $patientUpdate['organDonationTime'][0]);
                    }
                    if($pcal6)
                    {
                        $patientUpdate['cardiacDeathTime'] = explode('/', $pcal6);
                        $patientUpdate['cardiacDeathTime'] = pmktime(0, 0, 0, $patientUpdate['cardiacDeathTime'][1], $patientUpdate['cardiacDeathTime'][2], $patientUpdate['cardiacDeathTime'][0]);
                    }

                    $this->db->where('id', $id);
                    $this->db->update('patients', $patientUpdate);
                    // update patient record

                    // return data
                    echo 'OK';

                }
                else
                {
                    echo 'Err';
                    exit;
                }
            }
            else
            {
                echo 'Err';
                exit;
            }
        }
        else
        {
            echo 'Err';
            exit;
        }

    }
    
    // load one patient extra data
    public function load_one_patient_extra_data()
    {
        if($this->input->post('pID', TRUE, TRUE))
        {
            $id = $this->input->post('pID', TRUE, TRUE);
            
            // load patient test
            $this->db->select()
            ->from('tests')
            ->where(array('pId' => $id, 'status' => 1))
            ->order_by('id', 'DESC')
            ->limit(1,0);
            $data['test'] = $this->db->get();
            if($data['test']->num_rows() > 0)
            {
                $data['test'] = $data['test']->row_array();
                $data['isTest'] = 1;
            }
            else
            {
                $data['isTest'] = 0;
                $data['test'] = 0;
            }
            
            // load patient organs
            $this->db->select(array(
                                    'heart',
                                    'liver',
                                    'kidneyRight',
                                    'kidneyLeft',
                                    'lungRight',
                                    'lungLeft',
                                    'pancreas',
                                    'tissue',
                                    'bowel'
                                    ))
            ->from('organs')
            ->where(array('pId' => $id, 'status' => 1))
            ->order_by('id', 'DESC')
            ->limit(1,0); 
            $data['organ'] = $this->db->get();
            if($data['organ']->num_rows() > 0)
            {
                $data['organ'] = $data['organ']->row_array();
                $data['isOrgan'] = 1;
            }
            else
            {
                $data['isOrgan'] = 0;
                $data['organ'] = 0;
            }
            return json_encode($data);
        }
    }
    
    // load one patient logs
    public function load_one_patient_log()
    {
        $session = $this->session->userdata('user');
        if($this->input->post('pID', TRUE, TRUE))
        {
            $id = $this->input->post('pID', TRUE, TRUE);
            
            // load patient test
            $this->db->select(array(
                                    'na',
                                    'k',
                                    'bun',
                                    'urea',
                                    'cr',
                                    'alt',
                                    'ast',
                                    'wbc',
                                    'plt',
                                    'hb',
                                    'bs',
                                    'out',
                                    'ca',
                                    't',
                                    'b',
                                    'p',
                                    'pr',
                                    'rr',
                                    'fio2',
                                    'o2sat',
                                    'sedation',
                                    ))
            ->from('tests')
            ->where(array('pId' => $id, 'status < ' => 13))
            ->order_by('id', 'DESC');
            $data['test'] = $this->db->get();
            if($data['test']->num_rows() > 0)
            {
                $data['test'] = $data['test']->result_array();
                $data['isTest'] = 1;
                $data['countTest'] = count($data['test']);
                $data['isData'] = 1;
            }
            else
            {
                $data['isTest'] = 0;
                $data['test'] = 0;
            }
            
            // load patient organs
            $this->db->select(array(
                                    'heart',
                                    'liver',
                                    'kidneyRight',
                                    'kidneyLeft',
                                    'lungRight',
                                    'lungLeft',
                                    'pancreas',
                                    'tissue',
                                    'bowel'
                                    ))
            ->from('organs')
            ->where(array('pId' => $id, 'status < ' => 13))
            ->order_by('id', 'DESC')
            ->limit(1,0);
            $data['organ'] = $this->db->get();
            if($data['organ']->num_rows() > 0)
            {
                $data['organ'] = $data['organ']->row_array();
                $data['isOrgan'] = 1;
                $data['isData'] = 1;
            }
            else
            {
                $data['isOrgan'] = 0;
                $data['organ'] = 0;
            }
            
            // load patient log
            $where = array('patients_log.status < ' => 13, 'patients_log.pId' => $id);
            if($this->userauthentication_model->is_opu())
            {
                $where['patients_log.opu'] = $session['uid'];
                $where['isTransfer'] = 0;
            }
            elseif($this->userauthentication_model->is_inspector())
            {
                $where['patients_log.opu'] = $session['opuId'];
                $where['isTransfer'] = 0;
            }
            $this->db->select(array(
                                    'patients_log.breathing',
                                    'patients_log.breathingDetail',
                                    'patients_log.bodyMovement',
                                    'patients_log.bodyMovementDetail',
                                    'patients_log.faceMovement',
                                    'patients_log.faceMovementDetail',
                                    'patients_log.gag',
                                    'patients_log.cough',
                                    'patients_log.cornea',
                                    'patients_log.pupil',
                                    'patients_log.dollEye',
                                    'patients_log.secondGCS',
                                    'patients_log.sedation',
                                    'patients_log.state',
                                    'patients_log.city',
                                    'patients_log.opu',
                                    'patients_log.inspector',
                                    'patients_log.hospital',
                                    'patients_log.section',
                                    'patients_log.typeOfSection',
                                    'patients_log.lastUpdateTime',
                                    'patients_log.res1',
                                    'patients_log.tol',
                                    'patients_log.patientStatus',
                                    'patients_log.patientStatusDetail'
                                    ))
            ->from('patients_log')
            ->where($where)
            ->order_by('id', 'DESC');
            $data['log'] = $this->db->get();
            if($data['log']->num_rows() > 0)
            {
                $data['isLog'] = 1;
                $data['isData'] = 1;
                $data['log'] = $data['log']->result_array();
                $data['countLog'] = count($data['log']);
                for($i = 0; $i < count($data['log']); $i++)
                {
                    $data['log'][$i]['state'] = $this->db->select('name')->from('states')->where(array('id' => $data['log'][$i]['state']))->get()->row_array();
                    $data['log'][$i]['state'] = $data['log'][$i]['state']['name'];
                    
                    $data['log'][$i]['city'] = $this->db->select('name')->from('states')->where(array('id' => $data['log'][$i]['city']))->get()->row_array();
                    $data['log'][$i]['city'] = $data['log'][$i]['city']['name'];
                    
                    $data['log'][$i]['opu'] = $this->db->select('name')->from('opu')->where(array('id' => $data['log'][$i]['opu']))->get()->row_array();
                    $data['log'][$i]['opu'] = $data['log'][$i]['opu']['name'];
                    
                    $data['log'][$i]['hospital'] = $this->db->select('name')->from('hospitals')->where(array('id' => $data['log'][$i]['hospital']))->get()->row_array();
                    $data['log'][$i]['hospital'] = $data['log'][$i]['hospital']['name'];
                    
                    $data['log'][$i]['lastUpdateTime'] = pdate('Y/m/d', $data['log'][$i]['lastUpdateTime']);

                    $data['log'][$i]['tolData'] = $this->db->select('name')->from('tol')->where('id', $data['log'][$i]['tol'])->get()->row_array();
                    $data['log'][$i]['tol'] = $data['log'][$i]['tolData']['name'];

                    $data['log'][$i]['tolData'] = $this->db->select(array('name', 'color', 'res1'))->from('tol_options')->where('id', $data['log'][$i]['patientStatus'])->get()->row_array();
                    $data['log'][$i]['patientStatus'] = $data['log'][$i]['tolData'];

                    if($data['log'][$i]['inspector'] > 0)
                    {
                        $data['log'][$i]['inspector'] = $this->db->select('name')->from('inspectors')->where(array('id' => $data['log'][$i]['inspector']))->get()->row_array();
                        $data['log'][$i]['inspector'] = $data['log'][$i]['inspector']['name'];
                    }
                    elseif($data['log'][$i]['inspector'] < 0)
                    {
                        $data['log'][$i]['inspector'] = $data['log'][$i]['opu'];
                    }
                    else
                    {
                        $data['log'][$i]['inspector'] = 'مسئول سامانه بازرسین';
                    }
                }
            }
            
            return json_encode($data);
        }
    }
    
    // delete patient
    public function change_patient_status()
    {
        $session = $this->session->userdata('user');
        if($this->input->post('pID'))
        {
            $id = $this->input->post('pID');
            $pt = $this->db->select('id')->from('patients')->where(array('status < ' => 12, 'id' => $id))->get();
            if($pt->num_rows() > 0)
            {
                $pt = $pt->row_array();
                $where = array('pId' => $id, 'status < ' => 12);
                if($this->userauthentication_model->is_opu())
                {
                    $where['opu'] = $session['uid'];
                }
                $ptLog = $this->db->select('id')->from('patients_log')->where($where)->limit(1,0)->get();
                if($ptLog->num_rows() > 0)
                {
                    $updateData = array('status' => 12);
                    $this->db->where(array('pId' => $id));
                    $this->db->update('patients_log', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('condition', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('tests', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('organs', $updateData);
                    
                    $this->db->where(array('id' => $id));
                    $this->db->update('patients', $updateData);
                    
                    return 1;
                }
                else
                {
                    return 2;
                }
            }
            else
            {
                return 2;
            }
        }
    }
    
    // undo delete patient
    public function change_undo_patient_status()
    {
        $session = $this->session->userdata('user');
        if($this->input->post('pID'))
        {
            $id = $this->input->post('pID');
            $pt = $this->db->select('id')->from('patients')->where(array('status' => 12, 'id' => $id))->get();
            if($pt->num_rows() > 0)
            {
                $pt = $pt->row_array();
                $where = array('pId' => $id, 'status' => 12);
                if($this->userauthentication_model->is_opu())
                {
                    $where['opu'] = $session['uid'];
                }
                $ptLog = $this->db->select('id')->from('patients_log')->where($where)->limit(1,0)->get();
                if($ptLog->num_rows() > 0)
                {
                    $updateData = array('status' => 1);
                    $this->db->where(array('pId' => $id));
                    $this->db->update('patients_log', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('condition', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('tests', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('organs', $updateData);
                    
                    $this->db->where(array('id' => $id));
                    $this->db->update('patients', $updateData);
                    
                    return 1;
                }
                else
                {
                    return 2;
                }
            }
            else
            {
                return 2;
            }
        }
    }
    
    // verify or unverify patient transfer
    public function verify_patient_transfer()
    {
        if($this->input->post('pID') AND $this->input->post('pStatus'))
        {
            $id = $this->input->post('pID');
            $status = $this->input->post('pStatus');
            if($status == 'verify')
            {
                $pt = $this->db->select('id')->from('patients')->where(array('id' => $id, 'status' => 15))->get();
                if($pt->num_rows() > 0)
                {
                    $update = array('status' => 1);
                    $this->db->where('id', $id);
                    $this->db->update('patients', $update);
                    return 1;
                    exit;
                }
                else
                {
                    return 2;
                    exit;
                }
            }
            elseif($status == 'unVerify')
            {
                $pt = $this->db->select('id')->from('patients')->where(array('id' => $id, 'status' => 15))->get();
                if($pt->num_rows() > 0)
                {
                    $ptLog = $this->db->select('id')->from('patients_log')->where(array('isTransfer' => 0, 'status' => 1, 'pId' => $id))->get();
                    if($ptLog->num_rows() > 0)
                    {
                        $ptLog = $ptLog->row_array();
                        $this->db->delete('patients_log', array('id' => $ptLog['id']));
                        $update = array('isTransfer' => 0);
                        $this->db->where(array('isTransfer' => 1, 'status' => 1, 'pId' => $id));
                        $this->db->update('patients_log', $update);

                        $undoLog = $this->db->select()->from('patients_log')->where(array('pId' => $id, 'status' => 1))->order_by('id', 'DESC')->limit(1)->get();
                        if($undoLog->num_rows() > 0)
                        {
                            $undoLog = $undoLog->row_array();

                            // update patient recoed
                            $data['status'] = 1;
                            $data['patientStatus'] = $undoLog['patientStatus'];
                            $data['opu'] = $undoLog['opu'];
                            $data['state'] = $undoLog['state'];
                            $data['city'] = $undoLog['city'];
                            $data['hospital'] = $undoLog['hospital'];
                            $data['patientTransferTime'] = null;

                            $this->db->where('id', $id);
                            $this->db->update('patients', $data);
                            return 1;
                            exit;
                        }
                        else
                        {
                            return 2;
                            exit;
                        }
                    }
                    else
                    {
                        return 2;
                        exit;
                    }
                }
                else
                {
                    return 2;
                    exit;
                }
            }
        }
    }
    
    // delete hospital
    public function delete_one_hospital()
    {
        if($this->input->post('hID') AND is_numeric($this->input->post('hID')))
        {
            $id = $this->input->post('hID');
            $hos = $this->db->select('id')->from('hospitals')->where(array('id' => $id, 'status' => 1))->get();
            if($hos->num_rows() > 0)
            {
                $update = array('status' => 12);
                $this->db->where('id', $id);
                $this->db->update('hospitals', $update);
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
            else
            {
                return 2;
                exit;
            }
        }
        else
        {
            return 2;
            exit;
        }
    }
    
    // found patient result in add patient form
    public function found_patient_result()
    {
        $session = $this->session->userdata('user');
        $name = $this->input->post('pName', TRUE, TRUE);
        if($name AND strlen($name) > 3)
        {
            $where = array('patients.status' => 1, 'patients.isArchive' => 0);
            if($this->userauthentication_model->is_opu())
            {
                $where['opu'] = $session['uid'];
                $data['url'] = 'opu';
            }
            elseif($this->userauthentication_model->is_inspector())
            {
                $where['opu'] = $session['opuId'];
                $data['url'] = 'inspector';
            }
            if($this->userauthentication_model->is_admin())
            {
                $data['url'] = 'admin';
            }
            
            // query
            $this->db->select(array(
                                'id',
                                'fullName',
                                ));
            $this->db->from('patients');
            $this->db->where($where);
            $this->db->like('fullName', htmlCoding($name), 'both');
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $data['num_rows'] = $query->num_rows();
            }
            else
            {
                $data['num_rows'] = 0;
            }
        }
        else
        {
            $data['num_rows'] = 0;
        }
        return json_encode($data);
    }
    
    // add state and city
    public function add_state()
    {
        if($this->input->post('stName') AND strlen($this->input->post('stName')) > 1 AND is_numeric($this->input->post('pId')) AND $this->input->post('pId') >= 0)
        {
            $id = $this->input->post('pId');
            $st = htmlCoding($this->input->post('stName'));
            $data = array(
                        'name' => $st,
                        'parentID' => $id,
                        'status' => 1
                        );
            $this->db->insert('states', $data); 
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
        else
        {
            return 2;
            exit;
        }
    }
    
    // delete state or city
    public function delete_state_or_city()
    {
        if($this->input->post('sID') AND is_numeric($this->input->post('sID')) AND $this->input->post('sID') > 0)
        {
            $id = $this->input->post('sID');
            $query = $this->db->select('*')->from('states')->where(array('id' => $id, 'status' => 1))->get();
            if($query->num_rows() > 0)
            {
                $query = $query->row_array();
                if($query['parentID'] < 1)
                {
                    $data = array(
                                'status' => 0
                                );
                    $this->db->where(array('parentID' => $id));
                    $this->db->update('states', $data);
                    
                    $this->db->where(array('id' => $id));
                    $this->db->update('states', $data);
                    return 1;
                    exit;
                }
                else
                {
                    $data = array(
                                'status' => 0
                                );
                    
                    $this->db->where(array('id' => $id));
                    $this->db->update('states', $data);
                    return 1;
                    exit;
                }
            }
            else
            {
                return 2;
                exit;
            }
        }
        else
        {
            return 2;
            exit;
        }
    }
}