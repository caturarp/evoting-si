<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kelola extends CI_Controller {

	function __construct() {
	    parent::__construct();
	    $this->load->model('m_admin');
	    if(!empty($this->session->userdata('user_id'))){
	    	if($this->session->userdata('user_level') == "admin"){

	    	}
	    	else{
	    		$this->session->set_flashdata('msg',$this->pesan('danger','Anda bukan admin'));
				redirect('public/login/admin');
	    	}
	    }
	    else{
	    	$this->session->set_flashdata('msg',$this->pesan('danger','Silahkan login dahulu'));
			redirect('public/login/admin');
	    }
	}

	public function index()
	{
		$this->load->view('home');
		
	}

	public function kehadiran($pemira_id){

		$pemira = $this->db->query("SELECT * FROM pemira WHERE PEMIRA_ID = '$pemira_id'")->row();
		$angkatan = explode(",", $pemira->PEMIRA_ANGKATAN);
		$angkatan_query = implode("','", $angkatan);
		//print_r($angkatan_query);

		$mahasiswa = $this->db->query("SELECT * FROM mahasiswa WHERE CONCAT('20',SUBSTR(MAHASISWA_NPM, 1, 2)) IN ('$angkatan_query')");

		echo '
			<table width="100%" border="1" cellspacing="0">
				<thead>
					<tr>
						<th>Barcode</th>
						<th>NPM</th>
						<th>Nama</th>
						<th>Tanda Tangan</th>
					</tr>
				</thead>
				<tbody>';
		foreach($mahasiswa->result() as $row){
			echo '
				<tr>
					<td width="10%"><img src="http://barcodes4.me/barcode/c128b/'.$row->MAHASISWA_NPM.'.png"></td>
					<td><center>'.$row->MAHASISWA_NPM.'</center></td>
					<td>'.$row->MAHASISWA_NAMA.'</td>
					<td></td>
				</tr>
			';
		}
		echo '
				</tbody>
			</table>
		';
	}


	public function mahasiswa(){
		if(isset($_GET['view_all'])){
			$list = '';
			$listmahasiswa = $this->m_admin->mahasiswa_view_all();
			if(empty($listmahasiswa->row())){
				$list = '
					<tr>
						<td colspan="5"><center>Tidak ada data mahasiswa</center></td>
					</tr>
				';
			}
			else{
				$no = 0;
				foreach($listmahasiswa->result() as $row){
					$no++;
					$list .= '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row->MAHASISWA_NPM.'</td>
							<td>'.$row->MAHASISWA_NAMA.'</td>
							<td>'.$row->MAHASISWA_STATUS.'</td>
							<td>
								<button class="btn btn-warning" data-toggle="modal" data-target="#modaledit'.$row->MAHASISWA_NPM.'">Edit</button>
								<button onclick="window.open(\'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='.$row->MAHASISWA_NPM.'\',\'popup\',\'width=300,height=300,left=600\'); return false;" class="btn btn-info"><i class="fas fa-qrcode"></i> QR</button>
								<!-- Modal -->
								<form action="'.base_url().'admin/kelola/mahasiswa/?edit" method="post">
								<div class="modal fade bs-example-modal-sm" id="modaledit'.$row->MAHASISWA_NPM.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  	<div class="modal-dialog modal-sm" role="document">
								    	<div class="modal-content">
								      	<div class="modal-header">
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        	<h4 class="modal-title" id="myModalLabel">Edit Mahasiswa</h4>
								      	</div>
								      	<div class="modal-body">
								        	<div class="form-group">
								        		<label>NPM</label>
								        		<input type="text" name="mahasiswa_npm" id="mahasiswa_npm" value="'.$row->MAHASISWA_NPM.'" class="form-control" readonly>
								        	</div>
								        	<div class="form-group">
								        		<label>Nama</label>
								        		<input type="text" name="mahasiswa_nama" id="mahasiswa_nama" value="'.$row->MAHASISWA_NAMA.'" class="form-control">
								        	</div>
								        	<div class="form-group">
								        		<label>Status</label>
								        		<select name="mahasiswa_status" id="mahasiswa_status" class="form-control">
								        			<option>-- Pilih Status --</option>';
        			if($row->MAHASISWA_STATUS == "0"){
        				$list .= '
    												<option value="1">Aktif</option>
							        				<option value="0" selected>Tidak Aktif</option>
        				';
        			}
        			elseif($row->MAHASISWA_STATUS == "1"){
        				$list .= '
													<option value="1" selected>Aktif</option>
							        				<option value="0">Tidak Aktif</option>
        				';
        			}
					$list .= '
								        		</select>
								        	</div>
								        	<div id="pesan"></div>
								      	</div>
								      	<div class="modal-footer">
								        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        	<input type="submit" class="btn btn-success" value="Simpan">
								      	</div>
								    	</div>
								  	</div>
								</div>
								</form>
							</td>
						</tr>
					';
				}
			}

			$callback = array(
				'list' => $list
			);

			echo json_encode($callback);
		}
		elseif(isset($_GET['insert'])){
			$mahasiswa_npm = $this->input->post('mahasiswa_npm');
			$mahasiswa_nama = $this->input->post('mahasiswa_nama');
			$mahasiswa_status = $this->input->post('mahasiswa_status');
			$carimahasiswa = $this->m_admin->mahasiswa_view_id($mahasiswa_npm);
			if(!empty($carimahasiswa->row())){
				$pesan = '<center><font color="red">NPM Telah Digunakan</font></center>';
			}
			else{
				$this->m_admin->mahasiswa_insert($mahasiswa_npm,$mahasiswa_nama,$mahasiswa_status);
				$pesan = '<center><font color="green">Berhasil ditambahkan</font></center>';
			}

			$callback = array(
				'pesan' => $pesan
			);
			echo json_encode($callback);
		}
		elseif(isset($_GET['edit'])){
			$mahasiswa_npm = $this->input->post('mahasiswa_npm');
			$mahasiswa_nama = $this->input->post('mahasiswa_nama');
			$mahasiswa_status = $this->input->post('mahasiswa_status');

			$this->m_admin->mahasiswa_edit($mahasiswa_npm,$mahasiswa_nama,$mahasiswa_status);
			$this->session->set_flashdata('msg',$this->pesan('success',''.$mahasiswa_npm.' Berhasil diedit'));
			redirect('admin/kelola/mahasiswa');
		}
		elseif(isset($_GET['view_search'])){
			$list = '';
			$search = $this->input->post('search');
			$listmahasiswa = $this->m_admin->mahasiswa_view_search($search);
			if(empty($listmahasiswa->row())){
				$list = '
					<tr>
						<td colspan="5"><center>"'.$search.'" Tidak ditemukan</center></td>
					</tr>
				';
			}
			else{
				$no = 0;
				foreach($listmahasiswa->result() as $row){
					$no++;
					$list .= '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row->MAHASISWA_NPM.'</td>
							<td>'.$row->MAHASISWA_NAMA.'</td>
							<td>'.$row->MAHASISWA_STATUS.'</td>
							<td>
								<button class="btn btn-warning" data-toggle="modal" data-target="#modaledit'.$row->MAHASISWA_NPM.'">Edit</button>
								<button onclick="window.open(\'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='.$row->MAHASISWA_NPM.'\',\'popup\',\'width=300,height=300,left=600\'); return false;" class="btn btn-info"><i class="fas fa-qrcode"></i> QR</button>
								<!-- Modal -->
								<form action="'.base_url().'admin/kelola/mahasiswa/?edit" method="post">
								<div class="modal fade bs-example-modal-sm" id="modaledit'.$row->MAHASISWA_NPM.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  	<div class="modal-dialog modal-sm" role="document">
								    	<div class="modal-content">
								      	<div class="modal-header">
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        	<h4 class="modal-title" id="myModalLabel">Edit Mahasiswa</h4>
								      	</div>
								      	<div class="modal-body">
								        	<div class="form-group">
								        		<label>NPM</label>
								        		<input type="text" name="mahasiswa_npm" id="mahasiswa_npm" value="'.$row->MAHASISWA_NPM.'" class="form-control" readonly>
								        	</div>
								        	<div class="form-group">
								        		<label>Nama</label>
								        		<input type="text" name="mahasiswa_nama" id="mahasiswa_nama" value="'.$row->MAHASISWA_NAMA.'" class="form-control">
								        	</div>
								        	<div class="form-group">
								        		<label>Status</label>
								        		<select name="mahasiswa_status" id="mahasiswa_status" class="form-control">
								        			<option>-- Pilih Status --</option>';
        			if($row->MAHASISWA_STATUS == "0"){
        				$list .= '
    												<option value="1">Aktif</option>
							        				<option value="0" selected>Tidak Aktif</option>
        				';
        			}
        			elseif($row->MAHASISWA_STATUS == "1"){
        				$list .= '
													<option value="1" selected>Aktif</option>
							        				<option value="0">Tidak Aktif</option>
        				';
        			}
					$list .= '
								        		</select>
								        	</div>
								        	<div id="pesan"></div>
								      	</div>
								      	<div class="modal-footer">
								        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        	<input type="submit" class="btn btn-success" value="Simpan">
								      	</div>
								    	</div>
								  	</div>
								</div>
								</form>
							</td>
						</tr>
					';
				}
			}

			$callback = array(
				'list' => $list
			);

			echo json_encode($callback);
		}
		elseif(isset($_POST['btn_upload'])){
			require_once(APPPATH.'libraries/excel_reader2.php');
			$allowed =  array('xls');

			$fileupload_tmp = $_FILES['uploadexcel']['tmp_name'];
			$fileupload_name = $_FILES['uploadexcel']['name'];
			$ext = pathinfo($fileupload_name, PATHINFO_EXTENSION);
			if(!in_array($ext,$allowed) ) {
			    echo 'upload gagal, file harus berformat .xls';
			}
			else{
				//move_uploaded_file($fileupload_tmp, 'assets/uploads/'.$fileupload_name);
				$data = new Spreadsheet_Excel_Reader($fileupload_tmp);
				$sudah = 0;
				$baru = 0;
				$baris = $data->rowcount();	
				for($i=2;$i<=$baris;$i++){
					$npm = $data->val($i,1);
					$nama = $data->val($i,2);

					$cek = $this->db->query("SELECT * FROM mahasiswa WHERE MAHASISWA_NPM = '$npm'");
					if($cek->num_rows() == 0){
						$this->db->query("INSERT INTO mahasiswa(MAHASISWA_NPM,MAHASISWA_NAMA,MAHASISWA_STATUS) VALUE('$npm','$nama','1')");
						$this->db->query("INSERT INTO user(USER_ID,MAHASISWA_NPM,USER_LEVEL,USER_BLOCK) VALUE('$npm','$npm','mahasiswa','n')");
						$this->db->query("UPDATE mahasiswa SET USER_ID = '$npm' WHERE MAHASISWA_NPM = '$npm'");
						$baru++;
					}
					else{
						$sudah++;
					}
				}
			}
			$this->session->set_flashdata('msg',$this->pesan('success','Mahasiswa berhasil ditambahkan, '.$baru.' Baru, '.$sudah.' Sudah ada'));
			redirect('admin/kelola/mahasiswa');

		}
		else{
			$this->load->view('mahasiswa');
		}
	}
	public function kandidat(){
		if(isset($_GET['hima'])){
			if(isset($_POST['btn_tambahkandidat'])){
				$kh_id = $this->input->post('kh_id');
				$kh_nama = $this->input->post('kh_nama');
				$kh_visi = $this->input->post('kh_visi');
				$kh_misi = $this->input->post('kh_misi');
				$cekid = $this->m_admin->kandidat_hima_view_id($kh_id);
				if(!empty($cekid->row())){
					$this->session->set_flashdata('msg',$this->pesan('danger','Id telah digunkan'));
					redirect('public/kelola/kandidat/?hima');
				}
				else{
					$this->m_admin->kandidat_hima_insert($kh_id,$kh_nama,$kh_visi,$kh_misi);
					$this->session->set_flashdata('msg',$this->pesan('success','Kandidat berhasil ditambahkan'));
					redirect('admin/kelola/kandidat/?hima');
				}
			}
			elseif(isset($_GET['kelola'])){
				$kh_id = $this->input->get('kelola');
				$data['himpunan'] = $this->m_admin->kandidat_hima_view_id($kh_id)->result();
				$data['detailhimpunan'] = $this->m_admin->dkh_view_id($kh_id)->result();
				if(isset($_POST['btn_tambah'])){
					$mahasiswa_npm = $this->input->post('mahasiswa_npm');
					$dkh_status = $this->input->post('dkh_status');
					$dkh_foto = addslashes(file_get_contents($_FILES['dkh_foto']['tmp_name']));
					$this->m_admin->dkh_insert($kh_id,$mahasiswa_npm,$dkh_foto,$dkh_status);
					$this->session->set_flashdata('msg',$this->pesan('success','Berhasil menambah kandidat'));
					redirect('admin/kelola/kandidat/?hima&kelola='.$kh_id);
				}
				elseif(isset($_POST['btn_editkandidat'])){
					$kh_id = $this->input->post('kh_id');
					$kh_nama = $this->input->post('kh_nama');
					$kh_visi = $this->input->post('kh_visi');
					$kh_misi = $this->input->post('kh_misi');
					$this->m_admin->kandidat_hima_edit($kh_id,$kh_nama,$kh_visi,$kh_misi);
					$this->session->set_flashdata('msg',$this->pesan('success','Berhasil diubah'));
					redirect('admin/kelola/kandidat/?hima&kelola='.$kh_id);
				}
				elseif(isset($_GET['hapus'])){
					$mahasiswa_npm = $this->input->get('hapus');
					$this->m_admin->dkh_delete($kh_id,$mahasiswa_npm);
					$this->session->set_flashdata('msg',$this->pesan('success','Berhasil menghapus kandidat'));
					redirect('admin/kelola/kandidat/?hima&kelola='.$kh_id);
				}
				else{
					$this->load->view('kandidat_himpunan_detail',$data);
				}
			}
			elseif(isset($_GET['carimhs'])){
				$mahasiswa_npm = $this->input->post('mahasiswa_npm');
				$datamhs = $this->m_admin->mahasiswa_view_id($mahasiswa_npm)->result();
				foreach($datamhs as $row){
					$mahasiswa_nama = $row->MAHASISWA_NAMA;
				}

				$callback = array(
					'nama' => $mahasiswa_nama
				);

				echo json_encode($callback);
			}
			else{
				$data['himpunan'] = $this->m_admin->kandidat_hima_view_all()->result();
				$this->load->view('kandidat_himpunan',$data);
			}
		}
		elseif(isset($_GET['blj'])){
			$data['blj'] = $this->m_admin->kandidat_blj_view_all()->result();
			if(isset($_POST['btn_tambahkandidat'])){
				$kb_id = $this->input->post('kb_id');
				$kb_nama = $this->input->post('kb_nama');
				$kb_visi = $this->input->post('kb_visi');
				$kb_misi = $this->input->post('kb_misi');
				$cekid = $this->m_admin->kandidat_blj_view_id($kb_id);
				if(!empty($cekid->row())){
					$this->session->set_flashdata('msg',$this->pesan('danger','Id telah digunkan'));
					redirect('public/kelola/kandidat/?blj');
				}
				else{
					$this->m_admin->kandidat_blj_insert($kb_id,$kb_nama,$kb_visi,$kb_misi);
					$this->session->set_flashdata('msg',$this->pesan('success','Kandidat berhasil ditambahkan'));
					redirect('admin/kelola/kandidat/?blj');
				}
			}
			elseif(isset($_GET['kelola'])){
				$kb_id = $this->input->get('kelola');
				$data['blj'] = $this->m_admin->kandidat_blj_view_id($kb_id)->result();
				$data['detailblj'] = $this->m_admin->dkb_view_id($kb_id)->result();
				if(isset($_POST['btn_tambah'])){
					$mahasiswa_npm = $this->input->post('mahasiswa_npm');
					$dkb_foto = addslashes(file_get_contents($_FILES['dkb_foto']['tmp_name']));
					$this->m_admin->dkb_insert($kb_id,$mahasiswa_npm,$dkb_foto);
					$this->session->set_flashdata('msg',$this->pesan('success','Berhasil menambah kandidat'));
					redirect('admin/kelola/kandidat/?blj&kelola='.$kb_id);
				}
				elseif(isset($_POST['btn_editkandidat'])){
					$kb_id = $this->input->post('kb_id');
					$kb_nama = $this->input->post('kb_nama');
					$kb_visi = $this->input->post('kb_visi');
					$kb_misi = $this->input->post('kb_misi');
					$this->m_admin->kandidat_blj_edit($kb_id,$kb_nama,$kb_visi,$kb_misi);
					$this->session->set_flashdata('msg',$this->pesan('success','Berhasil diubah'));
					redirect('admin/kelola/kandidat/?blj&kelola='.$kb_id);
				}
				elseif(isset($_GET['hapus'])){
					$mahasiswa_npm = $this->input->get('hapus');
					$this->m_admin->dkb_delete($kb_id,$mahasiswa_npm);
					$this->session->set_flashdata('msg',$this->pesan('success','Berhasil menghapus kandidat'));
					redirect('admin/kelola/kandidat/?blj&kelola='.$kb_id);
				}
				else{
					$this->load->view('kandidat_blj_detail',$data);
				}
			}
			else{
				$this->load->view('kandidat_blj',$data);
			}
		}
		else{
			redirect('admin/kelola/kandidat/?hima');
		}
	}
	public function pemira(){
		$data['pemira'] = $this->m_admin->pemira_view_all()->result();
		if(isset($_POST['btn_tambahpemira'])){
			$pemira_id = $this->input->post('pemira_id');
			$pemira_nama = $this->input->post('pemira_nama');
			$pemira_angkatan = $this->input->post('pemira_angkatan');
			$pemira_keterangan = $this->input->post('pemira_keterangan');
			$this->m_admin->pemira_insert($pemira_id,$pemira_nama,$pemira_angkatan,$pemira_keterangan);
			$this->session->set_flashdata('msg',$this->pesan('success','Berhasil menambah pemira'));
			redirect('admin/kelola/pemira');
		}
		elseif(isset($_GET['detail'])){
			$pemira_id = $this->input->get('detail');
			$data['pemira'] = $this->m_admin->pemira_view_id($pemira_id)->result();
			$data['himpunan'] = $this->m_admin->kandidat_hima_view_all1()->result();
			$data['blj'] = $this->m_admin->kandidat_blj_view_all1()->result();
			$data['himpunanpemira']= $this->m_admin->kandidat_hima_view_all2($pemira_id)->result();
			$data['bljpemira'] = $this->m_admin->kandidat_blj_view_all2($pemira_id)->result();
			if(isset($_POST['btn_tambahkh'])){
				$kh_id = $this->input->post('kh_id');
				$this->m_admin->pemira_insert_kh($pemira_id,$kh_id);
				$this->session->set_flashdata('msg',$this->pesan('success','Berhasil menambah kandidat himpunan'));
				redirect('admin/kelola/pemira/?detail='.$pemira_id);
			}
			elseif(isset($_POST['btn_tambahkb'])){
				$kb_id = $this->input->post('kb_id');
				$this->m_admin->pemira_insert_kb($pemira_id,$kb_id);
				$this->session->set_flashdata('msg',$this->pesan('success','Berhasil menambah kandidat BLJ'));
				redirect('admin/kelola/pemira/?detail='.$pemira_id);
			}
			elseif(isset($_GET['hapushima'])){
				$kh_id = $this->input->get('hapushima');
				$this->m_admin->pemira_hapus_kh($kh_id);
				$this->session->set_flashdata('msg',$this->pesan('success','Berhasil menghapus kandidat himpunan'));
				redirect('admin/kelola/pemira/?detail='.$pemira_id);
			}
			elseif(isset($_GET['hapusblj'])){
				$kb_id = $this->input->get('hapusblj');
				$this->m_admin->pemira_hapus_kb($kb_id);
				$this->session->set_flashdata('msg',$this->pesan('success','Berhasil menghapus kandidat BLJ'));
				redirect('admin/kelola/pemira/?detail='.$pemira_id);
			}
			elseif(isset($_POST['btn_editpemira'])){
				$pemira_id = $this->input->post('pemira_id');
				$pemira_nama = $this->input->post('pemira_nama');
				$pemira_angkatan = $this->input->post('pemira_angkatan');
				$pemira_keterangan = $this->input->post('pemira_keterangan');
				$this->m_admin->pemira_edit($pemira_id,$pemira_nama,$pemira_angkatan,$pemira_keterangan);
				$this->session->set_flashdata('msg',$this->pesan('success','Berhasil mengubah data pemira'));
				redirect('admin/kelola/pemira/?detail='.$pemira_id);
			}
			else{
				$this->load->view('pemira_detail',$data);
			}
		}
		elseif(isset($_GET['aktif'])){
			$pemira_id = $this->input->get('aktif');
			$this->m_admin->pemira_aktif($pemira_id);
			$this->session->set_flashdata('msg',$this->pesan('success','Berhasil mengaktifkan pemira'));
			redirect('admin/kelola/pemira');
		}
		elseif(isset($_GET['nonaktif'])){
			$pemira_id = $this->input->get('nonaktif');
			$this->m_admin->pemira_nonaktif($pemira_id);
			$this->session->set_flashdata('msg',$this->pesan('success','Berhasil menonaktifkan pemira'));
			redirect('admin/kelola/pemira');
		}
		elseif(isset($_GET['hasil'])){
			$pemira_id = $this->input->get('hasil');
			if(isset($_GET['hima'])){
				$data['pemira'] = $this->m_admin->pemira_view_id($pemira_id)->result();
				$this->load->view('pemira_hasil',$data);
			}
			elseif(isset($_GET['blj'])){
				$data['pemira'] = $this->m_admin->pemira_view_id($pemira_id)->result();
				if(isset($_GET['angkatan'])){
					if(isset($_GET['cetakblj'])){
						$this->load->view('cetak_blj',$data);
					}
					else{
						$this->load->view('pemira_hasil_blj_angkatan',$data);
					}
				}
				else{
					$this->load->view('pemira_hasil_blj',$data);
				}
			}
			elseif(isset($_GET['cetakhima'])){
				$data['pemira'] = $this->m_admin->pemira_view_id($pemira_id)->result();
				$this->load->view('cetak_hima',$data);
			}
			else{
				redirect('admin/kelola/pemira/?hasil='.$pemira_id.'&hima');
			}
		}
		else{
			$this->load->view('pemira',$data);
		}
	}
	public function foto($jenis){
		if($jenis == "hima"){
			$kh_id = $this->input->get('kh_id');
			$mahasiswa_npm = $this->input->get('mahasiswa_npm');
			$ambilfoto = $this->m_admin->dkh_view_foto($kh_id,$mahasiswa_npm)->result();
			foreach($ambilfoto as $row){
				header("Content-type: image/png");
				echo $row->DKH_FOTO;
			}
		}
		elseif($jenis == "blj"){
			$kb_id = $this->input->get('kb_id');
			$mahasiswa_npm = $this->input->get('mahasiswa_npm');
			$ambilfoto = $this->m_admin->dkb_view_foto($kb_id,$mahasiswa_npm)->result();
			foreach($ambilfoto as $row){
				header("Content-type: image/png");
				echo $row->DKB_FOTO;
			}
		}
	}
	public function pesan($status,$text){
		if($status == "success"){
			$pesan = '
				<div class="panel panel-success">
					<div class="panel-heading"><i class="fas fa-check-circle"></i> <b>Success</b></div>
					<div class="panel-body">
						'.$text.'
					</div>
				</div>
			';
		}
		elseif($status == "danger"){
			$pesan = '
				<div class="panel panel-danger">
					<div class="panel-heading"><i class="fas fa-times-circle"></i> <b>Error</b></div>
					<div class="panel-body">
						'.$text.'
					</div>
				</div>
			';
		}
		elseif($status == "info"){
			$pesan = '
				<div class="panel panel-info">
					<div class="panel-heading"><i class="fas fa-info-circle"></i> <b>Info</b></div>
					<div class="panel-body">
						'.$text.'
					</div>
				</div>
			';
		}
		elseif($status == "warning"){
			$pesan = '
				<div class="panel panel-warning">
					<div class="panel-heading"><i class="fas fa-info-circle"></i> <b>Warning</b></div>
					<div class="panel-body">
						'.$text.'
					</div>
				</div>
			';
		}
		return $pesan;
	}
	public function coba(){
		echo md5("wearesifo2018");
	}
}