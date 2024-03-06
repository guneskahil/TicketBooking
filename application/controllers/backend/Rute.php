<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rute extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('username_admin');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('backend/login');
		}
	}
	public function index(){
		$data['title'] = "Varış/Nihai Durak Listesi";
		$data['tujuan'] = $this->db->query("SELECT * FROM varis")->result_array();
		$this->load->view('backend/tujuan', $data);
	}

	public function viewrute($id=''){
		$data['title'] = "Varış/Nihai Durak Listesi";
		$data['rute'] = $this->db->query("SELECT * FROM varis WHERE kd_varis = '".$id."' ")->row_array();
		$this->load->view('backend/view_tujuan', $data);
	}

	public function tambahtujuan(){
		$kode = $this->getkod_model->get_kodtuj();
		$data = array(
			'sehir_varis' => $this->input->post('tujuan'),
			'kd_varis' => $kode,
			'terminal_varis' => $this->input->post('terminal'),
		);
		$this->db->insert('varis', $data);
		$this->session->set_flashdata('message', 'swal("Veri Başarıyla Eklendi");');
		redirect('backend/rute');
	}
}

/* End of file Rute.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/Rute.php */