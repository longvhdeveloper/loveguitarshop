<?php
class Mvendor extends Mbase
{
    private $tableName = 'vendor';

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 2;

    protected $error;
    protected $logoInfo;

    public function __construct()
    {
        parent::__construct();
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }

    public function addData($data)
    {
        $this->db->insert($this->tableName, $data);
        $id = $this->db->insert_id();

        if ($id > 0) {
            if (is_uploaded_file($_FILES['flogo']['tmp_name'])) {
                return $this->upload($id, $data['v_slug']);
            }

            return true;

        } else {
            return false;
        }
    }

    public function updateData($data, $id)
    {
        $this->db->where('v_id', $id);
        $this->db->update($this->tableName, $data);

        if (is_uploaded_file($_FILES['flogo']['tmp_name'])) {
            return $this->upload($id, $data['v_slug']);
        }

        return true;
    }

    public function deleteData($id)
    {
        $this->db->where('v_id', $id);
        $this->db->delete($this->tableName);
    }

    public function getVendor($id)
    {
        $this->db->where('v_id', $id);
        $query = $this->db->get($this->tableName);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getVendors(
        $where = array(),
        $orderBy = '',
        $orderType = '',
        $record = 0,
        $start = 0,
        $countOnly = false
        ){

        if ($countOnly) {
            return $this->countList($where);
        } else {
            return $this->getList($where, $orderBy, $orderType, $record, $start);
        }
    }

    public function getList($where = array(), $orderBy, $orderType, $record, $start)
    {
        if (!empty($where)){
            foreach ($where as $colName => $value) {
                if ($value != '') {
                    $this->db->where($colName, $value);
                }
            }
        }
        if ($orderBy != '' && $orderType != '') {
            switch ($orderBy) {
                case 'id' :
                    $this->db->order_by('vendor.v_id', $orderType);
                    break;
                default:
                    $this->db->order_by('vendor.v_id', $orderType);
                    break;
            }
        }

        if ($record > 0) {
            $this->db->limit($record, $start);
        }
        $query = $this->db->get($this->tableName);

        return $query->result_array();
    }

    public function countList($where)
    {
        if (!empty($where)) {
            foreach ($where as $colName => $value) {
                if ($value != '') {
                    $this->db->where($colName, $value);
                }
            }
        }

        $query = $this->db->get($this->tableName);

        return $query->num_rows();
    }

    public function upload($id, $filename = '', $useWatermark = true)
    {
        $config['upload_path'] = './uploads/vendor/logo';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']	= '500';
        $config['max_width']  = '200';
        $config['max_height']  = '200';

        if ($filename != '') {
            $config['file_name'] = $filename . '_' . $id;
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('flogo')) {
            $logo= $this->upload->data();
            $vendorData = array(
                'v_logo' => $logo['file_name']
            );
            $this->db->where('v_id', $id);
            $this->db->update($this->tableName, $vendorData);

            if ($useWatermark) {
                $config['source_image'] = $this->baseDir . '/uploads/vendor/logo/' . $logo['file_name'];
                $config['wm_text'] = 'loveguitarshop.com';
                $config['wm_type'] = 'text';
                $config['wm_font_path'] = $this->baseDir .'/system/fonts/texb.ttf';
                $config['wm_font_size'] = '9';
                $config['wm_font_color'] = 'ffffff';
                $config['wm_vrt_alignment'] = 'bottom';
                $config['wm_hor_alignment'] = 'right';
                $config['wm_padding'] = '0';

                $this->load->library('image_lib', $config);
                $this->image_lib->watermark();
            }

            return true;
        } else {
            $this->setError($this->upload->display_errors());
            return false;
        }
    }

    public function deleteImage($file, $id)
    {
        if (file_exists($file)) {
            $this->db->where('v_id', $id);
            $this->db->update($this->tableName, array('v_logo' => ''));
            return @unlink($file);
        }
        return false;
    }

    public function getStatusList()
    {
        $output = array();

        $output[self::STATUS_ENABLE] = 'Enable';
        $output[self::STATUS_DISABLE] = 'Disable';

        return $output;
    }

    public function getStatusName($status)
    {
        $name = '';

        switch ($status) {
            case self::STATUS_ENABLE:
                $name = 'Enable';
                break;
            case self::STATUS_DISABLE:
                $name = 'Disable';
                break;
        }

        return $name;
    }
}