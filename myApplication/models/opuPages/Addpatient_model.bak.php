<?php
    class AddPatient_model extends CI_Model {

        public function __construct()
        {

        }
        public function addNewPatient()
        {
            $session = $this->session->userdata('user');
            if($this->input->post('inputFileNumber'))
            {
                $inputFileNumber = $this->input->post('inputFileNumber');
                $chisUnknown = $this->input->post('chisUnknown');
                $inputFullName = $this->input->post('inputFullName');
                $inputNationalCode = $this->input->post('inputNationalCode');
                $inputAge = $this->input->post('inputAge');
                $cbBodyType = $this->input->post('cbBodyType');
                $cbDoc = $this->input->post('cbDoc');
                $inputDocDetail = $this->input->post('inputDocDetail');
                $inputFirstGCS = $this->input->post('inputFirstGCS');
                $cbOpu = $session['uid'];
                $cbPresentioan = $this->input->post('cbPresentioan');
                $cbHospitals = $this->input->post('cbHospitals');
                $cbSection = $this->input->post('cbSection');
                $inputTypeOfSection = $this->input->post('inputTypeOfSection');
                $cbBreathing = $this->input->post('cbBreathing');
                $inputBreathingDetail = $this->input->post('inputBreathingDetail');
                $cbSedation = $this->input->post('cbSedation');
                $cbBodyMove = $this->input->post('cbBodyMove');
                $inputBodyMovementDetail = $this->input->post('inputBodyMovementDetail');
                $cbFaceMove = $this->input->post('cbFaceMove');
                $inputFaceMovementDetail = $this->input->post('inputFaceMovementDetail');
                $cbGag = $this->input->post('cbGag');
                $cbCough = $this->input->post('cbCough');
                $cbCornea = $this->input->post('cbCornea');
                $cbPupil = $this->input->post('cbPupil');
                $cbDoll = $this->input->post('cbDoll');
                $cbTol = $this->input->post('cbTol');
                $cbPatientStatus = $this->input->post('cbPatientStatus');
                $inputPatientStatusDetail = $this->input->post('inputPatientStatusDetail');
                $inputPatientDetail = $this->input->post('inputPatientDetail');
                $rdAddDate = $this->input->post('rdAddDate');
                $cbMin = $this->input->post('cbMin');
                $cbHour = $this->input->post('cbHour');
                $inputT = $this->input->post('inputT');
                $inputPR = $this->input->post('inputPR');
                $inputFIO2 = $this->input->post('inputFIO2');
                $inputOut = $this->input->post('inputOut');
                $inputBP = $this->input->post('inputBP');
                $inputRR = $this->input->post('inputRR');
                $inputO2SAT = $this->input->post('inputO2SAT');
                $cbSedation2 = $this->input->post('cbSedation2');
                $inputNa = $this->input->post('inputNa');
                $inputK = $this->input->post('inputK');
                $inputBUN = $this->input->post('inputBUN');
                $inputCr = $this->input->post('inputCr');
                $inputALT = $this->input->post('inputALT');
                $inputAST = $this->input->post('inputAST');
                $inputHb = $this->input->post('inputHb');
                $inputWBC = $this->input->post('inputWBC');
                $inputPLT = $this->input->post('inputPLT');
                $inputBs = $this->input->post('inputBs');
                $random = randnum(50);


                if($chisUnknown)
                {
                    $inputFullName = 'ناشناس';
                    $inputNationalCode = '-';
                    $inputAge = '-';
                    $chisUnknown = 1;
                }
                else
                {
                    // search for duplicate patient
                    $this->db->select('id')
                    ->from('patients')
                    ->like('fileNumber', htmlCoding($inputFileNumber), 'both')
                    ->like('fullName', htmlCoding($inputFullName), 'both')
                    ->like('age', htmlCoding($inputAge), 'both')
                    ->where(array('status' => 1));
                    $query = $this->db->get();
                    $query = $query->row_array();
                    if($query AND is_array($query) AND count($query) > 0)
                    {
                        $pD['patientInsertStatus'] = 6; // patient duplicated
                        return $pD;
                        exit;
                    }
                    $chisUnknown = 0;
                }

                if(strlen($inputFileNumber) > 0 AND $cbDoc > 0 AND $inputFirstGCS > 0 AND $cbOpu > 0 AND $cbPresentioan > 0 AND $cbHospitals > 0 AND $cbSection > 0 AND $cbTol > 0 AND $cbPatientStatus > 0 AND (strlen($inputFullName) > 5 OR $inputFullName == '-') AND (strlen($inputAge) > 0 OR $inputAge == '-'))
                {
                    /* required con and test insert 
                    if($cbTol == 1)
                    {
                    if(strlen($inputT) > 0 AND strlen($inputPR) > 0 AND strlen($inputFIO2) > 0 AND strlen($inputOut) > 0 AND strlen($inputBP) > 0 AND strlen($inputRR) > 0 AND strlen($inputO2SAT) > 0 AND strlen($inputNa) > 0 AND strlen($inputK) > 0 AND strlen($inputBUN) > 0 AND strlen($inputCr) > 0 AND strlen($inputALT) > 0 AND strlen($inputAST) > 0 AND strlen($inputHb) > 0 AND strlen($inputWBC) > 0 AND strlen($inputPLT) > 0 AND strlen($inputBs) > 0)
                    {
                    $cbSedation = $cbSedation2 ? 'Yes' : 'No';
                    }
                    else
                    {
                    return $pD['patientInsertStatus'] = 4; // data not valid
                    exit;
                    }
                    }
                    */

                    if($cbTol == 1)
                    {
                        if(strlen($inputT) > 0 OR strlen($inputPR) > 0 OR strlen($inputFIO2) > 0 OR strlen($inputOut) > 0 OR strlen($inputBP) > 0 OR strlen($inputRR) > 0 OR strlen($inputO2SAT) > 0)
                        {
                            $cbSedation = $cbSedation2 ? 'Yes' : 'No';
                            $isCon = TRUE;
                        }
                        else
                        {
                            $isCon = FALSE;
                            $cbSedation = $cbSedation ? 'Yes' : 'No';
                        }
                        if(strlen($inputNa) > 0 OR strlen($inputK) > 0 OR strlen($inputBUN) > 0 OR strlen($inputCr) > 0 OR strlen($inputALT) > 0 OR strlen($inputAST) > 0 OR strlen($inputHb) > 0 OR strlen($inputWBC) > 0 OR strlen($inputPLT) > 0 OR strlen($inputBs) > 0)
                        {
                            $isTest = TRUE;
                        }
                        else
                        {
                            $isTest = FALSE;
                        }
                    }
                    else
                    {
                        $cbSedation = $cbSedation ? 'Yes' : 'No';
                    }

                    if($rdAddDate == 'toDay')
                    {
                        $insTime = mktime($cbHour, $cbMin, 0, date('m', time()), date('d', time()), date('Y', time()));
                    }
                    elseif($rdAddDate == 'lastDay')
                    {
                        $insTime = mktime($cbHour, $cbMin, 0, date('m', strtotime('-1 days')), date('d', strtotime('-1 days')), date('Y', strtotime('-1 days')));
                    }
                    $data = array(
                        'fileNumber' => htmlCoding($inputFileNumber),
                        'fullName' => htmlCoding($inputFullName),
                        'age' => htmlCoding($inputAge),
                        'bodyType' => $cbBodyType,
                        'nationalCode' => htmlCoding($inputNationalCode),
                        'firstGCS' => htmlCoding($inputFirstGCS),
                        'isUnknown' => $chisUnknown,
                        'doc' => $cbDoc,
                        'docDetail' => htmlCoding($inputDocDetail),
                        'tol' => $cbTol,
                        'patientStatus' => $cbPatientStatus,
                        'patientStatusDetail' => htmlCoding($inputPatientStatusDetail),
                        'patientDetail' => htmlCoding($inputPatientDetail),
                        'presentation' => $cbPresentioan,
                        'appRegisterTime' => time(),
                        'inspectorRegisterTime' => $insTime,
                        'status' => 1,
                        'isArchive' => 0,
                        'res6' => $random
                    );
                    $this->db->insert('patients', $data);
                    if($this->db->affected_rows() == 1)
                    {
                        $this->db->select('id')
                        ->from('patients')
                        ->where(array('res6' => $random));
                        $query = $this->db->get();
                        $query = $query->row_array();
                        $id = $query['id'];

                        $data = array('res6' => NULL);
                        $this->db->where('id', $id);
                        $this->db->update('patients', $data);

                        $this->db->select('*')
                        ->from('hospitals')
                        ->where(array('status' => 1, 'id' => $cbHospitals, 'opuId' => $cbOpu));
                        $query = $this->db->get();
                        $hr = $query->row_array();
                        if(!$hr)
                        {
                            return false;
                            exit;
                        }

                        if($this->userauthentication_model->is_admin())
                        {
                            $ins = 0;
                            $opuid = NULL;
                        }
                        elseif($this->userauthentication_model->is_opu())
                        {
                            $ins = -1;
                            $opuid = $session['uid'];
                        }
                        elseif($this->userauthentication_model->is_inspector())
                        {
                            $ins = $session['uid'];
                            $opuid = NULL;
                        }

                        $data = array(
                            'pId' => $id,
                            'status' => 1,
                            'breathing' => $cbBreathing,
                            'breathingDetail' => htmlCoding($inputBreathingDetail),
                            'bodyMovement' => $cbBodyMove,
                            'bodyMovementDetail' => htmlCoding($inputBodyMovementDetail),
                            'faceMovement' => $cbFaceMove,
                            'faceMovementDetail' => htmlCoding($inputFaceMovementDetail),
                            'gag' => $cbGag,
                            'cough' => $cbCough,
                            'cornea' => $cbCornea,
                            'pupil' => $cbPupil,
                            'dollEye' => $cbDoll,
                            'sedation' => $cbSedation,
                            'state' => $hr['state'],
                            'city' => $hr['city'],
                            'opu' => $cbOpu,
                            'inspector' => $ins,
                            'hospital' => $cbHospitals,
                            'section' => $cbSection,
                            'typeOfSection' => $inputTypeOfSection,
                            'lastUpdateTime' => time(),
                            'isTransfer' => 0,
                            'res1' => $opuid
                        );
                        $this->db->insert('patients_log', $data);
                        if($this->db->affected_rows() == 1)
                        {
                            if($isCon)
                            {
                                // insert condition
                                $insertData = array(
                                    'pId' => $id,
                                    'status' => 1,
                                    't' => $inputT,
                                    'bp' => $inputBP,
                                    'pr' => $inputPR,
                                    'rr' => $inputRR,
                                    'fio2' => $inputFIO2,
                                    'o2sat' => $inputO2SAT,
                                    'sedation' => $cbSedation,
                                    'out' => $inputOut
                                );
                                $this->db->insert('condition', $insertData);
                            }

                            if($isTest)
                            {
                                // insert test
                                $insertData = array(
                                    'pId' => $id,
                                    'status' => 1,
                                    'na' => $inputNa,
                                    'k' => $inputK,
                                    'bun' => $inputBUN,
                                    'cr' => $inputCr,
                                    'alt' => $inputALT,
                                    'ast' => $inputAST,
                                    'wbc' => $inputWBC,
                                    'plt' => $inputPLT,
                                    'hb' => $inputHb,
                                    'bs' => $inputBs,
                                    'out' => $inputOut
                                );
                                $this->db->insert('tests', $insertData);
                            }

                            $pD['patientInsertStatus'] = 1; // patient and patient log insert successful
                        }
                        else
                        {
                            $pD['patientInsertStatus'] = 2; // patient log not inserted
                        }

                    }
                    else
                    {
                        $pD['patientInsertStatus'] = 3; // patient not inserted
                    }
                }
                else
                {
                    $pD['patientInsertStatus'] = 4; // data not valid
                }
            }
            else
            {
                $pD['patientInsertStatus'] = 5; // data not posted
            }
            return $pD;    
        }

        // load hospital for one opu
        function load_hospital_with_opu($opuId)
        {
            $where = array('status' => 1, 'opuId' => $opuId);
            $this->db->select(array('id', 'name'));
            $this->db->from('hospitals');
            $this->db->where($where);
            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $data = $query->result_array();
            return $data;
        }
}