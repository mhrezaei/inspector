<?php
class ManagePatientQuery_model extends CI_Model {

    public function __construct()
    {
        
    }
    // search tol option with parent id and status 1
    private function searchTolOptionWithParent($pid)
    {
        $this->db->select('id')
        ->from('tol_options')
        ->where(array('parentID' => $pid, 'status' => 1));
        $tOtion = $this->db->get();
        $tOtion = $tOtion->result_array();
        if($tOtion AND is_array($tOtion) AND count($tOtion) > 0)
        {
            return $tOtion;
        }
        else
        {
            return false;
        }
    }
    public function patient_data_query($where, $class)
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
        $isHospital = false;
        $isInspector = false;
        $isSection = false;
        $isPresentation = false;
        $isDoc = false;
        $isPatientStatus = false;
        $orderType = 'pLog.lastUpdateTime DESC';
        $wheres = $where;
        // opu id set
        if(isset($wheres['pLog.opu']) AND is_numeric($wheres['pLog.opu']) AND $wheres['pLog.opu'] > 0)
        {
            $isOpu = $wheres['pLog.opu'];
        }
        // opu id set
        // search tools  start
        if($this->input->get('searchTools'))
        {
            $url .= 'searchTools=true&';
            if($this->input->get('cbPatientStatus') > 0)
            {
                $tOtion = $this->searchTolOptionWithParent($this->input->get('cbPatientStatus'));
                if($tOtion)
                {
                    $top = '( ';
                    for($a = 0; $a < count($tOtion); $a++)
                    {
                        if($a == 0)
                        {
                            $top .= "mhr_patients.patientStatus  = " . $tOtion[$a]['id'] . " ";
                        }
                        else
                        {
                            $top .= "OR mhr_patients.patientStatus  = " . $tOtion[$a]['id'] . " ";
                        }
                    }
                    $top .= "OR mhr_patients.patientStatus  = " . $this->input->get('cbPatientStatus') . " )";
                    $this->db->where($top);
                }
                else
                {
                    $wheres['patients.patientStatus'] = $this->input->get('cbPatientStatus');
                }
                $url .= 'cbPatientStatus=' . $this->input->get('cbPatientStatus') . '&';
                $isPatientStatus = $this->input->get('cbPatientStatus');
            }
            if($this->input->get('inputPatientFilter') AND strlen($this->input->get('inputPatientFilter')) > 0)
            {
                $this->db->where("( mhr_patients.fullName  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter')). "%' 
                                    OR  mhr_patients.nationalCode  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter')) . "%' 
                                    OR  mhr_patients.fileNumber  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter')) . "%' 
                                    OR  mhr_patients.age  LIKE '" . htmlCoding($this->input->get('inputPatientFilter')) . "' 
                                    OR  mhr_patients.firstGCS  LIKE '" . htmlCoding($this->input->get('inputPatientFilter')) . "' 
                                    OR  mhr_patients.patientDetail  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter')) . "%' )");
                $url .= 'inputPatientFilter=' . $this->input->get('inputPatientFilter') . '&';
            }
            if($this->input->get('cbOpu') > 0)
            {
                if($this->userauthentication_model->is_admin())
                {
                    $wheres['pLog.opu'] = $this->input->get('cbOpu');
                    $url .= 'cbOpu=' . $this->input->get('cbOpu') . '&';
                    $isOpu = $this->input->get('cbOpu');
                }
            }
            if($this->input->get('cbHospital') > 0)
            {
                $wheres['pLog.hospital'] = $this->input->get('cbHospital');
                $url .= 'cbHospital=' . $this->input->get('cbHospital') . '&';
                $isHospital = $this->input->get('cbHospital');
            }
            if($this->input->get('cbInspector') > 0)
            {
                $wheres['pLog.inspector'] = $this->input->get('cbInspector');
                $url .= 'cbInspector=' . $this->input->get('cbInspector') . '&';
                $isInspector = $this->input->get('cbInspector');
            }
            if($this->input->get('cbSection') > 0)
            {
                $wheres['pLog.section'] = $this->input->get('cbSection');
                $url .= 'cbSection=' . $this->input->get('cbSection') . '&';
                $isSection = $this->input->get('cbSection');
            }
            if($this->input->get('cbInspectorType') > 0)
            {
                $wheres['patients.presentation'] = $this->input->get('cbInspectorType');
                $url .= 'cbInspectorType=' . $this->input->get('cbInspectorType') . '&';
                $isPresentation = $this->input->get('cbInspectorType');
            }
            if($this->input->get('cbDocDetail') > 0)
            {
                $wheres['patients.doc'] = $this->input->get('cbDocDetail');
                $url .= 'cbDocDetail=' . $this->input->get('cbDocDetail') . '&';
                $isDoc = $this->input->get('cbDocDetail');
            }
            if($this->input->get('cbOrder'))
            {
                $url .= 'cbOrder=' . $this->input->get('cbOrder') . '&';
                $orderType = $this->input->get('cbOrder');
                if($this->input->get('cbOrderBy'))
                {
                    $orderType .= ' ' . $this->input->get('cbOrderBy');
                    $url .= 'cbOrderBy=' . $this->input->get('cbOrderBy') . '&';
                }
                else
                {
                    $orderType .= ' DESC';
                }
            }
        }
        
        // search tools  end
        $this->db->select(array(
                            'patients.id', 
                            'patients.fullName', 
                            'patients.age', 
                            'patients.firstGCS', 
                            'patients.fileNumber', 
                            'patients.isUnKnown', 
                            'patients.docDetail', 
                            'patients.presentation', 
                            'patients.appRegisterTime', 
                            'patients.inspectorRegisterTime', 
                            'patients.patientStatusDetail', 
                            'patients.patientDetail', 
                            'patients.doc', 
                            'patients.status', 
                            'docT.text AS docText', 
                            'tolOp.name AS tolOpName', 
                            'tolOp.color AS tolOpColor', 
                            'tolOp.res1 AS tolOpTextColor', 
                            'pLog.breathing', 
                            'pLog.bodyMovement', 
                            'pLog.faceMovement', 
                            'pLog.gag', 
                            'pLog.cough', 
                            'pLog.cornea', 
                            'pLog.pupil', 
                            'pLog.dollEye', 
                            'pLog.secondGCS', 
                            'pLog.sedation', 
                            'pLog.inspector', 
                            'pLog.status As pLogStatus', 
                            'pLog.section', 
                            'MAX(pLog.id) AS pLogId', 
                            'pLog.typeOfSection', 
                            'pLog.lastUpdateTime', 
                            'pLog.isTransfer', 
                            'pLog.res1', 
                            'hos.name AS hosName', 
                            'opu.name AS opuName', 
                            'opu.id AS opuId', 
                            'states.name AS cityName',
                            'inspectors.name AS insName'
                            ));
        $this->db->from('patients');
    
        $this->db->join('doc AS docT' ,'docT.id = patients.doc');
        $this->db->join('tol_options AS tolOp' ,'tolOp.id = patients.patientStatus');
        //$this->db->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT mhr_patients_log.id FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id ORDER BY id DESC LIMIT 0,1)');
        $this->db->join('patients_log AS pLog' ,'pLog.pId = patients.id');
        $this->db->join('hospitals AS hos' ,'hos.id = pLog.hospital');
        $this->db->join('opu' ,'opu.id = pLog.opu');
        $this->db->join('states' ,'states.id = pLog.city');
        $this->db->join('inspectors' ,'inspectors.id = pLog.inspector', 'left');
        
        $this->db->where($wheres);
        $this->db->order_by($orderType);
        $this->db->group_by('pLog.pId');
        $this->db->limit($num,$row);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            $data['pt'] = $query->result_array();
            for($i = 0; $i < count($data['pt']); $i++)
            {
                $data['pt'][$i]['inspector'] = $this->db->select(array('inspector', 'res1'))->from('patients_log')->where(array('status < ' => 13, 'pId' => $data['pt'][$i]['id']))->order_by('id', 'DESC')->limit(1,0)->get()->row_array();
                $data['pt'][$i]['firstRes'] = $data['pt'][$i]['inspector']['res1'];
                $data['pt'][$i]['inspector'] = $data['pt'][$i]['inspector']['inspector'];
                // load opu name as inspector ROLE
                if($data['pt'][$i]['inspector'] > 0)
                {
                    // load first inspector name
                    $data['pt'][$i]['insName'] = $this->db->select('name')->from('inspectors')->where('id', $data['pt'][$i]['inspector'])->get();
                    if($data['pt'][$i]['insName']->num_rows() > 0)
                    {
                        $data['pt'][$i]['insName'] = $data['pt'][$i]['insName']->row_array();
                        $data['pt'][$i]['insName'] = $data['pt'][$i]['insName']['name'];
                    }
                    else
                    {
                        $data['pt'][$i]['insName'] = '';
                    }
                }
                elseif($data['pt'][$i]['inspector'] == -1)
                {
                    $data['pt'][$i]['insName'] = $this->db->select('name')->from('opu')->where(array('id' => $data['pt'][$i]['firstRes']))->get()->row_array();
                    $data['pt'][$i]['insName'] = $data['pt'][$i]['insName']['name'];
                }
                elseif($data['pt'][$i]['inspector'] == 0)
                {
                    $data['pt'][$i]['insName'] = 'مسئول سامانه بازرسین';
                }
            }
        }
        else
        {
            $data['pt'] = '';
        }
        $data['url'] = $url;
        $data['isOpu'] = $isOpu;
        $data['isHospital'] = $isHospital;
        $data['isInspector'] = $isInspector;
        $data['isSection'] = $isSection;
        $data['isPresentation'] = $isPresentation;
        $data['isDoc'] = $isDoc;
        $data['isPatientStatus'] = $isPatientStatus;
        $data['page'] = $page;
        $data['url'] = $url;
        $data['class'] = $class;
        

        
        // give total records for page number
        // search tools  start
        if($this->input->get('searchTools'))
        {
            $url .= 'searchTools=true&';
            if($this->input->get('cbPatientStatus') > 0)
            {
                $tOtion = $this->searchTolOptionWithParent($this->input->get('cbPatientStatus'));
                if($tOtion)
                {
                    $top = '( ';
                    for($a = 0; $a < count($tOtion); $a++)
                    {
                        if($a == 0)
                        {
                            $top .= "mhr_patients.patientStatus  = " . $tOtion[$a]['id'] . " ";
                        }
                        else
                        {
                            $top .= "OR mhr_patients.patientStatus  = " . $tOtion[$a]['id'] . " ";
                        }
                    }
                    $top .= "OR mhr_patients.patientStatus  = " . $this->input->get('cbPatientStatus') . " )";
                    $this->db->where($top);
                }
                else
                {
                    $wheres['patients.patientStatus'] = $this->input->get('cbPatientStatus');
                }
                $url .= 'cbPatientStatus=' . $this->input->get('cbPatientStatus') . '&';
                $isPatientStatus = $this->input->get('cbPatientStatus');
            }
            if($this->input->get('inputPatientFilter') AND strlen($this->input->get('inputPatientFilter')) > 0)
            {
                $this->db->where("( mhr_patients.fullName  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter')). "%' 
                                    OR  mhr_patients.nationalCode  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter')) . "%' 
                                    OR  mhr_patients.fileNumber  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter')) . "%' 
                                    OR  mhr_patients.age  LIKE '" . htmlCoding($this->input->get('inputPatientFilter')) . "' 
                                    OR  mhr_patients.firstGCS  LIKE '" . htmlCoding($this->input->get('inputPatientFilter')) . "' 
                                    OR  mhr_patients.patientDetail  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter')) . "%' )");
                $url .= 'inputPatientFilter=' . $this->input->get('inputPatientFilter') . '&';
            }
            if($this->input->get('cbOpu') > 0)
            {
                if($this->userauthentication_model->is_admin())
                {
                    $wheres['pLog.opu'] = $this->input->get('cbOpu');
                    $url .= 'cbOpu=' . $this->input->get('cbOpu') . '&';
                    $isOpu = $this->input->get('cbOpu');
                }
            }
            if($this->input->get('cbHospital') > 0)
            {
                $wheres['pLog.hospital'] = $this->input->get('cbHospital');
                $url .= 'cbHospital=' . $this->input->get('cbHospital') . '&';
                $isHospital = $this->input->get('cbHospital');
            }
            if($this->input->get('cbInspector') > 0)
            {
                $wheres['pLog.inspector'] = $this->input->get('cbInspector');
                $url .= 'cbInspector=' . $this->input->get('cbInspector') . '&';
                $isInspector = $this->input->get('cbInspector');
            }
            if($this->input->get('cbSection') > 0)
            {
                $wheres['pLog.section'] = $this->input->get('cbSection');
                $url .= 'cbSection=' . $this->input->get('cbSection') . '&';
                $isSection = $this->input->get('cbSection');
            }
            if($this->input->get('cbInspectorType') > 0)
            {
                $wheres['patients.presentation'] = $this->input->get('cbInspectorType');
                $url .= 'cbInspectorType=' . $this->input->get('cbInspectorType') . '&';
                $isPresentation = $this->input->get('cbInspectorType');
            }
            if($this->input->get('cbDocDetail') > 0)
            {
                $wheres['patients.doc'] = $this->input->get('cbDocDetail');
                $url .= 'cbDocDetail=' . $this->input->get('cbDocDetail') . '&';
                $isDoc = $this->input->get('cbDocDetail');
            }
            if($this->input->get('cbOrder'))
            {
                $url .= 'cbOrder=' . $this->input->get('cbOrder') . '&';
                $orderType = $this->input->get('cbOrder');
                if($this->input->get('cbOrderBy'))
                {
                    $orderType .= ' ' . $this->input->get('cbOrderBy');
                    $url .= 'cbOrderBy=' . $this->input->get('cbOrderBy') . '&';
                }
                else
                {
                    $orderType .= ' DESC';
                }
            }
        }
        // search tools  end
        $this->db->select(array('patients.id', 'MAX(pLog.id) AS pLogId'));
        $this->db->from('patients');
        $this->db->join('doc AS docT' ,'docT.id = patients.doc');
        $this->db->join('tol_options AS tolOp' ,'tolOp.id = patients.patientStatus');
        //$this->db->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)');
        $this->db->join('patients_log AS pLog' ,'pLog.pId = patients.id');
        $this->db->join('hospitals AS hos' ,'hos.id = pLog.hospital');
        $this->db->join('opu' ,'opu.id = pLog.opu');
        $this->db->join('states' ,'states.id = pLog.city');
        $this->db->join('inspectors' ,'inspectors.id = pLog.inspector', 'left');
        $this->db->where($wheres);
        $this->db->order_by($orderType);
        $this->db->group_by('pLog.pId');
        $query = $this->db->get();
        $data['totalRecords'] = $query->num_rows();

        return $data;
    }
}