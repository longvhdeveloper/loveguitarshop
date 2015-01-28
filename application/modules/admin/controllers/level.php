<?php
class Level extends AdminController
{
    private $recordPerPage = 5;
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('Mlevel');
        $this->data['total'] = $this->Mlevel->getLevels(array(), '', '', 0, 0, true);

        //load pagination helper
        $this->load->helper('pagination');
        $baseUrl = base_url() . $this->data['module'] . '/level/index';
        $this->data['pagination_link'] = create_pagination($this->data['total'],$this->recordPerPage, 4, $baseUrl);

        $start = $this->uri->segment(4);
        $levels = $this->Mlevel->getLevels(array(), 'id', 'DESC', $this->recordPerPage, $start);
        $this->data['levels'] = $levels;

        //set data for view
        $this->data['message'] = $this->session->flashdata('flash_message');
        $this->data['title'] = $this->lang->line('level_title_listing');
        $this->data['content'] = 'level/index_view';
        $this->data['menu'] = 'level';
        $this->load->view($this->data['path'], $this->data);
    }

    public function add()
    {
        //load form_validation helper
        $this->load->library('form_validation');

        //set rules for validation
        $this->form_validation->set_rules('fname', 'Name', 'required');

        if ($this->form_validation->run()) {
            $this->load->model('Mlevel');
            $levelData = array(
                'lv_name' => $this->input->post('fname'),
                'lv_description' => $this->input->post('fdescription'),
                'lv_datecreated' => time(),
            );

            if ($this->Mlevel->addData($levelData)) {
                $this->session->set_flashdata('flash_message', $this->lang->line('level_addSuccess'));
                redirect(base_url() . 'admin/level/index');
            }
        }

        //set data for view
        $this->data['title'] = $this->lang->line('level_title_add');
        $this->data['content'] = 'level/add_view';
        $this->data['menu'] = 'level';
        $this->load->view($this->data['path'], $this->data);
    }

    public function delete($id)
    {
        $url = base_url() . $this->data['module'] . '/level/index';
        $this->load->model('Mlevel');
        if ($this->Mlevel->getLevel($id) != false) {
            $this->Mlevel->deleteData($id);
            $this->session->set_flashdata('flash_message', $this->lang->line('level_deleteSuccess'));
            redirect($url);
        } else {
            $this->data['redirectUrl'] = $url;
            $this->data['title'] = 'Redirect';
            $this->load->view($this->data['module'] . '/redirect', $this->data);
        }
    }

    public function edit($id)
    {
        $this->load->model('Mlevel');
        $level = $this->Mlevel->getLevel($id);

        //load form_validation helper
        $this->load->library('form_validation');

        //set rules for validation
        $this->form_validation->set_rules('fname', 'Name', 'required');

        if ($this->form_validation->run()) {
            $levelData = array(
                'lv_name' => $this->input->post('fname'),
                'lv_description' => $this->input->post('fdescription'),
                'lv_datemodified' => time(),
            );

            $this->Mlevel->updateData($levelData, $id);
            $this->session->set_flashdata('flash_message', $this->lang->line('level_editSuccess'));
            redirect(base_url() . 'admin/level/index');
        }

        //set data for view
        $this->data['level'] = $level;
        $this->data['title'] = $this->lang->line('level_title_edit');
        $this->data['content'] = 'level/edit_view';
        $this->data['menu'] = 'level';
        $this->load->view($this->data['path'], $this->data);
    }
}