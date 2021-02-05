<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if (isset($_POST['btn_login'])) {
			$this->load->model('m_public');
			$npm = $this->input->post('npm');
			$npm_angkatan = substr($npm, 0, 2);
			$npmpassword = $this->input->post('npmpassword');
			$npm_angkatan = "20" . $npm_angkatan;
			$login = $this->m_public->user_login($npm,$npmpassword);
			$caripemiraaktif = $this->m_public->pemira_aktif();
			if (!empty($caripemiraaktif->row())) {
				foreach ($caripemiraaktif->result() as $row) {
					$pemira_id = $row->PEMIRA_ID;
					$pemira_angkatan = $row->PEMIRA_ANGKATAN;
					$angkatan = explode(",", $pemira_angkatan);
					$cekpengisian = $this->m_public->pemira_cekpengisian($npm, $pemira_id);
					if (empty($cekpengisian->row())) {
						if (in_array($npm_angkatan, $angkatan)) {
							if (!empty($login->row())) {
								foreach ($login->result() as $row) {
									if ($row->USER_BLOCK == "n") {
										$sess_data['user_id'] = $row->USER_ID;
										$sess_data['user_level'] = $row->USER_LEVEL;
										$this->session->set_userdata($sess_data);
										if ($row->USER_LEVEL == "mahasiswa") {
											redirect('mahasiswa/voting');
										} else {
											$this->session->set_flashdata('msg', $this->pesan('danger', 'NPM Tidak Terdaftar bro'));
											redirect('public/login');
										}
									} else {
										$this->session->set_flashdata('msg', $this->pesan('danger', 'NPM telah diblokir'));
										redirect('public/login');
									}
								}
							} else {
								$this->session->set_flashdata('msg', $this->pesan('danger', 'NPM Tidak Terdaftar bu'));
								redirect('public/login');
							}
						} else {
							$this->session->set_flashdata('msg', $this->pesan('danger', 'Maaf angkatan ' . $npm_angkatan . ' tidak berhak memilih'));
							redirect('public/login');
						}
					} else {
						$this->session->set_flashdata('msg', $this->pesan('danger', 'Anda telah melakukan voting'));
						redirect('public/login');
					}
				}
			} else {
				$this->session->set_flashdata('msg', $this->pesan('danger', 'Maaf pemira belum dimulai'));
				redirect('public/login');
			}
		} else {
			$this->load->view('login');
		}
	}
	public function admin()
	{
		$this->load->model('m_public');
		if (isset($_POST['btn_login'])) {
			$user_id = $this->input->post('user_id');
			$user_password = $this->input->post('user_password');
			// $user_password = md5($user_password);
			$loginadmin = $this->m_public->user_login_admin($user_id, $user_password);
			if (!empty($loginadmin->row())) {
				foreach ($loginadmin->result() as $row) {
					if ($row->USER_BLOCK == "n") {
						$sess_data['user_id'] = $row->USER_ID;
						$sess_data['user_password'] = $row->USER_PASSWORD;
						$sess_data['user_level'] = $row->USER_LEVEL;
						$this->session->set_userdata($sess_data);
						if ($row->USER_LEVEL == "admin") {
							$this->session->set_flashdata('msg', $this->pesan('success', 'Hallo Admin...   :)'));
							redirect('admin/dashboard/index');
						} else {
							$this->session->set_flashdata('msg', $this->pesan('danger', 'Hayoo mau ngapain?   :D'));
							redirect('public/login/admin');
						}
					} else {
						$this->session->set_flashdata('msg', $this->pesan('danger', 'Akun telah diblokir'));
						redirect('public/login/admin');
					}
				}
			} else {
				$this->session->set_flashdata('msg', $this->pesan('danger', 'User id atau password tidak sesuai'));
				redirect('public/login/admin');
			}
		} else {
			$this->load->view('loginadmin');
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
	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_password');
		$this->session->unset_userdata('user_level');
		redirect(base_url());
	}
}
