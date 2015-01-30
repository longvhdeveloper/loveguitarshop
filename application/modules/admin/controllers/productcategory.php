<?php
class Productcategory extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('Mproductcategory');
        $this->data['total'] = $this->Mproductcategory->getProductcategorys(array(), '', '',0, 0, true);

        //load pagination helper
        $productcategorys = $this->Mproductcategory->getProductcategorys(array(), 'id', 'DESC');
        $this->data['productcategorys'] = $productcategorys;

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

        //set rules for form_validation
        $this->form_validation->set_rules('fname', 'Name', 'required|callback_checkProductcategoryName');
        $this->form_validation->set_rules('fslug', 'Slug', 'required');

        if ($this->form_validation->run()) {
            $productcategoryData = array(
                'u_id' => $this->data['userInfo']['uid'],
                'pc_name' => $this->input->post('fname'),
                'pc_slug' => $this->input->post('fslug'),
                'pc_description' => $this->input->post('fdescription'),
                'pc_parentid' => $this->input->post('fparentid'),
                'pc_status' => $this->input->post('fstatus'),
                'pc_displayorder' => $this->Mproductcategory->getMaxDisplayOrder(),
                'pc_datecreated' =>time(),
            );
            if ($this->Mproductcategory->addData($productcategoryData)) {
                $this->session->set_flashdata('flash_message', $this->lang->line('category_addSuccess'));
                redirect(base_url() . 'admin/productcategory/index');
            }
        }

        //set data for view
        $this->load->helper('menu');
        $this->data['productcategorys'] = $this->Mproductcategory->getProductcategorys(array(), 'id', 'DESC');
        $this->data['statusOptions'] = $this->Mproductcategory->getStatusList();
        $this->data['title'] = $this->lang->line('category_title_add');
        $this->data['menu'] = 'productcategory';
        $this->data['content'] = 'productcategory/add_view';
        $this->load->view($this->data['path'], $this->data);
    }

    public function edit($id)
    {
        $this->load->model('Mproductcategory');
        $productcategory = $this->Mproductcategory->getProductcategory($id);

        if ($productcategory != false) {
            $this->data['productcategory'] = $productcategory;

            //load form_validation helper
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;

            //set rules for form_validation
            $this->form_validation->set_rules('fname', 'Name', 'required|callback_checkProductcategoryName['.$id.']');
            $this->form_validation->set_rules('fslug', 'Slug', 'required');


            if ($this->form_validation->run()) {
                $productcategoryData = array(
                    'u_id' => $this->data['userInfo']['uid'],
                    'pc_name' => $this->input->post('fname'),
                    'pc_slug' => $this->input->post('fslug'),
                    'pc_description' => $this->input->post('fdescription'),
                    'pc_parentid' => $this->input->post('fparentid'),
                    'pc_status' => $this->input->post('fstatus'),
                    'pc_displayorder' => $this->input->post('fdisplayorder'),
                    'pc_datemodified' =>time(),
                );
                if ($this->Mproductcategory->updateData($id, $productcategoryData)) {
                    $this->session->set_flashdata('flash_message', $this->lang->line('category_editSuccess'));
                    redirect(base_url() . 'admin/productcategory/index');
                }
            }

            //set data for view
            $this->load->helper('menu');
            $this->data['productcategorys'] = $this->Mproductcategory->getProductcategorys(array(), 'id', 'DESC');
            $this->data['statusOptions'] = $this->Mproductcategory->getStatusList();
            $this->data['title'] = $this->lang->line('category_title_edit');
            $this->data['menu'] = 'productcategory';
            $this->data['content'] = 'productcategory/edit_view';
            $this->load->view($this->data['path'], $this->data);

        } else {
            $this->data['redirectUrl'] = $url;
            $this->data['title'] = 'Redirect';
            $this->load->view($this->data['module'] . '/redirect', $this->data);
        }
    }

    public function delete($id)
    {
        $url = base_url() . $this->data['module'] . '/productcategory/index';
        $this->load->model('Mproductcategory');

        if ($this->Mproductcategory->getProductcategory($id) != false) {
            $this->Mproductcategory->deleteData($id);
            $this->session->set_flashdata('flash_message', $this->lang->line('category_deleteSuccess'));
            redirect($url);
        } else {
            $this->data['redirectUrl'] = $url;
            $this->data['title'] = 'Redirect';
            $this->load->view($this->data['module'] . '/redirect', $this->data);
        }
    }


    ############################################################################################
    public function checkProductcategoryName($name, $id = 0)
    {
        $condition = array(
            'pc_name' => $name,
        );

        if ($id > 0) {
            $condition['pc_id !='] = $id;
        }

        $this->load->model('Mproductcategory');
        $countProductcategorys = $this->Mproductcategory->getProductcategorys(
            $condition,
            '',
            '',
            0,
            0,
            true
        );

        if ($countProductcategorys > 0) {
            $this->form_validation->set_message('checkProductcategoryName', 'Product category name is exist.');
            return false;
        } else {
            return true;
        }
    }
}