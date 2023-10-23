<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_masukan extends CI_Model {

    public function get_masukan() {
        return $this->db->get('masukan')
                        ->result();
    }

    public function get_masukan_by_id($id) {
        return $this->db->where('id', $id)
                        ->get('masukan')
                        ->row();
    }

    public function tambah() {
        $data = array(
            'nim' => $this->session->userdata('nim'),
            'saran' => $this->input->post('saran'),
            'tanggal' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('masukan', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function ubah() {
        $data = array(
            'nim' => $this->session->userdata('nim'),
            'saran' => $this->input->post('saran'),
            'tanggal' => date('Y-m-d H:i:s'),
        );
        $this->db->where('id', $this->input->post('id'))
                ->update('masukan', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function hapus($id) {
        $this->db->where('id', $id)
                ->delete('masukan');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
