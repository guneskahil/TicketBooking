<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {
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

    /* Log on to codeastro.com for more projects */
    public function index(){
        $data['title'] = "Bank Yönetimi";
        $data['bank'] = $this->db->query("SELECT * FROM banka")->result_array();
        $this->load->view('backend/bank', $data);    
    }

    public function viewbank($id=""){
        $data['title'] = "Banka Listesi";
        $data['bank'] = $this->db->query("SELECT * FROM banka WHERE kd_banka = '".$id."'")->row_array();
        $this->load->view('backend/view_bank', $data);    
    }

    public function tambahbank()
    {
        $config['upload_path'] = './assets/frontend/img/bank';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')){
            $error = array('error' => $this->upload->display_errors());
            die(print_r($error));
            $this->session->set_flashdata('message', 'swal("Başarısız", "Lütfen Girişinizi Kontrol Edin", "error");');
            redirect('backend/bank');
        } else {
            $upload_data = $this->upload->data();
            $featured_image = '/assets/frontend/img/bank/'.$upload_data['file_name'];
            $kode = $this->getkod_model->get_kodbank();

            $data = [
                'kd_banka' => $kode,
                'musteri_banka' => $this->input->post('nasabah'),
                'isim_banka'     => $this->input->post('bank'),
                'hesapno_banka'  => $this->input->post('nomor'),
                'resim_banka'    => $featured_image
            ];
            
            $this->db->insert('banka', $data);
            $this->session->set_flashdata('message', 'swal("Başarılı", "Banka Verileri Kaydedildi", "success");');
            redirect('backend/bank');
        }
    }
}

/* End of file Bank.php */
/* Location: ./application/controllers/backend/Bank.php */
