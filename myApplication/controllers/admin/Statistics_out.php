<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistics_out extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->userauthentication_model->check_user_logedin() OR !$this->userauthentication_model->is_admin())
        {
            $this->userauthentication_model->log_out();
            redirect(base_url() . 'userAuthentication/user_authentication');
            exit;
        }
        $this->load->model('adminPages/managePatient_model');
        $this->load->model('publicPages/managePatientQuery_model');
        $this->load->model('adminPages/manageOpu_model');
        $this->load->helper('pagination');
    }

    public function index()
    {
        $data['opu'] = $this->manageOpu_model->opu_name();
        $data['pt']['pt'] = $this->statistics_data();
        /*for($i = 0; $i < count($data['pt']); $i++)
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
        }*/

//        showArray($data['pt']['pt']);
        $this->load->view('adminPages/statistics_out', $data);
//        $this->load->view('templates/header', $this->header_model->header_data());
//        $this->load->view('templates/topMain', $this->header_model->login_name_info());
//        $this->load->view('templates/dataComponent', $this->header_model->data_component());
//        $this->load->view('adminPages/managePatient', $data);
//        $this->load->view('templates/footer', $data);
    }

    public function statistics_data()
    {
        $this->db->select(array(
            'patients.id',
            'patients.fullName',
            'patients.age',
            'patients.firstGCS',
            'patients.fileNumber',
            'patients.bodyType ',
            'patients.isUnKnown',
            'patients.docDetail',
            'patients.presentation',
            'patients.appRegisterTime',
            'patients.inspectorRegisterTime',
            'patients.hospitalizationTime',
            'patients.gcs3ByDrTime',
            'patients.brainDeathTime',
            'patients.cardiacDeathTime',
            'patients.organDonationTime',
            'patients.patientDetail',
            'patients.firstPatientStatus',
            'patients.tol',
            'patients.patientStatus',
            'patients.patientStatusDetail',
            'patients.patientDetail',
            'patients.doc',
            'patients.docDetail',
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
            'patients.na',
            'patients.k',
            'patients.bun',
            'patients.urea',
            'patients.cr',
            'patients.alt',
            'patients.ast',
            'patients.wbc',
            'patients.plt',
            'patients.hgb',
            'patients.bs',
            'patients.out',
            'patients.ca',
            'patients.t',
            'patients.b',
            'patients.p',
            'patients.pr',
            'patients.rr',
            'patients.fio2',
            'patients.o2sat',
            'patients.heart',
            'patients.liver',
            'patients.kidneyRight',
            'patients.kidneyLeft',
            'patients.lungRight',
            'patients.lungLeft',
            'patients.pancreas',
            'patients.tissue',
            'patients.bowel',
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
            'cityTab.name AS cityName',
            'stateTab.name AS stateName',
            'inspectors.name AS insName'
        ));
        $this->db->from('patients');

        $this->db->join('doc AS docT' ,'docT.id = patients.doc');
        $this->db->join('tol_options AS tolOp' ,'tolOp.id = patients.patientStatus');
        $this->db->join('hospitals AS hos' ,'hos.id = patients.hospital');
        $this->db->join('opu' ,'opu.id = patients.opu');
        $this->db->join('states AS cityTab' ,'cityTab.id = patients.city');
        $this->db->join('states AS stateTab' ,'stateTab.id = patients.state');
        $this->db->join('inspectors' ,'inspectors.id = patients.lastInspector', 'left');

        /* Demographic characteristics and level of consciousness */
        // name
        if ($this->input->post('txtName', TRUE))
        {
            $this->db->like('fullName', $this->input->post('txtName', TRUE), 'both');
        }

        // age
        if ($this->input->post('txtAge', TRUE))
        {
            $this->db->where('age', $this->input->post('txtAge', TRUE));
        }

        // body type
        if ($this->input->post('txtBodyType', TRUE))
        {
            $this->db->where('bodyType', $this->input->post('txtBodyType', TRUE));
        }

        // first gcs
        if ($this->input->post('txtFirstGCS', TRUE))
        {
            $this->db->where('firstGCS', $this->input->post('txtFirstGCS', TRUE));
        }

        // body type
        if ($this->input->post('txtSecondGCS', TRUE))
        {
            $this->db->where('secondGCS', $this->input->post('txtSecondGCS', TRUE));
        }

        // is unknown
        if ($this->input->post('txtIsUnknown', TRUE))
        {
            if ($this->input->post('txtIsUnknown', TRUE) == 1 || $this->input->post('txtIsUnknown', TRUE) == 0)
            {
                $this->db->where('secondGCS', $this->input->post('txtIsUnknown', TRUE));
            }
        }
        /* Demographic characteristics and level of consciousness */

        /* List type, the patient's condition, how to identify the cause of the disturbance of consciousness */
        // first type of list
        if ($this->input->post('txtTypeOfList1', TRUE) AND $this->input->post('txtTypeOfList1', TRUE) > 0)
        {
            $this->db->where('firstTol', $this->input->post('txtTypeOfList1', TRUE));
        }

        // second type of list
        if ($this->input->post('txtTypeOfList2', TRUE) AND $this->input->post('txtTypeOfList2', TRUE) > 0)
        {
            $this->db->where('tol', $this->input->post('txtTypeOfList2', TRUE));
        }

        // first patient status
        if ($this->input->post('txtPatientStatus1', TRUE) AND $this->input->post('txtPatientStatus1', TRUE) > 0)
        {
            $this->db->where('firstPatientStatus', $this->input->post('txtPatientStatus1', TRUE));
        }

        // second patient status
        if ($this->input->post('txtPatientStatus2', TRUE) AND $this->input->post('txtPatientStatus2', TRUE) > 0)
        {
            $this->db->where('patientStatus', $this->input->post('txtPatientStatus2', TRUE));
        }

        // DOC
        if ($this->input->post('txtDoc', TRUE) AND $this->input->post('txtDoc', TRUE) > 0)
        {
            $this->db->where('doc', $this->input->post('txtDoc', TRUE));
        }

        // presentation
        if ($this->input->post('txtPresentioan', TRUE) AND $this->input->post('txtPresentioan', TRUE) > 0)
        {
            $this->db->where('presentation', $this->input->post('txtPresentioan', TRUE));
        }
        /* List type, the patient's condition, how to identify the cause of the disturbance of consciousness */

        /* All procurement unit, province and city */
        // opu
        if ($this->input->post('txtOpu', TRUE) AND $this->input->post('txtOpu', TRUE) > 0)
        {
            $this->db->where('opu', $this->input->post('txtOpu', TRUE));
        }

        // hospital
        if ($this->input->post('txtHospital', TRUE) AND $this->input->post('txtHospital', TRUE) > 0)
        {
            $this->db->where('hospital', $this->input->post('txtHospital', TRUE));
        }

        // section
        if ($this->input->post('txtSection', TRUE) AND $this->input->post('txtSection', TRUE) > 0)
        {
            $this->db->where('section', $this->input->post('txtSection', TRUE));
        }

        // state
        if ($this->input->post('txtState', TRUE) AND $this->input->post('txtState', TRUE) > 0)
        {
            $this->db->where('state', $this->input->post('txtState', TRUE));
        }

        // city
        if ($this->input->post('txtCity', TRUE) AND $this->input->post('txtCity', TRUE) > 0)
        {
            $this->db->where('city', $this->input->post('txtCity', TRUE));
        }

        // first inspector
        if ($this->input->post('txtFirstInspector', TRUE) AND $this->input->post('txtFirstInspector', TRUE) > 0)
        {
            $this->db->where('firstInspector', $this->input->post('txtFirstInspector', TRUE));
        }

        // last inspector
        if ($this->input->post('txtSecondInspector', TRUE) AND $this->input->post('txtSecondInspector', TRUE) > 0)
        {
            $this->db->where('lastInspector', $this->input->post('txtSecondInspector', TRUE));
        }
        /* All procurement unit, province and city */

        /* reflexes */
        // breathing
        if ($this->input->post('txtBreathing', TRUE) AND $this->input->post('txtBreathing', TRUE) != '0')
        {
            $this->db->where('breathing', $this->input->post('txtBreathing', TRUE));
        }

        // cornea
        if ($this->input->post('txtCornea', TRUE) AND $this->input->post('txtCornea', TRUE) != '0')
        {
            $this->db->where('cornea', $this->input->post('txtCornea', TRUE));
        }

        // pupil
        if ($this->input->post('txtPupil', TRUE) AND $this->input->post('txtPupil', TRUE) != '0')
        {
            $this->db->where('pupil', $this->input->post('txtPupil', TRUE));
        }

        // face movement
        if ($this->input->post('txtFaceMovement', TRUE) AND $this->input->post('txtFaceMovement', TRUE) != '0')
        {
            $this->db->where('faceMovement', $this->input->post('txtFaceMovement', TRUE));
        }

        // doll's eye
        if ($this->input->post('txtDollEye', TRUE) AND $this->input->post('txtDollEye', TRUE) != '0')
        {
            $this->db->where('dollEye', $this->input->post('txtDollEye', TRUE));
        }

        // gag
        if ($this->input->post('txtGag', TRUE) AND $this->input->post('txtGag', TRUE) != '0')
        {
            $this->db->where('gag', $this->input->post('txtGag', TRUE));
        }

        // cough
        if ($this->input->post('txtCough', TRUE) AND $this->input->post('txtCough', TRUE) != '0')
        {
            $this->db->where('cough', $this->input->post('txtCough', TRUE));
        }

        // body movement
        if ($this->input->post('txtBodyMovement', TRUE) AND $this->input->post('txtBodyMovement', TRUE) != '0')
        {
            $this->db->where('bodyMovement', $this->input->post('txtBodyMovement', TRUE));
        }
        /* reflexes */

        /* Stability */
        // temp
        if ($this->input->post('txtVT', TRUE) AND $this->input->post('txtVT', TRUE) > 0)
        {
            if ($this->input->post('txtVTO', TRUE))
            {
                $this->db->where('t ' . $this->input->post('txtVTO', TRUE), $this->input->post('txtVT', TRUE));
            }
            else
            {
                $this->db->where('t', $this->input->post('txtVT', TRUE));
            }
        }

        // PR
        if ($this->input->post('txtVPr', TRUE) AND $this->input->post('txtVPr', TRUE) > 0)
        {
            if ($this->input->post('txtVPrO', TRUE))
            {
                $this->db->where('pr ' . $this->input->post('txtVPrO', TRUE), $this->input->post('txtVPr', TRUE));
            }
            else
            {
                $this->db->where('pr', $this->input->post('txtVPr', TRUE));
            }
        }

        // RR
        if ($this->input->post('txtVRr', TRUE) AND $this->input->post('txtVRr', TRUE) > 0)
        {
            if ($this->input->post('txtVRrO', TRUE))
            {
                $this->db->where('rr ' . $this->input->post('txtVRrO', TRUE), $this->input->post('txtVRr', TRUE));
            }
            else
            {
                $this->db->where('rr', $this->input->post('txtVRr', TRUE));
            }
        }

        // Out
        if ($this->input->post('txtVOut', TRUE) AND $this->input->post('txtVOut', TRUE) > 0)
        {
            if ($this->input->post('txtVOutO', TRUE))
            {
                $this->db->where('out ' . $this->input->post('txtVOutO', TRUE), $this->input->post('txtVOut', TRUE));
            }
            else
            {
                $this->db->where('out', $this->input->post('txtVOut', TRUE));
            }
        }

        // FIO2
        if ($this->input->post('txtVFio2', TRUE) AND $this->input->post('txtVFio2', TRUE) > 0)
        {
            if ($this->input->post('txtVFio2O', TRUE))
            {
                $this->db->where('fio2 ' . $this->input->post('txtVFio2O', TRUE), $this->input->post('txtVFio2', TRUE));
            }
            else
            {
                $this->db->where('fio2', $this->input->post('txtVFio2', TRUE));
            }
        }

        // O2Sat
        if ($this->input->post('txtVO2sat', TRUE) AND $this->input->post('txtVO2sat', TRUE) > 0)
        {
            if ($this->input->post('txtVO2satO', TRUE))
            {
                $this->db->where('o2sat ' . $this->input->post('txtVO2satO', TRUE), $this->input->post('txtVO2sat', TRUE));
            }
            else
            {
                $this->db->where('o2sat', $this->input->post('txtVO2sat', TRUE));
            }
        }

        // B.P b
        if ($this->input->post('txtVB', TRUE) AND $this->input->post('txtVB', TRUE) > 0)
        {
            if ($this->input->post('txtVBO', TRUE))
            {
                $this->db->where('b ' . $this->input->post('txtVBO', TRUE), $this->input->post('txtVB', TRUE));
            }
            else
            {
                $this->db->where('b', $this->input->post('txtVB', TRUE));
            }
        }

        // B.P p
        if ($this->input->post('txtVP', TRUE) AND $this->input->post('txtVP', TRUE) > 0)
        {
            if ($this->input->post('txtVPO', TRUE))
            {
                $this->db->where('p ' . $this->input->post('txtVPO', TRUE), $this->input->post('txtVP', TRUE));
            }
            else
            {
                $this->db->where('p', $this->input->post('txtVP', TRUE));
            }
        }

        // sedation
        if ($this->input->post('txtVSedation', TRUE) AND $this->input->post('txtVSedation', TRUE) != '0')
        {
            $this->db->where('sedation', $this->input->post('txtVSedation', TRUE));
        }
        /* Stability */

        /* tests */
        // Na
        if ($this->input->post('txtTNa', TRUE) AND $this->input->post('txtTNa', TRUE) > 0)
        {
            if ($this->input->post('txtTNaO', TRUE))
            {
                $this->db->where('na ' . $this->input->post('txtTNaO', TRUE), $this->input->post('txtTNa', TRUE));
            }
            else
            {
                $this->db->where('na', $this->input->post('txtTNa', TRUE));
            }
        }

        // K
        if ($this->input->post('txtTK', TRUE) AND $this->input->post('txtTK', TRUE) > 0)
        {
            if ($this->input->post('txtTKO', TRUE))
            {
                $this->db->where('k ' . $this->input->post('txtTKO', TRUE), $this->input->post('txtTK', TRUE));
            }
            else
            {
                $this->db->where('k', $this->input->post('txtTK', TRUE));
            }
        }

        // BUN
        if ($this->input->post('txtTBun', TRUE) AND $this->input->post('txtTBun', TRUE) > 0)
        {
            if ($this->input->post('txtTBunO', TRUE))
            {
                $this->db->where('bun ' . $this->input->post('txtTBunO', TRUE), $this->input->post('txtTBun', TRUE));
            }
            else
            {
                $this->db->where('bun', $this->input->post('txtTBun', TRUE));
            }
        }

        // urea
        if ($this->input->post('txtTUrea', TRUE) AND $this->input->post('txtTUrea', TRUE) > 0)
        {
            if ($this->input->post('txtTUreaO', TRUE))
            {
                $this->db->where('urea ' . $this->input->post('txtTUreaO', TRUE), $this->input->post('txtTUrea', TRUE));
            }
            else
            {
                $this->db->where('urea', $this->input->post('txtTUrea', TRUE));
            }
        }

        // ALT
        if ($this->input->post('txtTAlt', TRUE) AND $this->input->post('txtTAlt', TRUE) > 0)
        {
            if ($this->input->post('txtTAltO', TRUE))
            {
                $this->db->where('alt ' . $this->input->post('txtTAltO', TRUE), $this->input->post('txtTAlt', TRUE));
            }
            else
            {
                $this->db->where('alt', $this->input->post('txtTAlt', TRUE));
            }
        }

        // ast
        if ($this->input->post('txtTAst', TRUE) AND $this->input->post('txtTAst', TRUE) > 0)
        {
            if ($this->input->post('txtTAstO', TRUE))
            {
                $this->db->where('ast ' . $this->input->post('txtTAstO', TRUE), $this->input->post('txtTAst', TRUE));
            }
            else
            {
                $this->db->where('ast', $this->input->post('txtTAst', TRUE));
            }
        }

        // Hgb
        if ($this->input->post('txtTHgb', TRUE) AND $this->input->post('txtTHgb', TRUE) > 0)
        {
            if ($this->input->post('txtTHgbO', TRUE))
            {
                $this->db->where('hgb ' . $this->input->post('txtTHgbO', TRUE), $this->input->post('txtTHgb', TRUE));
            }
            else
            {
                $this->db->where('hgb', $this->input->post('txtTHgb', TRUE));
            }
        }

        // wbc
        if ($this->input->post('txtTWbc', TRUE) AND $this->input->post('txtTWbc', TRUE) > 0)
        {
            if ($this->input->post('txtTWbcO', TRUE))
            {
                $this->db->where('wbc ' . $this->input->post('txtTWbcO', TRUE), $this->input->post('txtTWbc', TRUE));
            }
            else
            {
                $this->db->where('wbc', $this->input->post('txtTWbc', TRUE));
            }
        }

        // plt
        if ($this->input->post('txtTPlt', TRUE) AND $this->input->post('txtTPlt', TRUE) > 0)
        {
            if ($this->input->post('txtTPltO', TRUE))
            {
                $this->db->where('plt ' . $this->input->post('txtTPltO', TRUE), $this->input->post('txtTPlt', TRUE));
            }
            else
            {
                $this->db->where('plt', $this->input->post('txtTPlt', TRUE));
            }
        }

        // bs
        if ($this->input->post('txtTBs', TRUE) AND $this->input->post('txtTBs', TRUE) > 0)
        {
            if ($this->input->post('txtTBsO', TRUE))
            {
                $this->db->where('bs ' . $this->input->post('txtTBsO', TRUE), $this->input->post('txtTBs', TRUE));
            }
            else
            {
                $this->db->where('bs', $this->input->post('txtTBs', TRUE));
            }
        }

        // cr
        if ($this->input->post('txtTCr', TRUE) AND $this->input->post('txtTCr', TRUE) > 0)
        {
            if ($this->input->post('txtTCrO', TRUE))
            {
                $this->db->where('cr ' . $this->input->post('txtTCrO', TRUE), $this->input->post('txtTCr', TRUE));
            }
            else
            {
                $this->db->where('cr', $this->input->post('txtTCr', TRUE));
            }
        }

        // ca
        if ($this->input->post('txtTCa', TRUE) AND $this->input->post('txtTCa', TRUE) > 0)
        {
            if ($this->input->post('txtTCaO', TRUE))
            {
                $this->db->where('ca ' . $this->input->post('txtTCaO', TRUE), $this->input->post('txtTCa', TRUE));
            }
            else
            {
                $this->db->where('ca', $this->input->post('txtTCa', TRUE));
            }
        }
        /* tests */

        /* dates */
        // app register time
        if ($this->input->post('txtRegisterTimeFromEn', TRUE))
        {
            $from = explode('/', $this->input->post('txtRegisterTimeFromEn', TRUE));
            $from = mktime(0, 0, 0, $from[1], $from[2], $from[0]);
            $this->db->where('appRegisterTime >', $from);
        }
        if ($this->input->post('txtRegisterTimeToEn', TRUE))
        {
            $to = explode('/', $this->input->post('txtRegisterTimeToEn', TRUE));
            $to = mktime(0, 0, 0, $to[1], $to[2], $to[0]);
            $this->db->where('appRegisterTime <', $to);
        }

        // inspector register time
        if ($this->input->post('txtInspectorRegisterTimeFromEn', TRUE))
        {
            $from = explode('/', $this->input->post('txtInspectorRegisterTimeFromEn', TRUE));
            $from = mktime(0, 0, 0, $from[1], $from[2], $from[0]);
            $this->db->where('inspectorRegisterTime >', $from);
        }
        if ($this->input->post('txtInspectorRegisterTimeToEn', TRUE))
        {
            $to = explode('/', $this->input->post('txtInspectorRegisterTimeToEn', TRUE));
            $to = mktime(0, 0, 0, $to[1], $to[2], $to[0]);
            $this->db->where('inspectorRegisterTime <', $to);
        }

        // hospitalization time
        if ($this->input->post('txtHospitalizationTimeFromEn', TRUE))
        {
            $from = explode('/', $this->input->post('txtHospitalizationTimeFromEn', TRUE));
            $from = mktime(0, 0, 0, $from[1], $from[2], $from[0]);
            $this->db->where('hospitalizationTime >', $from);
        }
        if ($this->input->post('txtHospitalizationTimeToEn', TRUE))
        {
            $to = explode('/', $this->input->post('txtHospitalizationTimeToEn', TRUE));
            $to = mktime(0, 0, 0, $to[1], $to[2], $to[0]);
            $this->db->where('hospitalizationTime <', $to);
        }

        // brain Death time
        if ($this->input->post('txtBrainDeathTimeFromEn', TRUE))
        {
            $from = explode('/', $this->input->post('txtBrainDeathTimeFromEn', TRUE));
            $from = mktime(0, 0, 0, $from[1], $from[2], $from[0]);
            $this->db->where('brainDeathTime >', $from);
        }
        if ($this->input->post('txtBrainDeathTimeToEn', TRUE))
        {
            $to = explode('/', $this->input->post('txtBrainDeathTimeToEn', TRUE));
            $to = mktime(0, 0, 0, $to[1], $to[2], $to[0]);
            $this->db->where('brainDeathTime <', $to);
        }

        // cardiac Death Time
        if ($this->input->post('txtCardiacDeathTimeFromEn', TRUE))
        {
            $from = explode('/', $this->input->post('txtCardiacDeathTimeFromEn', TRUE));
            $from = mktime(0, 0, 0, $from[1], $from[2], $from[0]);
            $this->db->where('cardiacDeathTime >', $from);
        }
        if ($this->input->post('txtCardiacDeathTimeToEn', TRUE))
        {
            $to = explode('/', $this->input->post('txtCardiacDeathTimeToEn', TRUE));
            $to = mktime(0, 0, 0, $to[1], $to[2], $to[0]);
            $this->db->where('cardiacDeathTime <', $to);
        }

        // organ Donation Time
        if ($this->input->post('txtOrganDonationTimeFromEn', TRUE))
        {
            $from = explode('/', $this->input->post('txtOrganDonationTimeFromEn', TRUE));
            $from = mktime(0, 0, 0, $from[1], $from[2], $from[0]);
            $this->db->where('organDonationTime >', $from);
        }
        if ($this->input->post('txtOrganDonationTimeToEn', TRUE))
        {
            $to = explode('/', $this->input->post('txtOrganDonationTimeToEn', TRUE));
            $to = mktime(0, 0, 0, $to[1], $to[2], $to[0]);
            $this->db->where('organDonationTime <', $to);
        }
        /* dates */

        $this->db->where('patients.status < ', 12);
//        $this->db->limit(1);
        $data = $this->db->get();
        if(!$data->num_rows())
        {
            return false;
        }
        else
        {
            $data = $data->result_array();
        }

        return $data;
//        $this->output->enable_profiler(TRUE);
    }
}