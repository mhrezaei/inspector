<?php
class Header_model extends CI_Model {

    public function __construct()
    {

    }

    public function header_data()
    {
        $this->db->select('siteTitle');
        $this->db->from('setting');
        $this->db->where(array('id' => 1));
        $query = $this->db->get();
        $query = $query->row_array();
        $session = $this->session->userdata('user');
        $data['siteTitle'] = $query['siteTitle'];
        $data['userRole'] = $session['role'];

        if($this->userauthentication_model->is_inspector())
        {
            $data['type'] = $session['type'];
            $data['timeAccess'] = $session['insTimeAccess'];
        }
        else
        {
            $data['type'] = FALSE;
            $data['timeAccess'] = FALSE;
        }
        if($this->userauthentication_model->is_opu())
        {
            if($session['showModal'] == 1)
            {
                $data['showModal'] = 1;
                $session['user'] = $session;
                $session['user']['showModal'] = 0;
                $this->session->set_userdata($session);
            }
            else
            {
                $data['showModal'] = 0;
            }
        }
        else
        {
            $data['showModal'] = 0;
        }

        return $data;
    }

    public function login_name_info()
    {
        $data = '';
        $session = $this->session->userdata('user');
        if($this->userauthentication_model->is_admin())
        {
            $this->db->select('fullName');
            $this->db->from('setting');
            $this->db->where(array('email' => $session['uid']));
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $query = $query->row_array();
                $data['fullName'] = $query['fullName'];
                $data['userRole'] = 'ADMIN';
            }
            else
            {
                redirect(base_url() . 'userAuthentication/user_authentication/log_out');
                exit;
            }
        }
        elseif($this->userauthentication_model->is_inspector())
        {
            $this->db->select('name');
            $this->db->from('inspectors');
            $this->db->where(array('id' => $session['uid']));
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $query = $query->row_array();
                $data['fullName'] = $query['name'];
                $data['userRole'] = 'INSPECTOR';
            }
            else
            {
                redirect(base_url() . 'userAuthentication/user_authentication/log_out');
                exit;
            }
        }
        elseif($this->userauthentication_model->is_opu())
        {
            $this->db->select(array('headOffice', 'name'));
            $this->db->from('opu');
            $this->db->where(array('id' => $session['uid']));
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $query = $query->row_array();
                $data['headOffice'] = $query['headOffice'];
                $data['name'] = $query['name'];
                $data['userRole'] = 'OPU';
            }
            else
            {
                redirect(base_url() . 'userAuthentication/user_authentication/log_out');
                exit;
            }
        }

        return $data;
    }

    public function login_info()
    {
        $session = $this->session->userdata('user');

        // found last user login
        $this->db->select(array(
            'time',
            'ip'
        ));
        $this->db->from('user_log');
        $this->db->where(array(
            'uId' => $session['uid'],
            'role' => $session['role'],
            'status' => 1
        ));
        $this->db->order_by('id', 'desc');
        $this->db->limit(1,1);
        $query = $this->db->get();
        $query = $query->row_array();
        if($query AND is_array($query) AND count($query) > 0)
        {
            $data['userLogin'] = $query;
            $data['isUserLogin'] = 1;
        }
        else
        {
            $data['isUserLogin'] = 2;
        }

        // delete user log oldder than 1 week
        $this->db->select('id')
            ->from('user_log')
            ->where(array(
                'uId' => $session['uid'],
                'role' => $session['role'],
                'status' => 1,
                'time < ' => strtotime("-1 week")
            ));
        $query = $this->db->get();
        $query = $query->result_array();
        if($query AND is_array($query) AND count($query) > 0)
        {
            for($i = 0; $i < count($query); $i++)
            {
                $this->db->delete('user_log', array('id' => $query[$i]['id']));
            }
        }

        return $data;
    }

    // data component info
    public function data_component()
    {
        $sesstion = $this->session->userdata('user');
        if($this->userauthentication_model->is_admin())
        {
            // total patient
            $data['total'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12))->get();
            if($data['total']->num_rows() > 0)
            {
                $data['total'] = $data['total']->row_array();
                $data['total'] = $data['total']['count("id")'];
            }
            else
            {
                $data['total'] = 0;
            }
            // donation patient
            $data['donation'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12, 'patientStatus' => 6))->get();
            if($data['donation']->num_rows() > 0)
            {
                $data['donation'] = $data['donation']->row_array();
                $data['donation'] = $data['donation']['count("id")'];
            }
            else
            {
                $data['donation'] = 0;
            }
            // ready patient
            $data['ready'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 1 OR patientStatus = 2 OR patientStatus = 7)')->get();
            if($data['ready']->num_rows() > 0)
            {
                $data['ready'] = $data['ready']->row_array();
                $data['ready'] = $data['ready']['count("id")'];
            }
            else
            {
                $data['ready'] = 0;
            }
            // improved patient
            $data['improved'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12, 'patientStatus' => 4))->get();
            if($data['improved']->num_rows() > 0)
            {
                $data['improved'] = $data['improved']->row_array();
                $data['improved'] = $data['improved']['count("id")'];
            }
            else
            {
                $data['improved'] = 0;
            }

            // dead patient
            $data['dead'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 3 OR patientStatus = 9 OR patientStatus = 10 OR patientStatus = 11 OR patientStatus = 12 OR patientStatus = 13 OR patientStatus = 14 OR patientStatus = 15 OR patientStatus = 23)')->get();
            if($data['dead']->num_rows() > 0)
            {
                $data['dead'] = $data['dead']->row_array();
                $data['dead'] = $data['dead']['count("id")'];
            }
            else
            {
                $data['dead'] = 0;
            }

            // poor dead
            $data['poor'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 8 OR patientStatus = 16 OR patientStatus = 17 OR patientStatus = 18 OR patientStatus = 19 OR patientStatus = 20 OR patientStatus = 21 OR patientStatus = 22)')->get();
            if($data['poor']->num_rows() > 0)
            {
                $data['poor'] = $data['poor']->row_array();
                $data['poor'] = $data['poor']['count("id")'];
            }
            else
            {
                $data['poor'] = 0;
            }
        }
        elseif($this->userauthentication_model->is_opu() || $this->userauthentication_model->is_inspector())
        {
            if($this->userauthentication_model->is_opu())
            {
                $opu = $sesstion['uid'];
            }
            else
            {
                $opu = $sesstion['opuId'];
            }
            /* old counter
            // total patient
            $data['total'] = $this->db->select('count("id")')->from('patients')->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)')->where('patients.status < 12 AND pLog.isTransfer = 0 AND pLog.opu = ' . $opu)->get();
            if($data['total']->num_rows() > 0)
            {
                $data['total'] = $data['total']->row_array();
                $data['total'] = number_format($data['total']['count("id")']);
            }
            else
            {
                $data['total'] = 0;
            }
            // donation patient
            $data['donation'] = $this->db->select('count("id")')->from('patients')->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)')->where('mhr_patients.status < 12 AND mhr_patients.patientStatus = 6 AND pLog.isTransfer = 0 AND pLog.opu = ' . $opu)->get();
            if($data['donation']->num_rows() > 0)
            {
                $data['donation'] = $data['donation']->row_array();
                $data['donation'] = number_format($data['donation']['count("id")']);
            }
            else
            {
                $data['donation'] = 0;
            }
            // ready patient
            $data['ready'] = $this->db->select('count("id")')->from('patients')->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)')->where('mhr_patients.status < 12 AND (mhr_patients.patientStatus = 1 OR mhr_patients.patientStatus = 2 OR mhr_patients.patientStatus = 7) AND pLog.isTransfer = 0 AND pLog.opu = ' . $opu)->get();
            if($data['ready']->num_rows() > 0)
            {
                $data['ready'] = $data['ready']->row_array();
                $data['ready'] = number_format($data['ready']['count("id")']);
            }
            else
            {
                $data['ready'] = 0;
            }

            // improved patient
            $data['improved'] = $this->db->select('count("id")')->from('patients')->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)')->where('mhr_patients.status < 12 AND mhr_patients.patientStatus = 4 AND pLog.isTransfer = 0 AND pLog.opu = ' . $opu)->get();
            if($data['improved']->num_rows() > 0)
            {
                $data['improved'] = $data['improved']->row_array();
                $data['improved'] = number_format($data['improved']['count("id")']);
            }
            else
            {
                $data['improved'] = 0;
            }
            // dead patient
            $data['dead'] = $this->db->select('count("id")')->from('patients')->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)')->where('mhr_patients.status < 12 AND (mhr_patients.patientStatus = 3 OR mhr_patients.patientStatus = 9 OR mhr_patients.patientStatus = 10 OR mhr_patients.patientStatus = 11 OR mhr_patients.patientStatus = 12 OR mhr_patients.patientStatus = 13 OR mhr_patients.patientStatus = 14 OR mhr_patients.patientStatus = 15) AND pLog.isTransfer = 0 AND pLog.opu = ' . $opu)->get();
            if($data['dead']->num_rows() > 0)
            {
                $data['dead'] = $data['dead']->row_array();
                $data['dead'] = number_format($data['dead']['count("id")']);
            }
            else
            {
                $data['dead'] = 0;
            }
            // poor patient
            $data['poor'] = $this->db->select('count("id")')->from('patients')->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)')->where('mhr_patients.status < 12 AND (mhr_patients.patientStatus = 8 OR mhr_patients.patientStatus = 16 OR mhr_patients.patientStatus = 17 OR mhr_patients.patientStatus = 18 OR mhr_patients.patientStatus = 19 OR mhr_patients.patientStatus = 20 OR mhr_patients.patientStatus = 21 OR mhr_patients.patientStatus = 22) AND pLog.isTransfer = 0 AND pLog.opu = ' . $opu)->get();
            if($data['poor']->num_rows() > 0)
            {
                $data['poor'] = $data['poor']->row_array();
                $data['poor'] = number_format($data['poor']['count("id")']);
            }
            else
            {
                $data['poor'] = 0;
            }*/

            // total patient
            $data['total'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12, 'opu' => $opu))->get();
            if($data['total']->num_rows() > 0)
            {
                $data['total'] = $data['total']->row_array();
                $data['total'] = $data['total']['count("id")'];
            }
            else
            {
                $data['total'] = 0;
            }
            // donation patient
            $data['donation'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12, 'patientStatus' => 6, 'opu' => $opu))->get();
            if($data['donation']->num_rows() > 0)
            {
                $data['donation'] = $data['donation']->row_array();
                $data['donation'] = $data['donation']['count("id")'];
            }
            else
            {
                $data['donation'] = 0;
            }
            // ready patient
            $data['ready'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 1 OR patientStatus = 2 OR patientStatus = 7) AND opu = ' . $opu)->get();
            if($data['ready']->num_rows() > 0)
            {
                $data['ready'] = $data['ready']->row_array();
                $data['ready'] = $data['ready']['count("id")'];
            }
            else
            {
                $data['ready'] = 0;
            }
            // improved patient
            $data['improved'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12, 'patientStatus' => 4, 'opu' => $opu))->get();
            if($data['improved']->num_rows() > 0)
            {
                $data['improved'] = $data['improved']->row_array();
                $data['improved'] = $data['improved']['count("id")'];
            }
            else
            {
                $data['improved'] = 0;
            }

            // dead patient
            $data['dead'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 3 OR patientStatus = 9 OR patientStatus = 10 OR patientStatus = 11 OR patientStatus = 12 OR patientStatus = 13 OR patientStatus = 14 OR patientStatus = 15 OR patientStatus = 23) AND opu = ' . $opu)->get();
            if($data['dead']->num_rows() > 0)
            {
                $data['dead'] = $data['dead']->row_array();
                $data['dead'] = $data['dead']['count("id")'];
            }
            else
            {
                $data['dead'] = 0;
            }

            // poor dead
            $data['poor'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 8 OR patientStatus = 16 OR patientStatus = 17 OR patientStatus = 18 OR patientStatus = 19 OR patientStatus = 20 OR patientStatus = 21 OR patientStatus = 22) AND opu = ' . $opu)->get();
            if($data['poor']->num_rows() > 0)
            {
                $data['poor'] = $data['poor']->row_array();
                $data['poor'] = $data['poor']['count("id")'];
            }
            else
            {
                $data['poor'] = 0;
            }

        }
        else
        {
            $data = 0;
        }

        return $data;
    }

    // all data component info
    public function all_data_component()
    {
        // total patient
        $data['total'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12))->get();
        if($data['total']->num_rows() > 0)
        {
            $data['total'] = $data['total']->row_array();
            $data['total'] = $data['total']['count("id")'];
        }
        else
        {
            $data['total'] = 0;
        }
        // donation patient
        $data['donation'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12, 'patientStatus' => 6))->get();
        if($data['donation']->num_rows() > 0)
        {
            $data['donation'] = $data['donation']->row_array();
            $data['donation'] = $data['donation']['count("id")'];
        }
        else
        {
            $data['donation'] = 0;
        }
        // ready patient
        $data['ready'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 1 OR patientStatus = 2 OR patientStatus = 7)')->get();
        if($data['ready']->num_rows() > 0)
        {
            $data['ready'] = $data['ready']->row_array();
            $data['ready'] = $data['ready']['count("id")'];
        }
        else
        {
            $data['ready'] = 0;
        }
        // improved patient
        $data['improved'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12, 'patientStatus' => 4))->get();
        if($data['improved']->num_rows() > 0)
        {
            $data['improved'] = $data['improved']->row_array();
            $data['improved'] = $data['improved']['count("id")'];
        }
        else
        {
            $data['improved'] = 0;
        }

        // dead patient
        $data['dead'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 3 OR patientStatus = 9 OR patientStatus = 10 OR patientStatus = 11 OR patientStatus = 12 OR patientStatus = 13 OR patientStatus = 14 OR patientStatus = 15 OR patientStatus = 23)')->get();
        if($data['dead']->num_rows() > 0)
        {
            $data['dead'] = $data['dead']->row_array();
            $data['dead'] = $data['dead']['count("id")'];
        }
        else
        {
            $data['dead'] = 0;
        }

        // poor dead
        $data['poor'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 8 OR patientStatus = 16 OR patientStatus = 17 OR patientStatus = 18 OR patientStatus = 19 OR patientStatus = 20 OR patientStatus = 21 OR patientStatus = 22)')->get();
        if($data['poor']->num_rows() > 0)
        {
            $data['poor'] = $data['poor']->row_array();
            $data['poor'] = $data['poor']['count("id")'];
        }
        else
        {
            $data['poor'] = 0;
        }

        return $data;
    }

    // all opu data component
    public function all_opu_data_component()
    {
        $opu = $this->db->select(array('id', 'name', 'population', 'type', 'pmp', 'grade'))->from('opu')->where('status', 1)->order_by('name', 'ASC')->get();
        if($opu->num_rows())
        {
            $opu = $opu->result_array();
            for($i = 0; $i < count($opu); $i++)
            {
                // total patient
                $data['total'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12, 'opu' => $opu[$i]['id']))->get();
                if($data['total']->num_rows() > 0)
                {
                    $data['total'] = $data['total']->row_array();
                    $data['total'] = $data['total']['count("id")'];
                }
                else
                {
                    $data['total'] = 0;
                }
                // donation patient
                $data['donation'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12, 'patientStatus' => 6, 'opu' => $opu[$i]['id']))->get();
                if($data['donation']->num_rows() > 0)
                {
                    $data['donation'] = $data['donation']->row_array();
                    $data['donation'] = $data['donation']['count("id")'];
                }
                else
                {
                    $data['donation'] = 0;
                }
                // ready patient
                $data['ready'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 1 OR patientStatus = 2 OR patientStatus = 7) AND opu = ' . $opu[$i]['id'])->get();
                if($data['ready']->num_rows() > 0)
                {
                    $data['ready'] = $data['ready']->row_array();
                    $data['ready'] = $data['ready']['count("id")'];
                }
                else
                {
                    $data['ready'] = 0;
                }
                // improved patient
                $data['improved'] = $this->db->select('count("id")')->from('patients')->where(array('status < ' => 12, 'patientStatus' => 4, 'opu' => $opu[$i]['id']))->get();
                if($data['improved']->num_rows() > 0)
                {
                    $data['improved'] = $data['improved']->row_array();
                    $data['improved'] = $data['improved']['count("id")'];
                }
                else
                {
                    $data['improved'] = 0;
                }

                // dead patient
                $data['dead'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 3 OR patientStatus = 9 OR patientStatus = 10 OR patientStatus = 11 OR patientStatus = 12 OR patientStatus = 13 OR patientStatus = 14 OR patientStatus = 15 OR patientStatus = 23) AND opu = ' . $opu[$i]['id'])->get();
                if($data['dead']->num_rows() > 0)
                {
                    $data['dead'] = $data['dead']->row_array();
                    $data['dead'] = $data['dead']['count("id")'];
                }
                else
                {
                    $data['dead'] = 0;
                }

                // poor dead
                $data['poor'] = $this->db->select('count("id")')->from('patients')->where('status < 12 AND (patientStatus = 8 OR patientStatus = 16 OR patientStatus = 17 OR patientStatus = 18 OR patientStatus = 19 OR patientStatus = 20 OR patientStatus = 21 OR patientStatus = 22) AND opu = ' . $opu[$i]['id'])->get();
                if($data['poor']->num_rows() > 0)
                {
                    $data['poor'] = $data['poor']->row_array();
                    $data['poor'] = $data['poor']['count("id")'];
                }
                else
                {
                    $data['poor'] = 0;
                }
                $opu[$i]['data'] = $data;
            }
        }

        return $opu;
    }

    // footer data
    public function footer_data()
    {
        return TRUE;
    }
}