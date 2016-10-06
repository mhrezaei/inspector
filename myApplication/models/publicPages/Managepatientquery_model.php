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
        $pageNumber = $this->input->get('page', TRUE, TRUE);
        if($pageNumber AND $pageNumber > 0)
        {
            $row = ($pageNumber * $num) - $num;
            $page = $pageNumber;
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
        $orderType = 'lastUpdateTime DESC';
        $wheres = $where;

        // opu id set
        if(isset($wheres['opu']) AND is_numeric($wheres['opu']) AND $wheres['opu'] > 0)
        {
            $isOpu = $wheres['opu'];
        }
        // opu id set

        // search tools  start
        if($this->input->get('searchTools', TRUE, TRUE))
        {
            $url .= 'searchTools=true&';
            if($this->input->get('cbPatientStatus', TRUE, TRUE) > 0)
            {
                $tOtion = $this->searchTolOptionWithParent($this->input->get('cbPatientStatus', TRUE, TRUE));
                if($tOtion)
                {
                    $top = '( ';
                    for($a = 0; $a < count($tOtion); $a++)
                    {
                        if($a == 0)
                        {
                            $top .= "patientStatus  = " . $tOtion[$a]['id'] . " ";
                        }
                        else
                        {
                            $top .= "OR patientStatus  = " . $tOtion[$a]['id'] . " ";
                        }
                    }
                    $top .= "OR patientStatus  = " . $this->input->get('cbPatientStatus', TRUE, TRUE) . " )";
                    $this->db->where($top);
                }
                else
                {
                    $wheres['patientStatus'] = $this->input->get('cbPatientStatus', TRUE, TRUE);
                }
                $url .= 'cbPatientStatus=' . $this->input->get('cbPatientStatus', TRUE, TRUE) . '&';
                $isPatientStatus = $this->input->get('cbPatientStatus', TRUE, TRUE);
            }
            if($this->input->get('inputPatientFilter', TRUE, TRUE) AND strlen($this->input->get('inputPatientFilter', TRUE, TRUE)) > 0)
            {
                $this->db->where("( fullName  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)). "%'
                                    OR  `mhr_patients`.`nationalCode`  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)) . "%'
                                    OR  `mhr_patients`.`fileNumber`  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)) . "%'
                                    OR  `mhr_patients`.`age`  LIKE '" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)) . "'
                                    OR  `mhr_patients`.`firstGCS`  LIKE '" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)) . "'
                                    OR  `mhr_patients`.`patientDetail`  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)) . "%' )");
                $url .= 'inputPatientFilter=' . $this->input->get('inputPatientFilter', TRUE, TRUE) . '&';
            }
            if($this->input->get('cbOpu', TRUE, TRUE) > 0)
            {
                if($this->userauthentication_model->is_admin())
                {
                    $wheres['opu'] = $this->input->get('cbOpu', TRUE, TRUE);
                    $url .= 'cbOpu=' . $this->input->get('cbOpu', TRUE, TRUE) . '&';
                    $isOpu = $this->input->get('cbOpu', TRUE, TRUE);
                }
            }
            if($this->input->get('cbHospital', TRUE, TRUE) > 0)
            {
                $wheres['hospital'] = $this->input->get('cbHospital', TRUE, TRUE);
                $url .= 'cbHospital=' . $this->input->get('cbHospital', TRUE, TRUE) . '&';
                $isHospital = $this->input->get('cbHospital', TRUE, TRUE);
            }
            if($this->input->get('cbInspector', TRUE, TRUE) > 0)
            {
                $wheres['lastInspector'] = $this->input->get('cbInspector', TRUE, TRUE);
                $url .= 'cbInspector=' . $this->input->get('cbInspector', TRUE, TRUE) . '&';
                $isInspector = $this->input->get('cbInspector', TRUE, TRUE);
            }
            if($this->input->get('cbSection', TRUE, TRUE) > 0)
            {
                $wheres['section'] = $this->input->get('cbSection', TRUE, TRUE);
                $url .= 'cbSection=' . $this->input->get('cbSection', TRUE, TRUE) . '&';
                $isSection = $this->input->get('cbSection', TRUE, TRUE);
            }
            if($this->input->get('cbInspectorType', TRUE, TRUE) > 0)
            {
                $wheres['presentation'] = $this->input->get('cbInspectorType', TRUE, TRUE);
                $url .= 'cbInspectorType=' . $this->input->get('cbInspectorType', TRUE, TRUE) . '&';
                $isPresentation = $this->input->get('cbInspectorType', TRUE, TRUE);
            }
            if($this->input->get('cbDocDetail', TRUE, TRUE) > 0)
            {
                $wheres['doc'] = $this->input->get('cbDocDetail', TRUE, TRUE);
                $url .= 'cbDocDetail=' . $this->input->get('cbDocDetail', TRUE, TRUE) . '&';
                $isDoc = $this->input->get('cbDocDetail', TRUE, TRUE);
            }
            if($this->input->get('cbOrder', TRUE, TRUE))
            {
                $url .= 'cbOrder=' . $this->input->get('cbOrder', TRUE, TRUE) . '&';
                $orderType = $this->input->get('cbOrder', TRUE, TRUE);
                if($this->input->get('cbOrderBy', TRUE, TRUE))
                {
                    $orderType .= ' ' . $this->input->get('cbOrderBy', TRUE, TRUE);
                    $url .= 'cbOrderBy=' . $this->input->get('cbOrderBy', TRUE, TRUE) . '&';
                }
                else
                {
                    $orderType .= ' DESC';
                }
            }
        }
        // search tools  end

        // start query
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
                            'patients.breathing',
                            'patients.bodyMovement',
                            'patients.faceMovement',
                            'patients.gag',
                            'patients.cough',
                            'patients.cornea',
                            'patients.pupil',
                            'patients.dollEye',
                            'patients.secondGCS',
                            'patients.sedation',
                            'patients.lastInspector',
                            'patients.section',
                            'patients.typeOfSection',
                            'patients.lastUpdate AS lastUpdateTime',
                            'docT.text AS docText',
                            'tolOp.name AS tolOpName', 
                            'tolOp.color AS tolOpColor', 
                            'tolOp.res1 AS tolOpTextColor',
                            'hos.name AS hosName', 
                            'opu.name AS opuName', 
                            'opu.id AS opuId', 
                            'states.name AS cityName',
                            'inspectors.name AS insName'
                            ));
        $this->db->from('patients');
    
        $this->db->join('doc AS docT' ,'docT.id = patients.doc');
        $this->db->join('tol_options AS tolOp' ,'tolOp.id = patients.patientStatus');
        $this->db->join('hospitals AS hos' ,'hos.id = patients.hospital');
        $this->db->join('opu' ,'opu.id = patients.opu');
        $this->db->join('states' ,'states.id = patients.city');
        $this->db->join('inspectors' ,'inspectors.id = patients.lastInspector', 'left');
        
        $this->db->where($wheres);
        $this->db->order_by($orderType);
        $this->db->limit($num,$row);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            $data['pt'] = $query->result_array();
            for($i = 0; $i < count($data['pt']); $i++)
            {
                $data['pt'][$i]['inspector'] = $data['pt'][$i]['lastInspector'];
                // load opu name as inspector ROLE
                if($data['pt'][$i]['inspector'] > 0)
                {
                    // noting
                }
                elseif($data['pt'][$i]['inspector'] == -1)
                {
                    $data['pt'][$i]['insName'] = $data['pt'][$i]['opuName'];
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
        if($this->input->get('searchTools', TRUE, TRUE))
        {
            $url .= 'searchTools=true&';
            if($this->input->get('cbPatientStatus', TRUE, TRUE) > 0)
            {
                $tOtion = $this->searchTolOptionWithParent($this->input->get('cbPatientStatus', TRUE, TRUE));
                if($tOtion)
                {
                    $top = '( ';
                    for($a = 0; $a < count($tOtion); $a++)
                    {
                        if($a == 0)
                        {
                            $top .= "patientStatus  = " . $tOtion[$a]['id'] . " ";
                        }
                        else
                        {
                            $top .= "OR patientStatus  = " . $tOtion[$a]['id'] . " ";
                        }
                    }
                    $top .= "OR patientStatus  = " . $this->input->get('cbPatientStatus', TRUE, TRUE) . " )";
                    $this->db->where($top);
                }
                else
                {
                    $wheres['patientStatus'] = $this->input->get('cbPatientStatus', TRUE, TRUE);
                }
                $url .= 'cbPatientStatus=' . $this->input->get('cbPatientStatus', TRUE, TRUE) . '&';
                $isPatientStatus = $this->input->get('cbPatientStatus', TRUE, TRUE);
            }
            if($this->input->get('inputPatientFilter', TRUE, TRUE) AND strlen($this->input->get('inputPatientFilter', TRUE, TRUE)) > 0)
            {
                $this->db->where("( fullName  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)). "%'
                                    OR  `mhr_patients`.`nationalCode`  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)) . "%'
                                    OR  `mhr_patients`.`fileNumber`  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)) . "%'
                                    OR  `mhr_patients`.`age`  LIKE '" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)) . "'
                                    OR  `mhr_patients`.`firstGCS`  LIKE '" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)) . "'
                                    OR  `mhr_patients`.`patientDetail`  LIKE '%" . htmlCoding($this->input->get('inputPatientFilter', TRUE, TRUE)) . "%' )");
                $url .= 'inputPatientFilter=' . $this->input->get('inputPatientFilter', TRUE, TRUE) . '&';
            }
            if($this->input->get('cbOpu', TRUE, TRUE) > 0)
            {
                if($this->userauthentication_model->is_admin())
                {
                    $wheres['opu'] = $this->input->get('cbOpu', TRUE, TRUE);
                    $url .= 'cbOpu=' . $this->input->get('cbOpu', TRUE, TRUE) . '&';
                    $isOpu = $this->input->get('cbOpu', TRUE, TRUE);
                }
            }
            if($this->input->get('cbHospital', TRUE, TRUE) > 0)
            {
                $wheres['hospital'] = $this->input->get('cbHospital', TRUE, TRUE);
                $url .= 'cbHospital=' . $this->input->get('cbHospital', TRUE, TRUE) . '&';
                $isHospital = $this->input->get('cbHospital', TRUE, TRUE);
            }
            if($this->input->get('cbInspector', TRUE, TRUE) > 0)
            {
                $wheres['lastInspector'] = $this->input->get('cbInspector', TRUE, TRUE);
                $url .= 'cbInspector=' . $this->input->get('cbInspector', TRUE, TRUE) . '&';
                $isInspector = $this->input->get('cbInspector', TRUE, TRUE);
            }
            if($this->input->get('cbSection', TRUE, TRUE) > 0)
            {
                $wheres['section'] = $this->input->get('cbSection', TRUE, TRUE);
                $url .= 'cbSection=' . $this->input->get('cbSection', TRUE, TRUE) . '&';
                $isSection = $this->input->get('cbSection', TRUE, TRUE);
            }
            if($this->input->get('cbInspectorType', TRUE, TRUE) > 0)
            {
                $wheres['presentation'] = $this->input->get('cbInspectorType', TRUE, TRUE);
                $url .= 'cbInspectorType=' . $this->input->get('cbInspectorType', TRUE, TRUE) . '&';
                $isPresentation = $this->input->get('cbInspectorType', TRUE, TRUE);
            }
            if($this->input->get('cbDocDetail', TRUE, TRUE) > 0)
            {
                $wheres['doc'] = $this->input->get('cbDocDetail', TRUE, TRUE);
                $url .= 'cbDocDetail=' . $this->input->get('cbDocDetail', TRUE, TRUE) . '&';
                $isDoc = $this->input->get('cbDocDetail', TRUE, TRUE);
            }
            if($this->input->get('cbOrder', TRUE, TRUE))
            {
                $url .= 'cbOrder=' . $this->input->get('cbOrder', TRUE, TRUE) . '&';
                $orderType = $this->input->get('cbOrder', TRUE, TRUE);
                if($this->input->get('cbOrderBy', TRUE, TRUE))
                {
                    $orderType .= ' ' . $this->input->get('cbOrderBy', TRUE, TRUE);
                    $url .= 'cbOrderBy=' . $this->input->get('cbOrderBy', TRUE, TRUE) . '&';
                }
                else
                {
                    $orderType .= ' DESC';
                }
            }
        }
        // search tools  end


        $this->db->select('COUNT(id)');
        $this->db->from('patients');

        $this->db->where($wheres);

        $query = $this->db->get();
        $data['totalRecords'] = $query->row_array();
        $data['totalRecords'] = $data['totalRecords']['COUNT(id)'];

        return $data;
    }
}