<?php
class Vendor extends AdminController
{
    private $recordPerPage = 5;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $_SESSION['KCFINDER']['disabled'] = false;
        $_SESSION['KCFINDER']['uploadURL'] = base_url() . 'uploads/vendor/main_content';
    }

    public function index()
    {
        $this->load->model('Mvendor');

        $this->data['total'] = $this->Mvendor->getVendors(array(), '', '',0, 0, true);
        //load pagination helper
        $this->load->helper('pagination');
        $baseUrl = base_url() . $this->data['module'] . '/vendor/index';
        $this->data['pagination_link'] = create_pagination($this->data['total'],$this->recordPerPage, 4, $baseUrl);

        $start = $this->uri->segment(4);
        $vendors = $this->Mvendor->getVendors(array(), 'id', 'DESC', $this->recordPerPage, $start);
        $this->data['vendors'] = $vendors;

        //set data for view
        $this->data['message'] = $this->session->flashdata('flash_message');
        $this->data['title'] = $this->lang->line('vendor_title_listing');
        $this->data['menu'] = 'vendor';
        $this->data['content'] = 'vendor/index_view';
        $this->load->view($this->data['path'], $this->data);
    }

    public function add()
    {
        $this->load->model('Mvendor');

        //load form_validation helper
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

        //set rules for form_validation
        $this->form_validation->set_rules('fname', 'Name', 'required|callback_checkVendorName');
        $this->form_validation->set_rules('fslug', 'Slug', 'required');

        if ($this->form_validation->run()) {
            $vendorData = array(
                'v_name' => $this->input->post('fname'),
                'v_slug' => $this->input->post('fslug'),
                'v_description' => $this->input->post('fdescription'),
                'v_status' => $this->input->post('fstatus'),
                'v_datecreated' => time(),
            );

            if ($this->Mvendor->addData($vendorData)) {
                $this->session->set_flashdata('flash_message', $this->lang->line('vendor_addSuccess'));
                redirect(base_url() . 'admin/vendor/index');
            } else {
                $this->data['error'] = $this->Mvendor->getError();
            }

        }

        //set data for view
        $this->data['statusOptions'] = $this->Mvendor->getStatusList();
        $this->data['title'] = $this->lang->line('vendor_title_add');
        $this->data['menu'] = 'vendor';
        $this->data['content'] = 'vendor/add_view';
        $this->load->view($this->data['path'], $this->data);
    }

    public function edit($id)
    {
        $this->load->model('Mvendor');
        $vendor = $this->Mvendor->getVendor($id);

        if ($vendor != false) {
            $this->data['vendor'] = $vendor;

            //load form_validation helper
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;

            //set rules for form_validation
            $this->form_validation->set_rules('fname', 'Name', 'required|callback_checkVendorName['.$id.']');
            $this->form_validation->set_rules('fslug', 'Slug', 'required');

            if ($this->form_validation->run()) {
                $vendorData = array(
                    'v_name' => $this->input->post('fname'),
                    'v_slug' => $this->input->post('fslug'),
                    'v_description' => $this->input->post('fdescription'),
                    'v_status' => $this->input->post('fstatus'),
                    'v_datemodified' => time(),
                );

                if ($this->Mvendor->updateData($vendorData, $id)) {

                    if ($this->input->post('fisdeletelogo') == 1) {
                        $fileName = $this->baseDir . '/uploads/vendor/logo/' . $vendor['v_logo'];
                        $this->Mvendor->deleteImage($fileName, $id);
                    }

                    $this->session->set_flashdata('flash_message', $this->lang->line('vendor_editSuccess'));
                    redirect(base_url() . 'admin/vendor/index');
                } else {
                    $this->data['error'] = $this->Mvendor->getError();
                }

            }

            //set data for view
            $this->data['statusOptions'] = $this->Mvendor->getStatusList();
            $this->data['title'] = $this->lang->line('vendor_title_edit');
            $this->data['menu'] = 'vendor';
            $this->data['content'] = 'vendor/edit_view';
            $this->load->view($this->data['path'], $this->data);
        } else {
            $this->data['redirectUrl'] = $url;
            $this->data['title'] = 'Redirect';
            $this->load->view($this->data['module'] . '/redirect', $this->data);
        }
    }

    public function delete($id)
    {
        $url = base_url() . $this->data['module'] . '/vendor/index';
        $this->load->model('Mvendor');
        if ($this->Mvendor->getVendor($id) != false) {
            $this->Mvendor->deleteData($id);
            $this->session->set_flashdata('flash_message', $this->lang->line('vendor_deleteSuccess'));
            redirect($url);
        } else {
            $this->data['redirectUrl'] = $url;
            $this->data['title'] = 'Redirect';
            $this->load->view($this->data['module'] . '/redirect', $this->data);
        }
    }

    ######################################################################################
    public function checkVendorName($name, $id = 0)
    {
        $condition = array(
            'v_name' => $name,
        );

        if ($id > 0) {
            $condition['v_id !='] = $id;
        }

        $this->load->model('Mvendor');
        $countVendor = $this->Mvendor->getVendors(
            $condition,
            '',
            '',
            0,
            0,
            true
        );

        if ($countVendor > 0) {
            $this->form_validation->set_message('checkVendorName', 'Vendor name is exist.');
            return false;
        } else {
            return true;
        }
    }
}