<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_conf extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->userauthentication_model->check_user_logedin())
        {
            redirect(base_url());
            exit;
        }
        $this->load->model('ajax/ajax_model');
    }
    
    public function index()
    {
        // index
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
    }
    
    public function edit_state()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin())
        {
            if($this->input->post('cityName') && strlen($this->input->post('cityName')) > 1 && $this->input->post('cityId') && is_numeric($this->input->post('cityId')))
            {
                $this->ajax_model->edit_state_data();
                echo 1;
            }
            else
            {
                echo 2;
            }
        }
    }
    
    // load state and city
    public function load_states()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        $data = $this->ajax_model->load_state();
        if($this->input->post('isSelected'))
        {
            $selected = ' selected="selected" ';
        }
        else
        {
            $selected = '';
        }
        $op = '<option value="0">انتخاب کنید...</option>';
        if($data AND is_array($data) AND count($data) > 0)
        {
            for($i = 0; $i < count($data); $i++)
            {
                if($this->input->post('isSelected') == $data[$i]['id'])
                {
                    $op .= '<option value="' . $data[$i]['id'] . '"' . $selected . '>' . $data[$i]['name'] . '</option>';
                }
                else
                {
                    $op .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
        }
        
        echo $op;
    }
    
    // load opu
    public function load_opu()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        $data = $this->ajax_model->load_opu();
        if($this->input->post('isSelected'))
        {
            $selected = ' selected="selected" ';
        }
        else
        {
            $selected = '';
        }
        $op = '<option value="0">انتخاب کنید...</option>';
        if($data AND is_array($data) AND count($data) > 0)
        {
            for($i = 0; $i < count($data); $i++)
            {
                if($this->input->post('isSelected') == $data[$i]['id'])
                {
                    $op .= '<option value="' . $data[$i]['id'] . '"' . $selected . '>' . $data[$i]['name'] . '</option>';
                }
                else
                {
                    $op .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
        }
        
        echo $op;
    }
    
    // insert new opu
    public function insert_opu()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin())
        {
            echo $this->ajax_model->insert_opu();
        }
        else
        {
            exit;
        }
    }
    
    // get one opu data 
    public function select_one_opu()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        $data = $this->ajax_model->select_one_opu();
        if($data)
        {
            echo $data;
        }
        else
        {
            echo 'Err';
        }
    }
    
    // edit one opu
    public function edit_one_opu()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin())
        {
            echo $this->ajax_model->edit_one_opu();
        }
        else
        {
            exit;
        }
    }
    
    // insert new hospital
    public function add_new_hospital()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu())
        {
            echo $this->ajax_model->add_new_hospital();
        }
        else
        {
            exit;
        }
    }
    
    // get one hospital data 
    public function select_one_hospital()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        $data = $this->ajax_model->select_one_hospital();
        if($data)
        {
            echo $data;
        }
        else
        {
            echo 'Err';
        }
    }
    
    // edit one hospital
    public function edit_one_hospital()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu())

        {
            echo $this->ajax_model->edit_one_hospital();
        }
        else
        {
            exit;
        }
    }

    // edit one hospital By opu
    public function edit_one_hospital_opu()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            exit;
        }
        if($this->userauthentication_model->is_opu())
        {
            echo $this->ajax_model->edit_one_hospital_opu();
        }
        else
        {
            exit;
        }
    }
    
    // insert new inspector
    public function add_new_inspector()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu())
        {
            echo $this->ajax_model->add_new_inspector();
        }
        else
        {
            exit;
        }
    }
    
    // get one inspector data 
    public function select_one_inspector()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        $data = $this->ajax_model->select_one_inspector();
        if($data)
        {
            echo $data;
        }
        else
        {
            echo 'Err';
        }
    }
    
    // edit one inspector
    public function edit_one_inspector()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu())
        {
            echo $this->ajax_model->edit_one_inspector();
        }
        else
        {
            exit;
        }
    }
    
    // load hospital
    public function load_hospital()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        $data = $this->ajax_model->load_hospital();
        if($this->input->post('isSelected'))
        {
            $selected = ' selected="selected" ';
        }
        else
        {
            $selected = '';
        }
        $op = '<option value="0">انتخاب کنید...</option>';
        if($data AND is_array($data) AND count($data) > 0)
        {
            for($i = 0; $i < count($data); $i++)
            {
                if($this->input->post('isSelected') == $data[$i]['id'])
                {
                    $op .= '<option value="' . $data[$i]['id'] . '"' . $selected . '>' . $data[$i]['name'] . '</option>';
                }
                else
                {
                    $op .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
        }
        
        echo $op;
    }
    
    // load inspectors
    public function load_inspectors()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        $data = $this->ajax_model->load_inspectors();
        if($this->input->post('isSelected'))
        {
            $selected = ' selected="selected" ';
        }
        else
        {
            $selected = '';
        }
        $op = '<option value="0">انتخاب کنید...</option>';
        if($data AND is_array($data) AND count($data) > 0)
        {
            for($i = 0; $i < count($data); $i++)
            {
                if($this->input->post('isSelected') == $data[$i]['id'])
                {
                    $op .= '<option value="' . $data[$i]['id'] . '"' . $selected . '>' . $data[$i]['name'] . '</option>';
                }
                else
                {
                    $op .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
        }
        
        echo $op;
    }
    
    // load Disorders of consciousness
    public function load_doc()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        $data = $this->ajax_model->load_doc();
        if($this->input->post('isSelected'))
        {
            $selected = ' selected="selected" ';
        }
        else
        {
            $selected = '';
        }
        $op = '<option value="0">انتخاب کنید...</option>';
        if($data AND is_array($data) AND count($data) > 0)
        {
            for($i = 0; $i < count($data); $i++)
            {
                if(is_array($data[$i]['sub']) AND count($data[$i]['sub']) > 0)
                {
                    $op .= '<optgroup label="' . $data[$i]['text'] . '">';
                    for($j = 0; $j < count($data[$i]['sub']); $j++)
                    {
                        if($this->input->post('isSelected') == $data[$i]['sub'][$j]['id'])
                        {
                            $op .= '<option value="' . $data[$i]['sub'][$j]['id'] . '"' . $selected . '>' . $data[$i]['sub'][$j]['text'] . '</option>';
                        }
                        else
                        {
                            $op .= '<option value="' . $data[$i]['sub'][$j]['id'] . '">' . $data[$i]['sub'][$j]['text'] . '</option>';
                        }
                    }
                    $op .= '</optgroup>';
                }
                else
                {
                    if($data[$i]['id'] != 8)
                    {
                        if($this->input->post('isSelected') == $data[$i]['id'])
                        {
                            $op .= '<option value="' . $data[$i]['id'] . '"' . $selected . '>' . $data[$i]['text'] . '</option>';
                        }
                        else
                        {
                            $op .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['text'] . '</option>';
                        }
                    }
                }
                if($i == (count($data) - 1))
                {
                    if($this->input->post('isSelected') == 8)
                    {
                        $op .= '<option value="8"' . $selected . '>سایر</option>';
                    }
                    else
                    {
                        $op .= '<option value="8">سایر</option>';
                    }
                }
            }
        }
        
        echo $op;
    }
    
    // load tol option
    public function load_tol_option()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        $data = $this->ajax_model->load_tol_option();
        if($this->input->post('isSelected'))
        {
            $selected = ' selected="selected" ';
        }
        else
        {
            $selected = '';
        }
        $op = '<option value="0">انتخاب کنید...</option>';
        $is22 = 0;
        if($data AND is_array($data) AND count($data) > 0)
        {
            for($i = 0; $i < count($data); $i++)
            {
                if($data[$i]['tolOptionID'] == 3 AND $this->input->post('stateID') != 1)
                {
                    if($this->input->post('isSelected') == $data[$i]['tolOptionID'])
                    {
                        $op .= '<option value="' . $data[$i]['tolOptionID'] . '"' . $selected . '>' . $data[$i]['name'] . '</option>';
                    }
                    else
                    {
                        $op .= '<option value="' . $data[$i]['tolOptionID'] . '">' . $data[$i]['name'] . '</option>';
                    }
                }
                else
                {
                    if($data[$i]['sub'] AND is_array($data[$i]['sub']) AND count($data[$i]['sub']) > 0)
                    {
                        $op .= '<optgroup label="' . $data[$i]['name'] . '">';
                        for($j = 0; $j < count($data[$i]['sub']); $j++)
                        {
                            if($data[$i]['sub'][$j]['id'] == 22)
                            {
                                $is22 = 1;
                            }
                            else
                            {
                                if($this->input->post('isSelected') == $data[$i]['sub'][$j]['id'])
                                {
                                    $op .= '<option value="' . $data[$i]['sub'][$j]['id'] . '"' . $selected . '>' . $data[$i]['sub'][$j]['name'] . '</option>';
                                }
                                else
                                {
                                    $op .= '<option value="' . $data[$i]['sub'][$j]['id'] . '">' . $data[$i]['sub'][$j]['name'] . '</option>';
                                }
                            }
                        }
                        if($is22 == 1)
                        {
                            if($this->input->post('isSelected') == 22)
                            {
                                $op .= '<option value="22"' . $selected . '>سایر موارد</option>';
                            }
                            else
                            {
                                $op .= '<option value="22">سایر موارد</option>';
                            }
                            $is22 = 0;
                        }
                        $op .= '</optgroup>';
                    }
                    else
                    {
                        if($this->input->post('isSelected') == $data[$i]['tolOptionID'])
                        {
                            $op .= '<option value="' . $data[$i]['tolOptionID'] . '"' . $selected . '>' . $data[$i]['name'] . '</option>';
                        }
                        else
                        {
                            $op .= '<option value="' . $data[$i]['tolOptionID'] . '">' . $data[$i]['name'] . '</option>';
                        }
                    }
                }
            }
        }
        
        echo $op;
    }
    
    // change inspectors status
    public function change_inspector_status()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu())
        {
            echo $this->ajax_model->change_inspector_status();
        }
        else
        {
            exit;
        }
    }
    
    // change opu status
    public function change_opu_status()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin())
        {
            echo $this->ajax_model->change_opu_status();
        }
        else
        {
            exit;
        }
    }
    
    // load one patient data
    public function load_one_patient()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu() OR $this->userauthentication_model->is_inspector())
        {
            echo $this->ajax_model->load_one_patient();
        }
        else
        {
            exit;
        }
    }
    
    // load one patient extra data
    public function load_one_patient_extra_data()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu() OR $this->userauthentication_model->is_inspector())
        {
            echo $this->ajax_model->load_one_patient_extra_data();
        }
        else
        {
            exit;
        }
    }
    
    // transfer patient
    public function transfer_patient()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu() OR $this->userauthentication_model->is_inspector())
        {
            echo $this->ajax_model->transfer_patient();
        }
        else
        {
            exit;
        }
    }
    
    // edit patient data
    public function edit_patient_data()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu() OR $this->userauthentication_model->is_inspector())
        {
            echo $this->ajax_model->edit_patient_data();
        }
        else
        {
            exit;
        }
    }
    
    // load one patient logs
    public function load_one_patient_log()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu() OR $this->userauthentication_model->is_inspector())
        {
            echo $this->ajax_model->load_one_patient_log();
        }
        else
        {
            exit;
        }
    }
    
    // delete patient
    public function change_patient_status()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu())
        {
            echo $this->ajax_model->change_patient_status();
        }
        else
        {
            exit;
        }
    }
    
    // undo delete patient
    public function change_undo_patient_status()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu())
        {
            echo $this->ajax_model->change_undo_patient_status();
        }
        else
        {
            exit;
        }
    }
    
    // verify or unverify patient transfer
    public function verify_patient_transfer()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin())
        {
            echo $this->ajax_model->verify_patient_transfer();
        }
        else
        {
            exit;
        }
    }
    
    // delete hospital
    public function delete_one_hospital()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin())
        {
            echo $this->ajax_model->delete_one_hospital();
        }
        else
        {
            exit;
        }
    }
    
    // found patient result in add patient form
    public function found_patient_result()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu() OR $this->userauthentication_model->is_inspector())
        {
            echo $this->ajax_model->found_patient_result();
        }
        else
        {
            exit;
        }
    }
    
    // cehck the user loged in  -- not need model
    public function check_ajax_loged_in()
    {
        if($this->userauthentication_model->check_user_logedin())
        {
            echo 'YES';
        }
        else
        {
            echo 'NO';
        }
    }
    
    // add state and city
    public function add_state()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin())
        {
            echo $this->ajax_model->add_state();
        }
        else
        {
            exit;
        }
    }
    
    // delete state or city
    public function delete_state_or_city()
    {
        if(!$this->input->is_ajax_request())
        {
           show_404();
           exit;
        }
        if($this->userauthentication_model->is_admin())
        {
            echo $this->ajax_model->delete_state_or_city();
        }
        else
        {
            exit;
        }
    }

    // statistics_and_information
    public function statistics_and_information()
    {
        if(!$this->input->is_ajax_request() || !$this->userauthentication_model->is_admin())
        {
            show_404();
            exit;
        }
        
        $this->db->select(array(
            'COUNT(id) AS number',
            'SUM(heart) AS heart',
            'SUM(liver) AS liver',
            'SUM(kidneyRight) AS kidneyRight',
            'SUM(kidneyLeft) AS kidneyLeft',
            'SUM(lungRight) AS lungRight',
            'SUM(lungLeft) AS lungLeft',
            'SUM(pancreas) AS pancreas',
            'SUM(tissue) AS tissue',
            'SUM(bowel) AS bowel',
        ))->from('patients');

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

        $this->db->where('status < 12');
        $data = $this->db->get();
        if(!$data->num_rows())
        {
            $result['status'] = 0;
        }
        else
        {
            $data = $data->row_array();
            $result['data'] = $data;
            $result['status'] = 1;
        }
        //$this->output->enable_profiler(true);

        echo json_encode($result);
    }
}