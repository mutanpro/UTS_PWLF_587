<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_mahasiswa');
		$this->load->library('form_validation');
		$this->load->helper('security');
	}


	public function index()
	{
		$data = array(
			'judul' => "Data Mahasiswa",
			'mahasiswa' => $this->m_mahasiswa->get_all()->result(),
		);
		$this->load->view('v_mahasiswa', $data);
	}

	public function log()
	{
		$data = array(
			'judul' => "Data Log",
			'log' => $this->m_mahasiswa->get_log()->result(),
		);
		$this->load->view('v_log', $data);
	}

	public function insert()
	{
		if ($this->input->post('submit')) {
			$this->_rule('tambah');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'judul' => "Tambah Mahasiswa",
					'id' => set_value('id'),
					'nim' => set_value('nim'),
					'nama' => set_value('nama'),
					'jk' => set_value('jk'),
					'alamat' => set_value('alamat'),
					'nohp' => set_value('nohp'),
				);
				$this->load->view('v_form', $data);
			} else {
				$aksi = $this->m_mahasiswa->insert();
				if ($aksi) {
					$this->session->set_flashdata('msg', 'Data berhasil ditambah');
					redirect('mahasiswa');
				} else {
					$this->session->set_flashdata('msg', 'Data gagal ditambah');
					redirect('mahasiswa');
				}
			}
		} else {
			$data = array(
				'judul' => "Tambah Mahasiswa",
				'id' => set_value('id'),
				'nim' => set_value('nim'),
				'nama' => set_value('nama'),
				'jk' => set_value('jk'),
				'alamat' => set_value('alamat'),
				'nohp' => set_value('nohp'),
			);
			$this->load->view('v_form', $data);
		}
	}

	public function update()
	{
		$id = decrypt_url($this->uri->segment(3));
		$row = $this->m_mahasiswa->get_by($id);
		if ($this->input->post('submit')) {
			$this->_rule('edit');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'judul' => "Edit Mahasiswa",
					'id' => set_value('id', $row->nim),
					'nim' => set_value('nim', $row->nim),
					'nama' => set_value('nama', $row->nama),
					'jk' => set_value('jk', $row->jk),
					'alamat' => set_value('alamat', $row->alamat),
					'nohp' => set_value('nohp', $row->no_hp),
				);
				$this->load->view('v_form', $data);
			} else {
				$aksi = $this->m_mahasiswa->update();
				if ($aksi) {
					$this->session->set_flashdata('msg', 'Data berhasil diubah');
					redirect('mahasiswa');
				} else {
					$this->session->set_flashdata('msg', 'Data gagal diubah');
					redirect('mahasiswa');
				}
			}
		} else {
			$data = array(

				'judul' => "Edit Mahasiswa",
				'id' => set_value('id', $row->nim),
				'nim' => set_value('nim', $row->nim),
				'nama' => set_value('nama', $row->nama),
				'jk' => set_value('jk', $row->jk),
				'alamat' => set_value('alamat', $row->alamat),
				'nohp' => set_value('nohp', $row->no_hp),
			);
			$this->load->view('v_form', $data);
		}
	}

	public function delete()
	{
		$id = decrypt_url($this->uri->segment(3));
		$aksi = $this->m_mahasiswa->delete($id);
		if ($aksi) {
			$this->session->set_flashdata('msg', 'Data berhasil dihapus');
			redirect('mahasiswa');
		} else {
			$this->session->set_flashdata('msg', 'Data gagal dihapus');
			redirect('mahasiswa');
		}
	}


	private function _rule($metode)
	{
		if ($metode == 'tambah') {
			$this->form_validation->set_rules('nim', 'NIM', 'trim|required|is_natural|exact_length[12]|is_unique[tbl_mahasiswa.nim]');
		} else if ($metode == 'edit') {
			$this->form_validation->set_rules('nim', 'NIM', 'trim|required|is_natural|exact_length[12]');
		}
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('nohp', 'No Handphone', 'trim|required|is_natural');
		$this->form_validation->set_error_delimiters('<div class="error" >', '</div>');
	}
}
