<?php
class m_public extends CI_Model
{
	public function user_login_admin($user_id, $user_password)
	{
		$query = $this->db->query("SELECT * FROM user WHERE USER_ID = '$user_id' AND USER_PASSWORD = '$user_password'");
		return $query;
	}
	public function user_login($npm)
	{
		$query = $this->db->query("SELECT * FROM user WHERE USER_ID = '$npm'");
		return $query;
	}
	public function pemira_aktif()
	{
		$query = $this->db->query("SELECT * FROM pemira WHERE PEMIRA_STATUS = 'y'");
		return $query;
	}
	public function pemira_cekpengisian($npm, $pemira_id)
	{
		$query = $this->db->query("SELECT * FROM voting_hima, kandidat_hima WHERE voting_hima.KH_ID = kandidat_hima.KH_ID AND voting_hima.MAHASISWA_NPM = '$npm' AND kandidat_hima.PEMIRA_ID = '$pemira_id'");
		return $query;
	}
}
