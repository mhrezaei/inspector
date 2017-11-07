<?php
class Userauthentication_model extends CI_Model {

    public function __construct()
    {
        
    }

    public function login_user()
    {
        $user = $this->input->post('username', TRUE, TRUE);
        $pass = $this->input->post('password', TRUE, TRUE);
        if(filter_var($user, FILTER_VALIDATE_EMAIL)) // check admin login
        {
            $this->db->select(array('email', 'authCode'));
            $this->db->from('setting');
            $this->db->where(array('email' => $user, 'password' => hashStr($pass)));
            $query = $this->db->get();

            if($query->num_rows() > 0)
            {
                $data['user_data'] = $query->row_array();
                $session = '';
                $session['user'] = array(
                    'uid' => $data['user_data']['email'],
                    'authCode' => md5($data['user_data']['authCode']),
                    'uip' => hashStr($this->input->ip_address()),
                    'role' => 'ADMIN');
                $this->session->set_userdata($session);

                $log_data = array(
                                'uId' => $data['user_data']['email'],
                                'time' => time(),
                                'ip' => $this->input->ip_address(),
                                'role' => 'ADMIN',
                                'status' => 1
                            );
                $this->db->insert('user_log', $log_data);
                if($this->db->affected_rows() > 0)
                {
                    return TRUE;
                    exit;
                }
                else
                {
                    return FALSE;
                    exit;
                }
            }
            else
            {
                return FALSE;
                exit;
            }

        }
        elseif(is_numeric($user) AND strlen($user) == 10 AND $user > 0) // check inspector login
        {
            $inspector = $this->db->select(array('id', 'authCode', 'type', 'opuId'))
            ->from('inspectors')
            ->where(array(
                        'nationalCode' => $user,
                        'password' => hashStr($pass),
                        'status' => 1
                        ))
            ->get();
            if($inspector->num_rows() > 0)
            {
                $inspector = $inspector->row_array();
                if(date('H') > 7 AND date('H') < 14)
                {
                    $access = TRUE;
                }
                else
                {
                    $access = TRUE;
                }

                $session = '';
                $session['user'] = array(
                    'uid' => $inspector['id'],
                    'authCode' => md5($inspector['authCode']),
                    'uip' => hashStr($this->input->ip_address()),
                    'opuId' => $inspector['opuId'],
                    'type' => $inspector['type'],
                    'role' => 'INSPECTOR',
                    'insTimeAccess' => $access);
                $this->session->set_userdata($session);

                $data = array(
                                'uId' => $inspector['id'],
                                'time' => time(),
                                'ip' => $this->input->ip_address(),
                                'role' => 'INSPECTOR',
                                'status' => 1
                            );
                $this->db->insert('user_log', $data);
                if($this->db->affected_rows() == 1)
                {
                    return TRUE;
                    exit;
                }
                else
                {
                    $this->log_out();
                    return FALSE;
                    exit;
                }
            }
            else
            {
                return FALSE;  // not found
                exit;
            }
        }
        elseif(strlen($user) > 2 AND !is_numeric($user)) // check opu login
        {
            $opu = $this->db->select(array('id', 'authCode'))
            ->from('opu')
            ->where(array('username' => $user, 'password' => hashStr($pass), 'status' => 1))
            ->get();
            if($opu->num_rows() > 0)
            {
                $opu = $opu->row_array();

                $session = '';
                $session['user'] = array(
                    'uid' => $opu['id'],
                    'authCode' => md5($opu['authCode']),
                    'uip' => hashStr($this->input->ip_address()),
                    'role' => 'OPU',
                    'showModal' => 1
                );
                $this->session->set_userdata($session);
                $data = array(
                                'uId' => $opu['id'],
                                'time' => time(),
                                'ip' => $this->input->ip_address(),
                                'role' => 'OPU',
                                'status' => 1
                            );
                $this->db->insert('user_log', $data);
                if($this->db->affected_rows() == 1)
                {
                    return TRUE;
                    exit;
                }
                else
                {
                    $this->log_out();
                    return FALSE;
                    exit;
                }
            }
            else
            {
                return FALSE;
                exit;
            }
        }                                                
        else
        {
            return FALSE;
            exit;
        }
    }   
    
    public function check_user_logedin()
    {
        $session = $this->session->userdata('user');
        if($session)
        {
            if($session['role'] == 'ADMIN')
            {
                $this->db->select(array('authCode'));
                $this->db->from('setting');
                $this->db->where(array('email' => $session['uid']));
                $query = $this->db->get();
                $query = $query->row_array();
                if($query && count($query) > 0)
                {
                    if(md5($query['authCode']) == $session['authCode'])
                    {
                        return TRUE;
                        exit;
                    }
                    else
                    {
                        return false;
                        $this->log_out();
                        exit;
                    }
                }
                else
                {
                    return false;
                    $this->log_out();
                    exit;
                }
            }
            elseif($session['role'] == 'INSPECTOR')
            {
                $inspector = $this->db->select('authCode')->from('inspectors')->where(array('id' => $session['uid'], 'status' => 1))->get();
                if($inspector->num_rows() > 0)
                {
                    $inspector = $inspector->row_array();
                    // md5(sha1($this->input->ip_address())) == $this->session->userdata('uip')
                    if(md5($inspector['authCode']) == $session['authCode'])
                    {
                        return TRUE;
                        exit;
                    }
                    else
                    {
                        return FALSE;
                        $this->log_out();
                        exit;
                    }
                }
                else
                {
                    return FASLE;
                    $this->log_out();
                    exit;
                }
            }
            elseif($session['role'] == 'OPU')
            {
                $opu = $this->db->select('authCode')->from('opu')->where(array('id' => $session['uid'], 'status' => 1))->get();
                if($opu->num_rows() > 0)
                {
                    $opu = $opu->row_array();
                    if(md5($opu['authCode']) == $session['authCode'])
                    {
                        return TRUE;
                        exit;
                    }
                    else
                    {
                        return FALSE;
                        $this->log_out();
                        exit;
                    }
                }
                else
                {
                    return FALSE;
                    $this->log_out();
                    exit;
                }
            }
        }
        else
        {
            return FALSE;
        }
    }
    
    public function log_out()
    {
        $session = $this->session->userdata('user');
        if($session)
        {
            $this->session->unset_userdata('user');
            if($this->is_opu())
            {
                $this->session->unset_userdata('showModal');
            }
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    // change user password
    public function changeUserPassword()
    {
        $last = $this->input->post('inputLastPassword', TRUE, TRUE);
        $new = $this->input->post('inputNewPassword', TRUE, TRUE);
        $new2 = $this->input->post('inputNewPassword2', TRUE, TRUE);
        $session = $this->session->userdata('user');
        if($last)
        {
            if($new == $new2)
            {
                if($this->userauthentication_model->is_admin())
                {
                    $this->db->select(array('id', 'password', 'authCode'))
                    ->from('setting')
                    ->where(array('email' => $session['uid']));
                    $query = $this->db->get();
                    $query = $query->row_array();
                    if($query AND is_array($query) AND count($query) > 0)
                    {
                        if(hashStr($last) == $query['password'])
                        {
                            $datap = array(
                                            'password' => hashStr($new),
                                            'authCode' => md5(randnum(25))
                                            );
                            $this->db->where('id', $query['id']);
                            $this->db->update('setting', $datap);
                            
                            $data['status'] = 4; // change password success
                            $this->log_out();
                            redirect(base_url());
                            exit;
                        }
                        else
                        {
                            $data['status'] = 5; // last password invalid
                        }
                    }
                    else
                    {
                        $data['status'] = 3; // user not found
                    }
                }
                elseif($this->userauthentication_model->is_inspector())
                {
                    $this->db->select(array('id', 'password', 'authCode'))
                    ->from('inspectors')
                    ->where(array('id' => $session['uid'], 'status' => 1));
                    $query = $this->db->get();
                    if($query->num_rows() > 0)
                    {
                        $query = $query->row_array();
                        if(md5(sha1($last)) == $query['password'])
                        {
                            $datap = array(
                                            'password' => hashStr($new),
                                            'authCode' => md5(randnum(25))
                                            );
                            $this->db->where('id', $query['id']);
                            $this->db->update('inspectors', $datap);
                            
                            $data['status'] = 4; // change password success
                            $this->log_out();
                            redirect(base_url());
                            exit;
                        }
                        else
                        {
                            $data['status'] = 5; // last password invalid
                        }
                    }
                    else
                    {
                        $data['status'] = 3; // user not found
                    }
                }
                elseif($this->userauthentication_model->is_opu())
                {
                    $this->db->select(array('id', 'password', 'authCode'))
                    ->from('opu')
                    ->where(array('id' => $session['uid'], 'status' => 1));
                    $query = $this->db->get();
                    if($query->num_rows() > 0)
                    {
                        $query = $query->row_array();
                        if(md5(sha1($last)) == $query['password'])
                        {
                            $datap = array(
                                            'password' => hashStr($new),
                                            'authCode' => md5(randnum(25))
                                            );
                            $this->db->where('id', $query['id']);
                            $this->db->update('opu', $datap);
                            
                            $data['status'] = 4; // change password success
                            $this->log_out();
                            redirect(base_url());
                            exit;
                        }
                        else
                        {
                            $data['status'] = 5; // last password invalid
                        }
                    }
                    else
                    {
                        $data['status'] = 3; // user not found
                    }
                }
            }
            else
            {
                $data['status'] = 1; // pass new AND pass new2 not equal
            }
        }
        else
        {
            $data['status'] = 2; // data not posted
        }
        
        return $data;
    }
    
    // check user is admin
    public function is_admin()
    {
        $session = $this->session->userdata('user');
        if($session)
        {
            if($session['role'] == 'ADMIN')
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
            $this->log_out();
        }
    }
    
    // check user is opu
    public function is_opu()
    {
        $session = $this->session->userdata('user');
        if($session)
        {
            if($session['role'] == 'OPU')
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
            $this->log_out();
        }
    }
    
    // check user is inspector
    public function is_inspector()
    {
        $session = $this->session->userdata('user');
        if($session)
        {
            if($session['role'] == 'INSPECTOR')
            {
                if(date('H') > 7 AND date('H') < 14)
                {
                    $access = FALSE;
                }
                else
                {
                    $access = TRUE;
                }

                $session['timeAccess'] = $access;
                $this->session->set_userdata($session);
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
            $this->log_out();
        }
    }
}