<?php
	class m_mahasiswa extends CI_Model{
		public function mahasiswa_view_all(){
			$query = $this->db->query("SELECT * FROM mahasiswa ORDER BY MAHASISWA_NPM DESC");
			return $query;
		}
		public function mahasiswa_view_id($mahasiswa_npm){
			$query = $this->db->query("SELECT * FROM mahasiswa WHERE MAHASISWA_NPM = '$mahasiswa_npm'");
			return $query;
		}
		public function mahasiswa_insert($mahasiswa_npm,$mahasiswa_nama,$mahasiswa_status){
			$this->db->query("INSERT INTO mahasiswa VALUES('$mahasiswa_npm',NULL,'$mahasiswa_nama',NULL,NULL,NULL,$mahasiswa_status)");
			$this->db->query("INSERT INTO user VALUES('$mahasiswa_npm','$mahasiswa_npm',NULL,'mahasiswa','n')");
			$this->db->query("UPDATE mahasiswa SET USER_ID = '$mahasiswa_npm' WHERE MAHASISWA_NPM = '$mahasiswa_npm'");
		}
		public function mahasiswa_view_search($search){
			$query = $this->db->query("SELECT * FROM mahasiswa WHERE MAHASISWA_NPM LIKE '%$search%' OR MAHASISWA_NAMA LIKE '%$search%' ORDER BY MAHASISWA_NPM DESC");
			return $query;
		}
		public function mahasiswa_edit($mahasiswa_npm,$mahasiswa_nama,$mahasiswa_status){
			$this->db->query("UPDATE mahasiswa SET MAHASISWA_NAMA = '$mahasiswa_nama', MAHASISWA_STATUS = '$mahasiswa_status' WHERE MAHASISWA_NPM = '$mahasiswa_npm'");
			return $query;
		}


		public function kandidat_hima_view_id($kh_id){
			$query = $this->db->query("SELECT * FROM kandidat_hima WHERE KH_ID = '$kh_id'");
			return $query;
		}
		public function kandidat_hima_insert($kh_id,$kh_nama,$kh_visi,$kh_misi){
			$this->db->query("INSERT INTO kandidat_hima VALUES('$kh_id',NULL,'$kh_nama','$kh_visi','$kh_misi')");
		}
		public function kandidat_hima_edit($kh_id,$kh_nama,$kh_visi,$kh_misi){
			$this->db->query("UPDATE kandidat_hima SET KH_NAMA = '$kh_nama', KH_VISI = '$kh_visi', KH_MISI = '$kh_misi' WHERE KH_ID = '$kh_id'");
		}
		public function kandidat_hima_view_all(){
			$query = $this->db->query("SELECT * FROM kandidat_hima ORDER BY KH_ID DESC");
			return $query;
		}
		public function kandidat_hima_view_all1(){
			$query = $this->db->query("SELECT * FROM kandidat_hima WHERE PEMIRA_ID IS NULL ORDER BY KH_ID DESC");
			return $query;
		}
		public function kandidat_hima_view_all2($pemira_id){
			$query = $this->db->query("SELECT * FROM kandidat_hima WHERE PEMIRA_ID = '$pemira_id' ORDER BY KH_ID DESC");
			return $query;
		}


		public function kandidat_blj_view_all(){
			$query = $this->db->query("SELECT * FROM kandidat_blj ORDER BY KB_ID DESC");
			return $query;
		}
		public function kandidat_blj_view_all1(){
			$query = $this->db->query("SELECT * FROM kandidat_blj WHERE PEMIRA_ID IS NULL ORDER BY KB_ID DESC");
			return $query;
		}
		public function kandidat_blj_view_all2($pemira_id){
			$query = $this->db->query("SELECT * FROM kandidat_blj WHERE PEMIRA_ID = '$pemira_id' ORDER BY KB_ID DESC");
			return $query;
		}
		public function kandidat_blj_view_id($kb_id){
			$query = $this->db->query("SELECT * FROM kandidat_blj WHERE KB_ID = '$kb_id'");
			return $query;
		}
		public function kandidat_blj_insert($kb_id,$kb_nama,$kb_visi,$kb_misi){
			$this->db->query("INSERT INTO kandidat_blj VALUES('$kb_id',NULL,'$kb_nama','$kb_visi','$kb_misi')");
		}
		public function kandidat_blj_edit($kb_id,$kb_nama,$kb_visi,$kb_misi){
			$this->db->query("UPDATE kandidat_blj SET KB_NAMA = '$kb_nama', KB_VISI = '$kb_visi', KB_MISI = '$kb_misi' WHERE KB_ID = '$kb_id'");
		}


		public function dkh_insert($kh_id,$mahasiswa_npm,$dkh_foto,$dkh_status){
			$this->db->query("INSERT INTO detail_kandidat_hima VALUES('$kh_id','$mahasiswa_npm','$dkh_foto','$dkh_status')");
		}
		public function dkh_view_id($kh_id){
			$query = $this->db->query("SELECT * FROM detail_kandidat_hima, mahasiswa WHERE detail_kandidat_hima.MAHASISWA_NPM = mahasiswa.MAHASISWA_NPM AND detail_kandidat_hima.KH_ID = '$kh_id' ORDER BY detail_kandidat_hima.DKH_STATUS ASC");
			return $query;
		}
		public function dkh_view_foto($kh_id,$mahasiswa_npm){
			$query = $this->db->query("SELECT * FROM detail_kandidat_hima WHERE KH_ID = '$kh_id' AND MAHASISWA_NPM = '$mahasiswa_npm'");
			return $query;
		}
		public function dkh_delete($kh_id,$mahasiswa_npm){
			$this->db->query("DELETE FROM detail_kandidat_hima WHERE KH_ID = '$kh_id' AND MAHASISWA_NPM = '$mahasiswa_npm'");
		}

		public function dkb_insert($kb_id,$mahasiswa_npm,$dkb_foto){
			$this->db->query("INSERT INTO detail_kandidat_blj VALUES('$mahasiswa_npm','$kb_id','$dkb_foto')");
		}
		public function dkb_view_id($kb_id){
			$query = $this->db->query("SELECT * FROM detail_kandidat_blj, mahasiswa WHERE detail_kandidat_blj.MAHASISWA_NPM = mahasiswa.MAHASISWA_NPM AND detail_kandidat_blj.KB_ID = '$kb_id'");
			return $query;
		}
		public function dkb_view_foto($kb_id,$mahasiswa_npm){
			$query = $this->db->query("SELECT * FROM detail_kandidat_blj WHERE KB_ID = '$kb_id' AND MAHASISWA_NPM = '$mahasiswa_npm'");
			return $query;
		}
		public function dkb_delete($kb_id,$mahasiswa_npm){
			$this->db->query("DELETE FROM detail_kandidat_blj WHERE KB_ID = '$kb_id' AND MAHASISWA_NPM = '$mahasiswa_npm'");
		}


		public function pemira_insert($pemira_id,$pemira_nama,$pemira_angkatan,$pemira_keterangan){
			$this->db->query("INSERT INTO pemira VALUES('$pemira_id','$pemira_nama','$pemira_keterangan','$pemira_angkatan','n')");
		}
		public function pemira_view_all(){
			$query = $this->db->query("SELECT * FROM pemira ORDER BY PEMIRA_ID DESC");
			return $query;
		}
		public function pemira_view_id($pemira_id){
			$query = $this->db->query("SELECT * FROM pemira WHERE PEMIRA_ID = '$pemira_id'");
			return $query;
		}
		public function pemira_insert_kh($pemira_id,$kh_id){
			$this->db->query("UPDATE kandidat_hima SET PEMIRA_ID = '$pemira_id' WHERE KH_ID = '$kh_id'");
		}
		public function pemira_hapus_kh($kh_id){
			$this->db->query("UPDATE kandidat_hima SET PEMIRA_ID = NULL WHERE KH_ID = '$kh_id'");
		}
		public function pemira_insert_kb($pemira_id,$kb_id){
			$this->db->query("UPDATE kandidat_blj SET PEMIRA_ID = '$pemira_id' WHERE KB_ID = '$kb_id'");
		}
		public function pemira_hapus_kb($kb_id){
			$this->db->query("UPDATE kandidat_blj SET PEMIRA_ID = NULL WHERE KB_ID = '$kb_id'");
		}
		public function pemira_edit($pemira_id,$pemira_nama,$pemira_angkatan,$pemira_keterangan){
			$this->db->query("UPDATE pemira SET PEMIRA_NAMA = '$pemira_nama', PEMIRA_ANGKATAN = '$pemira_angkatan', PEMIRA_KETERANGAN = '$pemira_keterangan'");
		}
		public function pemira_aktif($pemira_id){
			$this->db->query("UPDATE pemira SET PEMIRA_STATUS = 'y' WHERE PEMIRA_ID = '$pemira_id'");
		}
		public function pemira_nonaktif($pemira_id){
			$this->db->query("UPDATE pemira SET PEMIRA_STATUS = 'n' WHERE PEMIRA_ID = '$pemira_id'");
		}

		public function pemira_cariaktif(){
			$query = $this->db->query("SELECT * FROM pemira WHERE PEMIRA_STATUS = 'y'");
			return $query;
		}
		public function voting_kh_view($pemira_id){
			$query = $this->db->query("SELECT * FROM kandidat_hima WHERE PEMIRA_ID = '$pemira_id'");
			return $query;
		}
		public function voting_kh_view_kandidat($kh_id){
			$query = $this->db->query("SELECT * FROM detail_kandidat_hima, mahasiswa WHERE detail_kandidat_hima.MAHASISWA_NPM = mahasiswa.MAHASISWA_NPM AND detail_kandidat_hima.KH_ID = '$kh_id' ORDER BY detail_kandidat_hima.DKH_STATUS ASC");
			return $query;
		}

		public function voting_kb_view($pemira_id,$angkatan){
			$query = $this->db->query("SELECT * FROM kandidat_blj, detail_kandidat_blj WHERE kandidat_blj.KB_ID = detail_kandidat_blj.KB_ID AND kandidat_blj.PEMIRA_ID = '$pemira_id' AND SUBSTR(detail_kandidat_blj.MAHASISWA_NPM,1,2) = '$angkatan'");
			return $query;
		}
		public function voting_kb_view_kandidat($kb_id){
			$query = $this->db->query("SELECT * FROM detail_kandidat_blj, mahasiswa WHERE detail_kandidat_blj.MAHASISWA_NPM = mahasiswa.MAHASISWA_NPM AND detail_kandidat_blj.KB_ID = '$kb_id'");
			return $query;
		}


		public function pilihhima($mahasiswa_npm,$kh_id,$waktu){
			$this->db->query("INSERT INTO voting_hima VALUES('$kh_id','$mahasiswa_npm','$waktu')");
		}
		public function caripilihhima($mahasiswa_npm,$kh_id){
			$query = $this->db->query("SELECT * FROM voting_hima WHERE KH_ID = '$kh_id' AND MAHASISWA_NPM = '$mahasiswa_npm'");
			return $query;
		}

		public function caripilihblj($mahasiswa_npm,$kb_id){
			$query = $this->db->query("SELECT * FROM voting_blj WHERE KB_ID = '$kb_id' AND MAHASISWA_NPM = '$mahasiswa_npm'");
			return $query;
		}
		public function pilihblj($mahasiswa_npm,$kb_id,$waktu){
			$this->db->query("INSERT INTO voting_blj VALUES('$mahasiswa_npm','$kb_id','$waktu')");
		}
	}
?>