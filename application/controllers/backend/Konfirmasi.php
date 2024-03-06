<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends CI_Controller {
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
        $data['title'] = "Confirmation List";
        // Tablo adını ve sütun adlarını Türkçe isimlendirmeye göre güncelliyoruz.
        $data['konfirmasi'] = $this->db->query("SELECT * FROM onaylama GROUP BY kd_onaylama")->result_array();
        $this->load->view('backend/konfirmasi', $data);    
    }

    public function viewkonfirmasi($id=''){
        // Tablo adını ve sütun adlarını Türkçe isimlendirmeye göre güncelliyoruz.
        $sqlcek = $this->db->query("SELECT * FROM onaylama WHERE kd_siparis ='".$id."'")->result_array();
        $data['title'] = "View Confirmation";
        if ($sqlcek == NULL) {
            $this->session->set_flashdata('message', 'swal("Empty", "Payments info not received yet!", "error");');
            redirect('backend/order/vieworder/'.$id);
        } else {        
            $data['konfirmasi'] = $sqlcek;
            $this->load->view('backend/view_konfirmasi',$data);
        }
    }   
}

/* End of file Konfirmasi.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/Konfirmasi.php */
