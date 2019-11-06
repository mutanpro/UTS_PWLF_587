<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_mahasiswa extends CI_Model
{

    public function get_all()
    {
        return $this->db->get('view_mahasiswa');
    }
    public function get_log()
    {
        return $this->db->order_by('id_log', 'desc')->get('tbl_log');
    }
    public function get_by($id)
    {
        return $this->db->get_where('view_mahasiswa', ['nim' => $id])->row();
    }
    public function insert()
    {
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $jk = $this->input->post('jk');
        $nohp = $this->input->post('nohp');
        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'jk' => $jk,
            'no_hp' => $nohp,
            'alamat' => $alamat,
        );
        return $this->db->insert('tbl_mahasiswa', $data);
    }
    public function update()
    {
        $id = $this->input->post('id');
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $jk = $this->input->post('jk');
        $no_hp = $this->input->post('nohp');
        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'jk' => $jk,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
        );
        return $this->db->update('tbl_mahasiswa', $data, ['nim' => $id]);
    }

    public function delete($id)
    {
        $this->db->where('nim', $id);
        return $this->db->delete('tbl_mahasiswa');
    }
}

/* End of file M_mahasiswa.php */
