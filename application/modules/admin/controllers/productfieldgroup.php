<?php
class Productfieldgroup extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

    public function detail($id)
    {
        $this->load->model('Mproductcategory');
        $productcategory = $this->Mproductcategory->getProductcategory($id);

        $url = base_url() . $this->data['module'] . '/productcategory/index';

        $this->load->model('Mproductfield');
        $this->load->model('Mproductfieldgroup');

        if ($productcategory != false) {

            //set data for view
            $this->data['productcategory'] = $productcategory;

            $this->data['title'] = $this->lang->line('category_title_edit');
            $this->data['js'] = array(
                'controller/productfieldgroup.js',
                'plugin/jquery.bootstrap-growl.min.js'
            );
            $this->data['menu'] = 'productcategory';
            $this->data['content'] = 'productfieldgroup/detail_view';
            $this->load->view($this->data['path'], $this->data);
        } else {
            $this->data['redirectUrl'] = $url;
            $this->data['title'] = 'Redirect';
            $this->load->view($this->data['module'] . '/redirect', $this->data);
        }
    }

    public function loadajax($id)
    {
        $this->load->model('Mproductcategory');
        $productcategory = $this->Mproductcategory->getProductcategory($id);

        $this->load->model('Mproductfield');
        $this->load->model('Mproductfieldgroup');

        if ($productcategory != false) {
            $productfieldgroups = $this->Mproductfieldgroup->getProductFieldGroups(
                array(
                    'pc_id' => $id
                ),
                'id',
                'ASC'
            );

            foreach ($productfieldgroups as &$productfieldgroup) {
                $productfieldgroup['productfields'] = array();
                //get product field of product field group
                $productfields = $this->Mproductfield->getProductFields(
                    array(
                        'pc_id' => $id,
                        'pfg_id' => $productfieldgroup['pfg_id']
                    ),
                    'id',
                    'ASC'
                );
                $productfieldgroup['productfields'] = $productfields;
            }
            //set data for view
            $this->data['productfieldgroups'] = $productfieldgroups;
            $this->data['datatype'] = $this->Mproductfield->getDataTypes();
            $this->load->view('productfieldgroup/ajax', $this->data);
        }
    }

    public function detailjson($id)
    {
        $jsondata = array();
        $jsondata['error'] = '';
        $this->load->model('Mproductcategory');
        $productcategory = $this->Mproductcategory->getProductcategory($id);

        $this->load->model('Mproductfield');
        $this->load->model('Mproductfieldgroup');

        if ($productcategory != false) {
            //load form_validation helper
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;

            //set rules for form_validation
            $this->form_validation->set_rules(
                'fpfgnamenew',
                'Product group field name',
                'callback_checkFieldGroupNameNew['.$id.']'
            );

            //set rules for form_validation
            $this->form_validation->set_rules(
                'fpfgname',
                'Product group field name',
                'callback_checkFieldGroupName['.$id.']'
            );

            if ($this->input->is_ajax_request()) {
                $this->load->helper('my');

                if ($this->form_validation->run()) {
                    $fieldNames = $this->input->post('fpfname');
                    $fieldNameForGroup = $this->input->post('fpfnameg');
                    foreach ($this->input->post('fpfgname') as $pfgid => $pfgname) {
                        $pfgdisplayorder = (int)getValueOfListForm($this->input->post('fpgfdisplayorder'), $pfgid);
                        $productfieldgroupInfo = array(
                            'pfg_name' => (string)$pfgname,
                            'pfg_displayorder' => (int)$pfgdisplayorder,
                            'pfg_datemodified' => time(),
                        );

                        if ($this->Mproductfieldgroup->updateData($pfgid, $productfieldgroupInfo)) {
                            if (isset($fieldNames[$pfgid])) {
                                foreach ($fieldNames[$pfgid] as $pfid => $pfname) {
                                    $pfdisplayorder = (int)getValueOfListForm(
                                        $this->input->post('fpfdisplayorder'),
                                        $pfgid,
                                        $pfid
                                    );

                                    $pfdatatype
                                    = (int)getValueOfListForm($this->input->post('fpfdatatype'), $pfgid, $pfid);

                                    $pfunit = (string)getValueOfListForm($this->input->post('fpfunit'), $pfgid, $pfid);

                                    $productfieldInfo = array(
                                        'pf_name' => $pfname,
                                        'pf_datatype' => (int)$pfdatatype,
                                        'pf_unit' => (string)$pfunit,
                                        'pf_displayorder' => $pfdisplayorder,
                                        'pf_datemodified' => time()
                                    );

                                    $this->Mproductfield->updateData($pfid, $productfieldInfo);
                                }
                            }
                            if (isset($fieldNameForGroup[$pfgid])) {
                                foreach ($fieldNameForGroup[$pfgid] as $key2 => $pfnameg) {
                                    $pfdisplayorder = (int)getValueOfListForm(
                                        $this->input->post('fpfdisplayorderg'),
                                        $pfgid,
                                        $key2
                                    );

                                    $pfdatatype
                                    = (int)getValueOfListForm($this->input->post('fpfdatatypeg'), $pfgid, $key2);

                                    $pfunit = (string)getValueOfListForm($this->input->post('fpfunitg'), $pfgid, $key2);
                                    if ($pfnameg != '') {
                                        $productfieldInfo = array(
                                            'u_id' => $this->data['userInfo']['uid'],
                                            'pc_id' => $productcategory['pc_id'],
                                            'pf_name' => $pfnameg,
                                            'pfg_id' => $pfgid,
                                            'pf_datatype' => (int)$pfdatatype,
                                            'pf_unit' => (string)$pfunit,
                                            'pf_displayorder' => $pfdisplayorder,
                                            'pf_datemodified' => time()
                                        );

                                        $this->Mproductfield->addData($productfieldInfo);
                                    }
                                }
                            }

                            unset($productfieldgroupInfo);
                        }
                    }

                    $fieldNamesNew = $this->input->post('fpfnamenew');
                    foreach ($this->input->post('fpfgnamenew') as $key => $pfgname) {
                        if ($key > 0 && $pfgname != '') {
                            $pfgdisplayorder = (int)getValueOfListForm($this->input->post('fpgfdisplayordernew'), $key);
                            $productfieldgroupInfo = array(
                                'u_id' => $this->data['userInfo']['uid'],
                                'pc_id' => $productcategory['pc_id'],
                                'pfg_name' => $pfgname,
                                'pfg_displayorder' => $pfgdisplayorder > 0 ? $pfgdisplayorder
                                    : $this->Mproductfieldgroup->getMaxDisplayOrder(),
                                'pfg_datecreated' => time()
                            );

                            $pfgid = $this->Mproductfieldgroup->addData($productfieldgroupInfo);

                            if ($pfgid != false) {
                                foreach ($fieldNamesNew[$key] as $key1 => $pfname) {
                                    if ($pfname != '') {
                                        $pfdisplayorder = (int)getValueOfListForm(
                                            $this->input->post('fpfdisplayordernew'),
                                            $key,
                                            $key1
                                        );

                                        $pfdatatype
                                            = (int)getValueOfListForm($this->input->post('fpfdatatypenew'), $key, $key1);

                                        $pfunit = (string)getValueOfListForm($this->input->post('fpfunitnew'), $key, $key1);
                                        $productfieldInfo = array(
                                            'u_id' => $this->data['userInfo']['uid'],
                                            'pc_id' => $productcategory['pc_id'],
                                            'pfg_id' => $pfgid,
                                            'pf_name' => $pfname,
                                            'pf_datatype' => (int)$pfdatatype,
                                            'pf_unit' => (string)$pfunit,
                                            'pf_displayorder' => $pfdisplayorder > 0 ? $pfdisplayorder
                                                : $this->Mproductfield->getMaxDisplayOrder(),
                                            'pf_datecreated' => time()
                                        );

                                        $this->Mproductfield->addData($productfieldInfo);
                                    }
                                }
                            }
                        }
                    }
                    $jsondata['success'] = 1;
                    $this->session->set_flashdata('flash_message', $this->lang->line('category_editSuccess'));
                } else {
                    $jsondata['error'] = validation_errors('<li>','</li>');
                }
            } else {
                $jsondata['error'] = '<li>Have errors to add product group field.</li>';
            }
        }

        echo json_encode($jsondata);
        exit();
    }

    public function deletefieldgroupajax($id)
    {
        $jsondata = array();
        $this->load->model('Mproductfieldgroup');

        if ($this->Mproductfieldgroup->getProductFieldGroup($id) != false) {
            if ($this->Mproductfieldgroup->deleteData($id)) {
                $jsondata['success'] = 1;
            }
        } else {
            $jsondata['error'] = 1;
        }

        echo json_encode($jsondata);
        exit();
    }

    public function deletefieldajax($id)
    {
        $jsondata = array();
        $this->load->model('Mproductfield');

        if ($this->Mproductfield->getProductField($id) != false) {
            if ($this->Mproductfield->deleteData($id)) {
                $jsondata['success'] = 1;
            }
        } else {
            $jsondata['error'] = 1;
        }

        echo json_encode($jsondata);
        exit();
    }

    public function checkFieldGroupNameNew($pcid)
    {
        $pass = true;

        $fieldGroupNames = $this->input->post('fpfgnamenew');
        for ($i = 1, $counter = count($fieldGroupNames); $i < $counter; $i++) {
            $name = $fieldGroupNames[$i];

            if ($name == '') {
                $this->form_validation->set_message('checkFieldGroupNameNew',
                    'Product group field name is required.');
                $pass = false;
                break;
            } else {
                $condition = array();
                $condition['pfg_name'] = (string)$name;
                $condition['pc_id'] = (int)$pcid;

                $this->load->model('Mproductfieldgroup');
                $countProductFieldGroup = $this->Mproductfieldgroup->getProductFieldGroups(
                    $condition,
                    '',
                    '',
                    0,
                    0,
                    true
                );
                if ($countProductFieldGroup > 0) {
                    $this->form_validation->set_message('checkFieldGroupNameNew',
                        'Product group field name is exist.');
                } else {
                    $fieldNames = $this->input->post('fpfnamenew');
                    for ($j = 0, $counter = count($fieldNames[$i]); $j < $counter; $j++) {
                        $fieldName = $fieldNames[$i][$j];

                        if ($fieldName != '') {
                            $condition = array();
                            $condition['pf_name'] = (string)$fieldName;
                            $condition['pc_id'] = (int)$pcid;

                            $this->load->model('Mproductfield');
                            $countProductField = $this->Mproductfield->getProductFields(
                                $condition,
                                '',
                                '',
                                0,
                                0,
                                true
                            );
                            if ($countProductField > 0) {
                                $this->form_validation->set_message(
                                    'checkFieldGroupNameNew',
                                    'Product  field name is exist.'
                                );
                            }
                        }
                    }
                }
            }
        }

        return $pass;
    }

    public function checkFieldGroupName($pcid)
    {
        $pass = true;

        $fieldGroupNames = $this->input->post('fpfgname');

        foreach ($fieldGroupNames as $pfgid => $pfgname) {
            if ($pfgname == '') {
                $this->form_validation->set_message('checkFieldGroupName',
                    'Product group field name is required.');
                $pass = false;
                break;
            } else {
                $condition = array();
                $condition['pfg_name'] = (string)$pfgname;
                $condition['pfg_id'] = $pfgid;
                $condition['pc_id'] = (int)$pcid;

                $this->load->model('Mproductfieldgroup');
                $countProductFieldGroup = $this->Mproductfieldgroup->getProductFieldGroups(
                    $condition,
                    '',
                    '',
                    0,
                    0,
                    true
                );

                if ($countProductFieldGroup > 0) {
                    $this->form_validation->set_message('checkFieldGroupName',
                        'Product group field name is exist.');
                } else {
                    $fieldNames = $this->input->post('fpfname');

                    if (isset($fieldNames[$pfgid])) {
                        foreach ($fieldNames[$pfgid] as $pfid => $pfname) {
                            if ($pfname == '') {
                                $this->form_validation->set_message(
                                    'checkFieldGroupName',
                                    'Product  field name is required.'
                                );
                                $pass = false;
                                break;
                            } else {
                                $condition = array();
                                $condition['pf_name'] = (string)$pfname;
                                $condition['pf_id'] = $pfid;
                                $condition['pc_id'] = (int)$pcid;

                                $this->load->model('Mproductfield');
                                $countProductField = $this->Mproductfield->getProductFields(
                                    $condition,
                                    '',
                                    '',
                                    0,
                                    0,
                                    true
                                );
                                if ($countProductField > 0) {
                                    $this->form_validation->set_message(
                                        'checkFieldGroupName',
                                        'Product  field name is exist.'
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }

        return $pass;
    }
}
