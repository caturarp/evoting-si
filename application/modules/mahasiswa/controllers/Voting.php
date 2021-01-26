<?php
defined('BASEPATH') or exit('No direct script access allowed');
class voting extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_mahasiswa');
		if (!empty($this->session->userdata('user_id'))) {
			if ($this->session->userdata('user_level') == "mahasiswa") {
			} else {
				$this->session->set_flashdata('msg', $this->pesan('danger', 'Anda bukan mahasiswa'));
				redirect('public/login');
			}
		} else {
			$this->session->set_flashdata('msg', $this->pesan('danger', 'Silahkan login dahulu'));
			redirect('public/login');
		}
	}

	public function index()
	{
		$data['namamahasiswa'] = $this->m_mahasiswa->mahasiswa_view_id($this->session->userdata('user_id'))->result();
		$caripemiraaktif = $this->m_mahasiswa->pemira_cariaktif()->result();
		foreach ($caripemiraaktif as $row) {
			$pemira_id = $row->PEMIRA_ID;
		}
		if (isset($_GET['pilihhima'])) {
			$kh_id = $this->input->get('pilihhima');
			$caripilihhima = $this->m_mahasiswa->caripilihhima($this->session->userdata('user_id'), $kh_id);
			if (empty($caripilihhima->row())) {
				$this->m_mahasiswa->pilihhima($this->session->userdata('user_id'), $kh_id, $this->sekarang());
				$this->session->set_flashdata('msg', $this->pesan('success', 'Silahkan pilih kandidat blj'));
				redirect('mahasiswa/voting/?blj');
			} else {
				$this->session->set_flashdata('msg', $this->pesan('danger', 'Anda telah memilih kandidat hima'));
				redirect('mahasiswa/voting/?blj');
			}
		} elseif (isset($_GET['pilihblj'])) {
			$kb_id = $this->input->get('pilihblj');
			$caripilihblj = $this->m_mahasiswa->caripilihblj($this->session->userdata('user_id'), $kb_id);
			if (empty($caripilihblj->row())) {
				$this->m_mahasiswa->pilihblj($this->session->userdata('user_id'), $kb_id, $this->sekarang());
				redirect('mahasiswa/voting/?selesai');
			} else {
				$this->session->set_flashdata('msg', $this->pesan('danger', 'Anda telah memilih kandidat blj'));
				redirect('mahasiswa/voting/?selesai');
			}
		} elseif (isset($_GET['blj'])) {
			$angkatan = substr($this->session->userdata('user_id'), 0, 2);
			$bolehtidak = $this->m_mahasiswa->voting_kb_view($pemira_id, $angkatan);
			if (!empty($bolehtidak->row())) {
				$data['blj'] = $this->m_mahasiswa->voting_kb_view($pemira_id, $angkatan)->result();
				$this->load->view('blj', $data);
			} else {
				redirect('mahasiswa/voting/?selesai');
			}
		} elseif (isset($_GET['selesai'])) {
			$this->load->view('selesai', $data);
		} else {
			$data['himpunan'] = $this->m_mahasiswa->voting_kh_view($pemira_id)->result();
			$this->load->view('home', $data);
		}
	}

	public function foto($jenis)
	{
		if ($jenis == "hima") {
			$kh_id = $this->input->get('kh_id');
			$mahasiswa_npm = $this->input->get('mahasiswa_npm');
			$ambilfoto = $this->m_mahasiswa->dkh_view_foto($kh_id, $mahasiswa_npm)->result();
			foreach ($ambilfoto as $row) {
				header("Content-type: image/png");
				echo $row->DKH_FOTO;
			}
		} elseif ($jenis == "blj") {
			$kb_id = $this->input->get('kb_id');
			$mahasiswa_npm = $this->input->get('mahasiswa_npm');
			$ambilfoto = $this->m_mahasiswa->dkb_view_foto($kb_id, $mahasiswa_npm)->result();
			foreach ($ambilfoto as $row) {
				header("Content-type: image/png");
				echo $row->DKB_FOTO;
			}
		}
	}
	public function pesan($status, $text)
	{
		if ($status == "success") {
			$pesan = '
				<div class="panel panel-success">
					<div class="panel-heading"><i class="fas fa-check-circle"></i> <b>Success</b></div>
					<div class="panel-body">
						' . $text . '
					</div>
				</div>
			';
		} elseif ($status == "danger") {
			$pesan = '
				<div class="panel panel-danger">
					<div class="panel-heading"><i class="fas fa-times-circle"></i> <b>Error</b></div>
					<div class="panel-body">
						' . $text . '
					</div>
				</div>
			';
		} elseif ($status == "info") {
			$pesan = '
				<div class="panel panel-info">
					<div class="panel-heading"><i class="fas fa-info-circle"></i> <b>Info</b></div>
					<div class="panel-body">
						' . $text . '
					</div>
				</div>
			';
		} elseif ($status == "warning") {
			$pesan = '
				<div class="panel panel-warning">
					<div class="panel-heading"><i class="fas fa-info-circle"></i> <b>Warning</b></div>
					<div class="panel-body">
						' . $text . '
					</div>
				</div>
			';
		}
		return $pesan;
	}
	public function sekarang()
	{
		date_default_timezone_set("Asia/Jakarta");
		$today = date("Y-m-d H:i:s");
		return $today;
	}
}
