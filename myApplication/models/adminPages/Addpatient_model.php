<?php
    class AddPatient_model extends CI_Model {

        public function __construct()
        {

        }
        public function addNewPatient()
        {
            if($this->input->post('inputFileNumber', TRUE, TRUE))
            {
                $inputFileNumber = $this->input->post('inputFileNumber', TRUE, TRUE);
                $chisUnknown = $this->input->post('chisUnknown', TRUE, TRUE);
                $inputFullName = $this->input->post('inputFullName', TRUE, TRUE);
                $inputNationalCode = $this->input->post('inputNationalCode', TRUE, TRUE);
                $inputAge = $this->input->post('inputAge', TRUE, TRUE);
                $cbBodyType = $this->input->post('cbBodyType', TRUE, TRUE);
                $cbDoc = $this->input->post('cbDoc', TRUE, TRUE);
                $inputDocDetail = $this->input->post('inputDocDetail', TRUE, TRUE);
                $inputFirstGCS = $this->input->post('inputFirstGCS', TRUE, TRUE);
                $cbOpu = $this->input->post('cbOpu', TRUE, TRUE);
                $cbPresentioan = $this->input->post('cbPresentioan', TRUE, TRUE);
                $cbHospitals = $this->input->post('cbHospitals', TRUE, TRUE);
                $cbSection = $this->input->post('cbSection', TRUE, TRUE);
                $inputTypeOfSection = $this->input->post('inputTypeOfSection', TRUE, TRUE);
                $cbBreathing = $this->input->post('cbBreathing', TRUE, TRUE);
                $inputBreathingDetail = $this->input->post('inputBreathingDetail', TRUE, TRUE);
                $cbBodyMove = $this->input->post('cbBodyMove', TRUE, TRUE);
                $inputBodyMovementDetail = $this->input->post('inputBodyMovementDetail', TRUE, TRUE);
                $cbFaceMove = $this->input->post('cbFaceMove', TRUE, TRUE);
                $inputFaceMovementDetail = $this->input->post('inputFaceMovementDetail', TRUE, TRUE);
                $cbGag = $this->input->post('cbGag', TRUE, TRUE);
                $cbCough = $this->input->post('cbCough', TRUE, TRUE);
                $cbCornea = $this->input->post('cbCornea', TRUE, TRUE);
                $cbPupil = $this->input->post('cbPupil', TRUE, TRUE);
                $cbDoll = $this->input->post('cbDoll', TRUE, TRUE);
                $cbTol = $this->input->post('cbTol', TRUE, TRUE);
                $cbPatientStatus = $this->input->post('cbPatientStatus', TRUE, TRUE);
                $inputPatientStatusDetail = $this->input->post('inputPatientStatusDetail', TRUE, TRUE);
                $inputPatientDetail = $this->input->post('inputPatientDetail', TRUE, TRUE);
                $rdAddDate = $this->input->post('rdAddDate', TRUE, TRUE);
                $cbMin = $this->input->post('cbMin', TRUE, TRUE);
                $cbHour = $this->input->post('cbHour', TRUE, TRUE);
                $inputT = $this->input->post('inputT', TRUE, TRUE);
                $inputPR = $this->input->post('inputPR', TRUE, TRUE);
                $inputFIO2 = $this->input->post('inputFIO2', TRUE, TRUE);
                $inputOut = $this->input->post('inputOut', TRUE, TRUE);
                $inputBPb = $this->input->post('inputBPb', TRUE, TRUE);
                $inputBPp = $this->input->post('inputBPp', TRUE, TRUE);
                $inputRR = $this->input->post('inputRR', TRUE, TRUE);
                $inputO2SAT = $this->input->post('inputO2SAT', TRUE, TRUE);
                $cbSedation = $this->input->post('cbSedation2', TRUE, TRUE);
                $inputNa = $this->input->post('inputNa', TRUE, TRUE);
                $inputK = $this->input->post('inputK', TRUE, TRUE);
                $inputBUN = $this->input->post('inputBUN', TRUE, TRUE);
                $inputUrea = $this->input->post('inputUrea', TRUE, TRUE);
                $inputCr = $this->input->post('inputCr', TRUE, TRUE);
                $inputCa = $this->input->post('inputCa', TRUE, TRUE);
                $inputALT = $this->input->post('inputALT', TRUE, TRUE);
                $inputAST = $this->input->post('inputAST', TRUE, TRUE);
                $inputHb = $this->input->post('inputHb', TRUE, TRUE);
                $inputWBC = $this->input->post('inputWBC', TRUE, TRUE);
                $inputPLT = $this->input->post('inputPLT', TRUE, TRUE);
                $inputBs = $this->input->post('inputBs', TRUE, TRUE);
                $random = randnum(50);

                $inputCr = str_replace('/', '.', $inputCr);
                $inputCa = str_replace('/', '.', $inputCa);
                $inputHb = str_replace('/', '.', $inputHb);
                $inputK = str_replace('/', '.', $inputK);
                $inputT = str_replace('/', '.', $inputT);


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

                // check tests
                if($inputT >= 20 AND $inputT <= 50 AND
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
                    $inputCa >= 0 AND $inputCa <= 20)
                {
                    $tests = 1;
                }
                else
                {
                    $tests = 0;
                }

                // check have tests for GCS4
                if(strlen($inputT) > 0 || strlen($inputRR) > 0 || strlen($inputPR) > 0 || strlen($inputFIO2) > 0 || strlen($inputOut) > 0 ||
                    strlen($inputBPb) > 0 || strlen($inputBPp) > 0 || strlen($inputO2SAT) > 0 || strlen($inputNa) > 0 || strlen($inputK) > 0 ||
                    strlen($inputALT) > 0 || strlen($inputAST) > 0 || strlen($inputHb) > 0 || strlen($inputWBC) > 0 || strlen($inputPLT) > 0 ||
                    strlen($inputBs) > 0 || strlen($inputCr) > 0 || strlen($inputCa) > 0 || strlen($inputBUN) > 0 || strlen($inputUrea) > 0)
                {
                    $haveTests = 1;
                }
                else
                {
                    $haveTests = 0;
                }

                // check sedation
                $cbSedation = $cbSedation? 'Yes' : 'No';

                // validate data
                if(strlen($inputFileNumber) > 0 AND $cbDoc > 0 AND $inputFirstGCS >= 3 AND $inputFirstGCS <= 15 AND
                    $cbOpu > 0 AND $cbPresentioan > 0 AND $cbHospitals > 0 AND $cbSection > 0 AND $cbTol > 0 AND
                    $cbPatientStatus > 0 AND (strlen($inputFullName) > 5 OR $inputFullName == '-') AND (strlen($inputAge) > 0 OR $inputAge == '-'))
                {

                    if($cbTol == 1 || $cbTol == 2 || $cbTol == 4)
                    {
                        if(! $tests)
                        {
                            $pD['patientInsertStatus'] = 7; // tests not valid
                            return $pD;
                            exit;
                        }
                        else
                        {
                            $insert = 1;
                        }
                    }
                    else
                    {
                        if($haveTests)
                        {
                            if(! $tests)
                            {
                                $insert = 0;
                            }
                            else
                            {
                                $insert = 1;
                            }
                        }
                        else
                        {
                            $insert = 1;
                        }
                    }

                    if($rdAddDate == 'toDay')
                    {
                        $insTime = mktime($cbHour, $cbMin, 0, date('m', time()), date('d', time()), date('Y', time()));
                    }
                    elseif($rdAddDate == 'lastDay')
                    {
                        $insTime = mktime($cbHour, $cbMin, 0, date('m', strtotime('-1 days')), date('d', strtotime('-1 days')), date('Y', strtotime('-1 days')));
                    }


                    if($insert)
                    {
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

                        $session = $this->session->userdata('user');
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
                            'firstTol' => $cbTol,
                            'patientStatus' => $cbPatientStatus,
                            'firstPatientStatus' => $cbPatientStatus,
                            'patientStatusDetail' => htmlCoding($inputPatientStatusDetail),
                            'patientDetail' => htmlCoding($inputPatientDetail),
                            'presentation' => $cbPresentioan,
                            'appRegisterTime' => time(),
                            'inspectorRegisterTime' => $insTime,
                            'status' => 1,
                            'isArchive' => 0,
                            'res6' => $random,
                            'breathing' => $cbBreathing,
                            'bodyMovement' => $cbBodyMove,
                            'faceMovement' => $cbFaceMove,
                            'gag' => $cbGag,
                            'cough' => $cbCough,
                            'cornea' => $cbCornea,
                            'pupil' => $cbPupil,
                            'dollEye' =>$cbDoll,
                            'secondGCS' => '-',
                            'sedation' => $cbSedation,
                            'state' => $hr['state'],
                            'city' => $hr['city'],
                            'opu' => $cbOpu,
                            'firstInspector' => $ins,
                            'lastInspector' => $ins,
                            'hospital' => $cbHospitals,
                            'section' => $cbSection,
                            'typeOfSection' => $inputTypeOfSection,
                            'lastUpdate' => time(),
                            't' => $inputT,
                            'b' => $inputBPb,
                            'p' => $inputBPp,
                            'pr' => $inputPR,
                            'rr' => $inputRR,
                            'fio2' => $inputFIO2,
                            'o2sat' => $inputO2SAT,
                            'out' => $inputOut,
                            'na' => $inputNa,
                            'k' => $inputK,
                            'bun' => $inputBUN,
                            'urea' => $inputUrea,
                            'cr' => $inputCr,
                            'ast' => $inputAST,
                            'alt' => $inputALT,
                            'wbc' => $inputWBC,
                            'plt' => $inputPLT,
                            'hgb' => $inputHb,
                            'bs' =>$inputBs,
                            'ca' => $inputCa

                        );
                        $this->db->insert('patients', $data);

                        if($this->db->affected_rows() > 0)
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
                                'secondGCS' => '-',
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
                                'res1' => $opuid,
                                'tol' => $cbTol,
                                'patientStatus' => $cbPatientStatus,
                                'patientStatusDetail' => htmlCoding($inputPatientStatusDetail)
                            );
                            $this->db->insert('patients_log', $data);
                            if($this->db->affected_rows() > 0)
                            {
                                if($tests AND $haveTests)
                                {
                                    // insert tests
                                    $insertData = array(
                                        'pId' => $id,
                                        'status' => 1,
                                        't' => $inputT,
                                        'b' => $inputBPb,
                                        'p' => $inputBPp,
                                        'pr' => $inputPR,
                                        'rr' => $inputRR,
                                        'fio2' => $inputFIO2,
                                        'o2sat' => $inputO2SAT,
                                        'sedation' => $cbSedation,
                                        'out' => $inputOut,
                                        'na' => $inputNa,
                                        'k' => $inputK,
                                        'bun' => $inputBUN,
                                        'urea' => $inputUrea,
                                        'cr' => $inputCr,
                                        'ast' => $inputAST,
                                        'alt' => $inputALT,
                                        'wbc' => $inputWBC,
                                        'plt' => $inputPLT,
                                        'hb' => $inputHb,
                                        'bs' =>$inputBs,
                                        'ca' => $inputCa
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
                        $pD['patientInsertStatus'] = 8; // insert not allowed
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
}