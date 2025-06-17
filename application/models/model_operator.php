<?php
class model_operator extends CI_Model
{

    function login($username, $password)
    {
        $chek = $this->db->get_where('operator', array('username' => $username, 'password' =>  md5($password)));
        if ($chek->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function tampil_data()
    {
        return $this->db->get('operator');
    }

    function tampilkan_data()
    {
        $this->db->order_by('operator_id', 'desc');
        return $this->db->get('operator');
    }

    function get_one($id)
    {
        $param  =   array('operator_id' => $id);
        return $this->db->get_where('operator', $param);
    }

    function post($data)
    {
        $this->db->insert('operator', $data);
    }

    function edit($data, $id)
    {
        $this->db->where('operator_id', $id);
        $this->db->update('operator', $data);
    }

    function delete($id)
    {
        $this->db->where('operator_id', $id);
        $this->db->delete('operator');
    }
}
