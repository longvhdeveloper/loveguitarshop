<?php
class Muser extends Mbase
{
    private $tableName = 'user';
    protected $error;

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

        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateData($data, $id)
    {
        $this->db->where('u_id', $id);
        $this->db->update($this->tableName, $data);

        if (is_uploaded_file($_FILES['favatar']['tmp_name'])) {
            return $this->upload($id, 'avatar');
        }
        return true;
    }

    public function getUser($id)
    {
        $this->db->where('user.u_id', $id);
        $this->db->join('user_profile', 'user.u_id = user_profile.u_id');
        $query = $this->db->get($this->tableName);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function deleteData($id)
    {
        $this->db->where('u_id', $id);
        $this->db->delete($this->tableName);
    }

    public function getUsers(
        $where = array(),
        $orderBy = '',
        $orderType = '',
        $record = 0,
        $start = 0,
        $countOnly = false
        ) {

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
                    $this->db->order_by('user.u_id', $orderType);
                    break;
                default:
                    $this->db->order_by('user.u_id', $orderType);
                    break;
            }
        }

        if ($record > 0) {
            $this->db->limit($record, $start);
        }
        $this->db->join('user_profile', 'user.u_id = user_profile.u_id');
        $this->db->join('level', 'user.lv_id = level.lv_id');
        $query = $this->db->get($this->tableName);

        return $query->result_array();
    }

    public function countList($where = array())
    {
        if (!empty($where)){
            foreach ($where as $colName => $value) {
                if ($value != '') {
                    $this->db->where($colName, $value);
                }
            }
        }
        $this->db->join('user_profile', 'user.u_id = user_profile.u_id');
        $this->db->join('level', 'user.lv_id = level.lv_id');
        $query = $this->db->get($this->tableName);
        return $query->num_rows();
    }

    public function upload($id, $filename, $useWatermark = true)
    {
        $config['upload_path'] = './uploads/user/avatar';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']	= '500';
        $config['max_width']  = '0';
        $config['max_height']  = '0';

        if ($filename != '') {
            $config['file_name'] = $filename . '_' . $id;
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('favatar')) {
            $avatar = $this->upload->data();
            $userData = array(
                'u_avatar' => $avatar['file_name']
            );

            $this->db->where('u_id', $id);
            $this->db->update($this->tableName, $userData);

            if ($useWatermark) {
                $config['source_image'] = $this->baseDir . '/uploads/user/avatar/' . $avatar['file_name'];
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
}