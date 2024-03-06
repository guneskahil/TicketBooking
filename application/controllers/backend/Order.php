<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper('tglindo_helper');
        $this->load->model('getkod_model');
        $this->getsecurity();
        date_default_timezone_set("Asia/Jakarta");
    }

    function getsecurity($value=''){
        if (empty($this->session->userdata('username_admin'))) {
            $this->session->sess_destroy();
            redirect('backend/login');
        }
    }

    public function index(){
        $data['title'] = "Booking List";
        $data['order'] = $this->db->query("SELECT * FROM siparis group by kd_siparis")->result_array();
        $this->load->view('backend/order', $data);
    }

    public function vieworder($id=''){
        $cek = $this->input->get('order').$id;
        $sqlcek = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer WHERE kd_siparis ='".$cek."' ")->result_array();
        if ($sqlcek) {
            $data['tiket'] = $sqlcek;
            $data['title'] = "View Bookings";
            $this->load->view('backend/view_order',$data);
        } else {
            $this->session->set_flashdata('message', 'swal("Empty", "No Order", "error");');
            redirect('backend/tiket');
        }
    }

    public function inserttiket($value=''){
        $id = $this->input->post('kd_siparis');
        $asal = $this->input->post('asal_beli');
        $tiket = $this->input->post('kd_tiket');
        $nama = $this->input->post('nama');
        $kursi = $this->input->post('no_kursi');
        $umur = $this->input->post('umur_kursi');
        $harga = $this->input->post('harga');
        $tgl = $this->input->post('tgl_beli');
        $status = $this->input->post('status');
        $where = array('kd_siparis' => $id );
        $update = array('durum_siparis' => $status );
        $this->db->update('siparis', $update, $where);
        $data['asal'] = $this->db->query("SELECT * FROM varis WHERE kd_varis ='".$asal."'")->row_array();
        $data['cetak'] = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN varis on sefer.kd_varis = varis.kd_varis WHERE kd_siparis ='".$id."'")->result_array();
        $pelanggan = $this->db->query("SELECT email_musteri FROM musteri WHERE kd_musteri ='".$data['cetak'][0]['kd_musteri']."'")->row_array();
        $pdfFilePath = "assets/backend/upload/etiket/".$id.".pdf";
        $html = $this->load->view('frontend/cetaktiket', $data, TRUE);
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath);
        for ($i=0; $i < count($nama) ; $i++) { 
            $simpan = array(
                'kd_tiket' => $tiket[$i],
                'kd_siparis' => $id,
                'nama_tiket' => $nama[$i],
                'kursi_tiket' => $kursi[$i],
                'umur_tiket' => $umur[$i],
                'asal_beli_tiket' => $asal,
                'harga_tiket' => $harga,
                'status_tiket' => $status,
                'etiket_tiket' => $pdfFilePath,
                'create_tgl_tiket' => date('Y-m-d'),
                'create_admin_tiket' => $this->session->userdata('username_admin')
            );
            $this->db->insert('tiket', $simpan);
        }
        $this->session->set_flashdata('message', 'swal("Succeed", "Ticket Order Processed Successfully", "success");');
        redirect('backend/order');
    }

    public function kirimemail($id=''){
        $data['cetak'] = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN varis on sefer.kd_varis = varis.kd_varis WHERE kd_siparis ='".$id."'")->result_array();
        $asal = $data['cetak'][0]['asal_siparis'];
        $kodeplg = $data['cetak'][0]['kd_musteri'];
        $data['asal'] = $this->db->query("SELECT * FROM varis WHERE kd_varis ='$asal'")->row_array();
        $pelanggan = $this->db->query("SELECT email_musteri FROM musteri WHERE kd_musteri ='$kodeplg'")->row_array();

        $subject = 'E-ticket - Order ID '.$id.' - '.date('dmY');
        $message = $this->load->view('frontend/cetaktiket', $data ,TRUE);
        $attach  = base_url("assets/backend/upload/etiket/".$id.".pdf");
        $to 	= $pelanggan['email_musteri'];
        $config = array(
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'demo@email.com',    // Replace with your Gmail email
               'smtp_pass' => 'P@$$\/\/0RD',      // Replace with your Gmail password
               'smtp_port' => 465,
               'crlf'      => "rn",
               'newline'   => "rn"
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('BTBS');
        $this->email->to($to);
        $this->email->attach($attach);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata('message', 'swal("Succeed", "E-Ticket sent!", "success");');
            redirect('backend/order/vieworder/'.$id);
        } else {
            $this->session->set_flashdata('message', 'swal("Failed", "E-Tickets Failed to Send. Contact the IT Team", "error");');
            redirect('backend/order/vieworder/'.$id);
        }
    }
}
