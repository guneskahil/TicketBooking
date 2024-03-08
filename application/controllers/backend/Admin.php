<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		$this->load->library('form_validation');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('level');
		if ($username == '2') {
			$this->session->sess_destroy();
			redirect('backend/login');
		}
	}
	public function index(){
		$data['title'] = "Admin Section";
		$data['admin'] = $this->db->query("SELECT * FROM yonetici")->result_array();
		// die(print_r($data));
		$this->load->view('backend/admin', $data);
	}
	public function daftar(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[yonetici.kullanici_adi_yonetici]',array(
			'required' => 'Email Required.',
			'is_unique' => 'Username Already In Use'
			 ));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',array(
			'required' => 'Email Required.',
			 ));
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|matches[password2]',array(
			'matches' => 'Password Not Same.',
			'min_length' => 'Password Minimal 8 Characters.'
			 ));
		$this->form_validation->set_rules('password2', 'Password2', 'trim|required|matches[password]');
		if ($this->form_validation->run() == false) {
			$data['title'] = "Add Admin";
			$this->load->view('backend/daftar',$data);
		} else {
			// die(print_r($_POST));
			/* Log on to codeastro.com for more projects */
			$kode = $this->getkod_model->get_kodadm();
			$data = array(
				'kd_yonetici' => $kode,
				'isim_yonetici' => $this->input->post('name'),
				'email_yonetici' => $this->input->post('email'),
				'resim_yonetici' => 'assets/backend/img/default.png',
				'kullanici_adi_yonetici' => strtolower($this->input->post('username')),
				'sifre_yonetici' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'seviye_yonetici' => 2,
				'durum_yonetici' => 1,
				'olusturma_tarihi_yonetici' => time()
			);
			$this->db->insert('tbl_admin', $data);
			$this->session->set_flashdata('message', 'swal("Succeed", "Successfully Added Account", "success");');
    		redirect('backend/admin');
		}

	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/backend/Admin.php */