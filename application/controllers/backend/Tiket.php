<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket extends CI_Controller {
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
	public function index() {
        $data['title'] = "Bilet Listesi";
        $data['bilet'] = $this->db->query("SELECT * FROM bilet WHERE durum_bilet = '2' ")->result_array();
        $this->load->view('backend/tiket', $data);
    }

    public function viewtiket($bilet) {
        $data['title'] = "Bilet Detayları";
        $data['bilet'] = $this->db->query("SELECT * FROM bilet WHERE kd_bilet = '" . $bilet . "' ")->row_array();
        if ($data['bilet']) {
            $this->load->view('backend/view_tiket', $data);
        } else {
            $this->session->set_flashdata('message', 'swal("Boş", "Bilet bulunamadı", "error");');
            redirect('backend/tiket');
        }
    }

}

/* End of file Tiket.php */
/* Location: ./application/controllers/backend/Tiket.php */