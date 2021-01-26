<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

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
}