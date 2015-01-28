<?php
class Verify extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        //load form_validation helper
        $this->load->library('form_validation');

        //set rulue for form_validation
        $this->form_validation->set_rules('femail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('fpassword', 'Password', 'required');

        if ($this->form_validation->run()) {
            $this->load->model('Muserprofile');

            $userProfile = $this->Muserprofile->getUserProfileByEmail($this->input->post('femail'));

            if ($userProfile != false) {
                $this->load->helper('encrypt');
                if ($userProfile['up_password'] == encryptPassword($this->input->post('fpassword'))) {
                    //get user info
                    $this->load->model('Muser');
                    $user = $this->Muser->getUser($userProfile['u_id']);
                    $session = array(
                        'uid' => $user['u_id'],
                        'email' => $userProfile['up_email'],
                        'level' => $user['lv_id'],
                        'avatar' => $user['u_avatar'],
                        'fullname' => $user['u_fullname'],
                        'datecreated' => $user['u_datecreated'],
                    );
                    $this->session->set_userdata($session);
                    redirect(base_url() . 'admin/user');
                } else {
                    $this->data['error'] = 'Login failed. Please try again !';
                }
            } else {
                $this->data['error'] = 'Login failed. Please try again !';
            }
        }

        //set data for view
        $this->data['message'] = $this->session->flashdata('flash_message');
        $this->data['title'] = $this->lang->line('login_title_listing');
        $this->load->view('verify/login_view', $this->data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        session_start();
        session_destroy();
        redirect(base_url() . 'admin/verify/login');
    }
}