<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
		$this->load->library('form_validation');
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('kullanici_adi_yonetici');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('backend/login');
		}
	}
	public function index(){
		$data['title'] = "Schedule Management";
		$data['jadwal'] = $this->db->query("SELECT * FROM sefer LEFT JOIN otobus ON sefer.kd_otobus = otobus.kd_otobus LEFT JOIN varis ON sefer.kd_kalkis = varis.kd_varis ")->result_array();
		$this->load->view('backend/jadwal', $data);
	}
	public function viewtambahjadwal($value=''){
		$data['title'] = "Add Schedule";
		$data['bus'] = $this->db->query("SELECT * FROM otobus ORDER BY isim_otobus ASC")->result_array();
		$data['tujuan'] = $this->db->query("SELECT * FROM varis ORDER BY sehir_varis ASC")->result_array();
		$this->load->view('backend/tambahjadwal', $data);
	}
	/* Log on to codeastro.com for more projects */
	public function tambahjadwal(){
		$this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required|min_length[5]|max_length[12]');
		if ($this->form_validation->run() ==  FALSE) {
			$data['title'] = "Add Schedule";
			$data['bus'] = $this->db->query("SELECT * FROM otobus ORDER BY isim_otobus ASC")->result_array();
			$data['tujuan'] = $this->db->query("SELECT * FROM varis ORDER BY sehir_varis ASC")->result_array();
			$this->load->view('backend/tambahjadwal', $data);
		} else {
			$asal = $this->input->post('asal');
			$tujuan = $this->db->query("SELECT * FROM varis
               WHERE kd_varis ='".$this->input->post('tujuan')."'")->row_array();
			if ($asal == $tujuan['kd_varis']) {
				$this->session->set_flashdata('message', 'swal("Succeed", "Schedule Goals Cant Be the Same", "error");');
			redirect('backend/jadwal');
			}else{
				$kode = $this->getkod_model->get_kodjad();
				$simpan = array(
					'kd_sefer' => $kode,
					'kd_kalkis' => $asal,
					'kd_varis' => $tujuan['kd_varis'],
					'kd_otobus' => $this->input->post('bus'),
					'sefer_alani' => $tujuan['sehir_varis'],
					'kalkis_saati_sefer' => $this->input->post('berangkat'),
					'varis_saati_sefer' => $this->input->post('tiba'),
					'fiyat_sefer' =>  $this->input->post('harga'),
					 );
			// die(print_r($simpan));
			$this->db->insert('sefer', $simpan);
			$this->session->set_flashdata('message', 'swal("Succeed", "New schedule has been added", "success");');
			redirect('backend/jadwal');
			}
			
		}
		
	}
	public function viewjadwal($id=''){
		$data['title'] = "Destination List";
		$sqlcek = $this->db->query("SELECT * FROM sefer LEFT JOIN otobus ON sefer.kd_otobus = otobus.kd_otobus LEFT JOIN varis ON sefer.kd_varis = varis.kd_varis WHERE kd_sefer ='".$id."'")->row_array();
		if ($sqlcek) {
			$data['asal'] = $this->db->query("SELECT * FROM varis WHERE kd_varis = '".$sqlcek['kd_kalkis']."'")->row_array();
			$data['jadwal'] = $sqlcek;
			$data['title'] = "View Schedule";
			// die(print_r($data));
			$this->load->view('backend/view_jadwal',$data);
	 	}else{
	 		$this->session->set_flashdata('message', 'swal("Failed", "Something Went Wrong. Please Try Again", "error");');
			redirect('backend/jadwal');
	 	}
	}	
}

/* End of file Jadwal.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/Jadwal.php */