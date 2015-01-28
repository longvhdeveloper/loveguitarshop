<?php
class Productcategory extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //set data for view
        $this->data['message'] = $this->session->flashdata('flash_message');
        $this->data['title'] = $this->lang->line('vendor_title_listing');
        $this->data['menu'] = 'productcategory';
        $this->data['content'] = 'productcategory/index_view';
        $this->load->view($this->data['path'], $this->data);
    }

    public function add()
    {
        $this->load->model('Mproductcategory');

        //load form_validation helper
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;


        //set data for view
        $this->data['statusOptions'] = $this->Mproductcategory->getStatusList();
        $this->data['title'] = $this->lang->line('category_title_add');
        $this->data['menu'] = 'productcategory';
        $this->data['content'] = 'productcategory/add_view';
        $this->load->view($this->data['path'], $this->data);
    }
}