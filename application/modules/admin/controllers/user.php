<?php
class User extends AdminController
{
    private $recordPerPage = 5;
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        $this->load->model('Muser');
        $this->load->model('Mlevel');
        $this->data['total'] = $this->Muser->getUsers(array(), '', '',0, 0, true);

        //load pagination helper
        $this->load->helper('pagination');
        $baseUrl = base_url() . $this->data['module'] . '/user/index';
        $this->data['pagination_link'] = create_pagination($this->data['total'],$this->recordPerPage, 4, $baseUrl);

        $start = $this->uri->segment(4);
        $users = $this->Muser->getUsers(array(), 'id', 'DESC', $this->recordPerPage, $start);
        $this->data['users'] = $users;

		//set data for view
        $this->data['message'] = $this->session->flashdata('flash_message');
		$this->data['title'] = $this->lang->line('user_title_listing');
        $this->data['menu'] = 'user';
        $this->data['content'] = 'user/index_view';
		$this->load->view($this->data['path'], $this->data);
	}

	public function add()
	{
        //load form_validation helper
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

        //set rules for validation
        $this->form_validation->set_rules('flevel', 'Level', 'greater_than[0]');
        $this->form_validation->set_rules('ffullname', 'Fullname', 'required');
        $this->form_validation->set_rules('femail', 'Email', 'required|valid_email|callback_checkEmail');
        $this->form_validation->set_rules('fpassword', 'Password', 'required');
        $this->form_validation->set_rules('frepassword', 'Re-password', 'matches[fpassword]');

        if ($this->form_validation->run()) {
            //add user info
            $user = array(
                'u_fullname' => (string) $this->input->post('ffullname'),
                'lv_id' => (int) $this->input->post('flevel'),
                'u_datecreated' => time()
            );

            //load model user
            $this->load->model('Muser');
            if ($this->Muser->addData($user)) {
                $this->load->helper('encrypt');
                //add user profile info
                $userProfile = array(
                    'up_email' => (string) $this->input->post('femail'),
                    'up_password' => encryptPassword($this->input->post('fpassword')),
                    'up_ipaddress' => getIpAddress(true),
                    'up_datecreated' => time(),
                );

                $this->load->model('Muserprofile');
                if ($this->Muserprofile->addData($userProfile)) {
                    $this->session->set_flashdata('flash_message', $this->lang->line('user_addSuccess'));
                    redirect(base_url() . 'admin/user/index');
                }
            }
        }

		//set data for view
		$this->load->model('Mlevel');

		$this->data['levelOptions'] = $this->Mlevel->getLevels();
		$this->data['title'] = $this->lang->line('user_title_add');
        $this->data['menu'] = 'user';
		$this->data['content'] = 'user/add_view';
		$this->load->view($this->data['path'], $this->data);
	}

    public function delete($id)
    {
        $url = base_url() . $this->data['module'] . '/user/index';
        $this->load->model('Muser');
        if ($this->Muser->getUser($id) != false) {
            $this->Muser->deleteData($id);
            $this->session->set_flashdata('flash_message', $this->lang->line('user_deleteSuccess'));
            redirect($url);
        } else {
            $this->data['redirectUrl'] = $url;
            $this->data['title'] = 'Redirect';
            $this->load->view($this->data['module'] . '/redirect', $this->data);
        }
    }

    public function edit($id)
    {
        $this->load->model('Muser');
        $user = $this->Muser->getUser($id);
        if ($user != false) {
            //load form_validation helper
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;

            //set rules for validation
            $this->form_validation->set_rules('flevel', 'Level', 'greater_than[0]');
            $this->form_validation->set_rules('ffullname', 'Fullname', 'required');
            $this->form_validation->set_rules('femail', 'Email', 'required|valid_email|callback_checkEmail['.$id.']');
            $this->form_validation->set_rules('frepassword', 'Re-password', 'matches[fpassword]');

            if ($this->form_validation->run()) {
                //update user info
                $userData = array(
                    'u_fullname' => (string) $this->input->post('ffullname'),
                    'u_screenname' => (string) $this->input->post('fscreenname'),
                    'u_gender' => (int) $this->input->post('fgender'),
                    'lv_id' => (int) $this->input->post('flevel'),
                    'u_datemodified' => time()
                );

                if ($this->Muser->updateData($userData, $id)) {
                    //update user profile info
                    $this->load->model('Muserprofile');
                    $userProfileData = array(
                        'up_email' => (string)$this->input->post('femail'),
                        'up_phone' => (string)$this->input->post('fphone'),
                        'up_address' => (string)$this->input->post('faddress'),
                        'up_bio' => (string)$this->input->post('fbio'),
                    );

                    if ($this->input->post('fbirthday') != '') {
                        $userProfileData['up_birthday'] = (string)$this->input->post('fbirthday');
                    }

                    if ($this->input->post('fpassword') != '') {
                        $this->load->helper('encrypt');
                        $userProfileData['up_password'] = encryptPassword($this->input->post('fpassword'));
                    }

                    $this->Muserprofile->updateData($userProfileData, $id);

                    $this->session->set_flashdata('flash_message', $this->lang->line('user_editSuccess'));
                    redirect(base_url() . 'admin/user/index');
                } else {
                    $this->data['error'] = $this->Muser->getError();
                }

            }

            $this->data['user'] = $user;
            //set data for view
            $this->load->model('Mlevel');
            $this->data['levelOptions'] = $this->Mlevel->getLevels();

            $this->data['title'] = $this->lang->line('user_title_edit');
            $this->data['menu'] = 'user';
            $this->data['content'] = 'user/edit_view';
            $this->data['js'] = array(
                'plugin/datepicker/bootstrap-datepicker.js',
                'plugin/jasny/jasny-bootstrap.min.js'
            );
            $this->data['css'] = array(
                'plugin/datepicker/datepicker3.css',
                'plugin/jasny/jasny-bootstrap.min.css'
            );
            $this->load->view($this->data['path'], $this->data);
        } else {
            $this->data['redirectUrl'] = $url;
            $this->data['title'] = 'Redirect';
            $this->load->view($this->data['module'] . '/redirect', $this->data);
        }
    }

    ####################################################################################
    public function checkEmail($email, $id)
    {
        $condition =  array(
            'user_profile.up_email' => $email,
        );

        if ($id > 0) {
            $condition['user.u_id !='] = $id;
        }

        $this->load->model('Muser');
        $countUser = $this->Muser->getUsers(
            $condition,
            '',
            '',
            0,
            0,
            true
        );

        if ($countUser > 0) {
            $this->form_validation->set_message('checkEmail', 'Email has been registered.');
            return false;
        } else {
            return true;
        }
    }

}