<?php
class Muserprofile extends Mbase
{
    private $tableName = 'user_profile';
    public function __construct()
    {
        parent::__construct();
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
    }

    public function getUserProfileByEmail($email)
    {
        if ($email != '') {
            $this->db->where('up_email', $email);
            $query = $this->db->get($this->tableName);

            if ($query->num_rows()) {
                return $query->row_array();
            } else {
                return false;
            }
        }
        return false;
    }
}