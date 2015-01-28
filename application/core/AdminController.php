<?php
class AdminController extends MY_Controller
{
    protected $data = array();
    protected $baseDir;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('language');
        $this->lang->load('en', 'english');

        $module = $this->router->fetch_module();
        $path = $module . DIRECTORY_SEPARATOR . 'template';

        $this->data['module'] = $module;
        $this->data['path'] = $path;
        $this->data['template_html'] = 'default';

        $this->baseDir = $_SERVER['DOCUMENT_ROOT'];

        $controller = $this->router->fetch_class();

        if ((int)$this->session->userdata('uid') == 0 && $this->session->userdata('level') != 2 && $controller != 'verify') {
            redirect(base_url() . 'admin/verify/login');
        } else {
            $this->data['userInfo'] = array(
                'uid' => $this->session->userdata('uid'),
                'email' => $this->session->userdata('email'),
                'level' => $this->session->userdata('level'),
                'avatar' => $this->session->userdata('avatar'),
                'fullname' => $this->session->userdata('fullname'),
                'datecreated' => $this->session->userdata('datecreated'),
            );
        }
    }
}