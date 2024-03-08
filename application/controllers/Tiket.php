<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('username');
		if (empty($username)) {
			redirect('login');
		}
	}
	public function index(){
		$this->session->unset_userdata(array('jadwal','asal','tanggal'));
		$data['title'] = "Check Schedule";
		$data['asal'] = $this->db->query("SELECT * FROM `varis` ORDER BY sehir_varis ASC ")->result_array();
        $data['tujuan'] = $this->db->query("SELECT * FROM `varis` GROUP BY sehir_varis ORDER BY sehir_varis ASC ")->result_array();
        $data['list'] = $this->db->query("SELECT * FROM `varis` ORDER BY sehir_varis ASC ")->result_array();
		$this->load->view('frontend/cektanggal',$data);
	}
	/* Log on to codeastro.com for more projects */
	public function cektiket($value=''){
		$this->load->view('frontend/cektiket');
	}
	public function cekjadwal($tgl='' , $asl='', $tjn=''){
		$this->session->unset_userdata(array('jadwal','asal','tanggal'));
		$data['title'] = 'Search Tickets';
		$data['tanggal'] = $this->input->get('tanggal').$tgl;
		$asal = $this->input->get('asal').$asl;
		$tujuan = $this->input->get('tujuan').$tjn;
		$data['asal'] = $this->db->query("SELECT * FROM varis
               WHERE kd_varis ='$asal'")->row_array();
		$data['jadwal'] = $this->db->query("SELECT * FROM sefer LEFT JOIN otobus on sefer.kd_otobus = otobus.kd_otobus LEFT JOIN varis on sefer.kd_varis = varis.kd_varis WHERE sefer.sefer_alani ='$tujuan' AND sefer.kd_kalkis = '$asal'")->result_array();
		if (!empty($data['jadwal'])) {
			if ($tujuan == $data['asal']['sehir_varis']) {
				$this->session->set_flashdata('message', 'swal("Cek", "Tujuan dan Asal tidak boleh sama", "error");');
    			redirect('tiket');
			}else{
				for ($i=0; $i < count($data['jadwal']); $i++) { 
					$data['kursi'][$i] = $this->db->query("SELECT count(no_koltuk_siparis) FROM siparis WHERE kd_sefer = '".$data['jadwal'][$i]['kd_sefer']."' AND tarih_kalkis_siparis = '".$data['tanggal']."' AND kalkis_siparis = '".$asal."'")->result_array();
				};
				$this->load->view('frontend/cekjadwal',$data);
			}
		}else{
			$this->session->set_flashdata('message', 'swal("Empty", "No Schedule", "error");');
    		redirect('tiket');
		}
	}
	/* Log on to codeastro.com for more projects */
	public function beforebeli($jadwal="",$asal='',$tanggal=''){
		$array = array(
			'jadwal' => $jadwal,
			'asal'	=> $asal,
			'tanggal'	=> $tanggal
		);
		$this->session->set_userdata($array);
		if ($this->session->userdata('username')){
			$id = $jadwal;
			$asal = $asal;
			$data['tanggal'] = $tanggal;
			$data['asal'] =  $this->db->query("SELECT * FROM varis
               WHERE kd_varis ='".$asal."'")->row_array();
			$data['jadwal'] = $this->db->query("SELECT * FROM sefer LEFT JOIN otobus on sefer.kd_otobus = otobus.kd_otobus LEFT JOIN varis on sefer.kd_varis = varis.kd_varis WHERE kd_sefer ='".$id."'")->row_array();
			$data['kursi'] = $this->db->query("SELECT no_koltuk_siparis FROM siparis WHERE kd_sefer = '".$data['jadwal']['kd_sefer']."' AND tarih_kalkis_siparis = '".$data['tanggal']."' AND kalkis_siparis = '".$asal."'")->result_array();
			$this->load->view('frontend/beli_step1',$data);
		}else{ 
			redirect('login/autlogin');
		}
	}
	public function afterbeli(){
		$data['kursi'] = $this->input->get('kursi');
		$data['bank'] = $this->db->query("SELECT * FROM `banka` ")->result_array();
		$data['kd_sefer'] = $this->session->userdata('jadwal');
		$data['asal'] = $this->session->userdata('asal');
		$data['tglberangkat'] = $this->input->get('tgl');
		if ($data['kursi']) {
			$this->load->view('frontend/beli_step2', $data);
		}else{
			$this->session->set_flashdata('message', 'swal("Empty", "Choose Your Seat", "error");');
			redirect('tiket/beforebeli/'.$data['asal'].'/'.$data['kd_sefer']);
		}
	}
	/* Log on to codeastro.com for more projects */
	public function gettiket($value=''){
	    include 'assets/phpqrcode/qrlib.php';
	    $asal =  $this->db->query("SELECT * FROM varis
               WHERE kd_varis ='".$this->session->userdata('asal')."'")->row_array();		
		$getkode =  $this->getkod_model->get_kodtmporder();
		$kd_sefer = $this->session->userdata('jadwal');
		$kd_pelanggan = $this->session->userdata('kd_pelanggan');
		$tglberangkat = $this->input->post('tgl');
		$jambeli = date("Y-m-d H:i:s");
		$nama =  $this->input->post('nama');
		$kursi = $this->input->post('kursi');
		$tahun = $this->input->post('tahun');
		$no_ktp = $this->input->post('no_ktp');
		$nama_pemesan = $this->input->post('nama_pemesan');
		$hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$bank = $this->input->post('bank');
		$satu_hari        = mktime(0,0,0,date("n"),date("j")+1,date("Y"));
		$expired       = date("d-m-Y", $satu_hari)." ".date('H:i:s');
		$status 		= '1';
		QRcode::png($getkode,'assets/frontend/upload/qrcode/'.$getkode.".png","Q", 8, 8);
		$count = count($kursi);
		$tanggal = hari_indo(date('N',strtotime($jambeli))).', '.tanggal_indo(date('Y-m-d',strtotime(''.$jambeli.''))).', '.date('H:i',strtotime($jambeli));
		for($i=0; $i<$count; $i++) {
			$simpan = array(
				'kd_siparis' => $getkode,
				'kd_tiket' => 'T'.$getkode.$kd_sefer.str_replace('-','',$tglberangkat).$kursi[$i],
				'kd_sefer'	=> $kd_sefer,
				'kd_pelanggan' => $kd_pelanggan,
				'kalkis_siparis' => $asal['kd_varis'],
				'nama_order'	=> $nama_pemesan,
				'tgl_beli_order'	=> $tanggal,
				'tarih_kalkis_siparis' => $tglberangkat,
				'no_koltuk_siparis'		=> $kursi[$i],
				'nama_kursi_order' => $nama[$i],
				'umur_kursi_order' => $tahun[$i],
				'no_ktp_order'	=> $no_ktp,
				'no_tlpn_order'	=> $hp,
				'alamat_order'	=> $alamat,
				'email_order'		=> $email,
				'kd_banka' => $bank,
				'expired_order'	=> $expired,
				'qrcode_order'	=> 'assets/frontend/upload/qrcode/'.$getkode.'.png',
				'durum_siparis'	=> $status
			);
			$this->db->insert('siparis', $simpan);
		}
		redirect('tiket/checkout/'.$getkode);
	}
	/* Log on to codeastro.com for more projects */
	public function cekorder($id=''){
		$id = $this->input->post('kodetiket');
		$sqlcek = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN otobus on sefer.kd_otobus = otobus.kd_otobus LEFT JOIN banka on siparis.kd_banka = banka.kd_banka WHERE kd_siparis ='$id' AND durum_siparis != 3 AND durum_siparis != 2")->result_array();
		if ($sqlcek) {
			$data['tiket'] = $sqlcek;
			$data['count'] = count($sqlcek);
			$this->load->view('frontend/payment',$data);
		}else{
			$this->session->set_flashdata('message', 'swal("Empty", "No Pending Tickets Found", "error");');
    		redirect('tiket/cektiket');
		}
	}
	public function payment($id=''){
		$this->getsecurity();
		$sqlcek = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN otobus on sefer.kd_otobus = otobus.kd_otobus LEFT JOIN banka on siparis.kd_banka = banka.kd_banka WHERE kd_siparis ='$id'")->result_array();
		$data['count'] = count($sqlcek);
		$data['tiket'] = $sqlcek;
		$this->load->view('frontend/payment',$data);
	}
	public function checkout($value=''){
		$this->getsecurity();
		$data['tiket'] = $value;
		$send['sendmail'] = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN varis on sefer.kd_varis = varis.kd_varis LEFT JOIN banka on siparis.kd_banka = banka.kd_banka WHERE kd_siparis ='$value'")->row_array();
		$send['count'] = count($send['sendmail']);
		//email
		$subject = 'BTBS';
		$message = $this->load->view('frontend/sendmail',$send, TRUE);
		$to 	 = $this->session->userdata('email');
        $config = [
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'demo@email.com',    // Ganti dengan email gmail kamu
               'smtp_pass' => 'P@$$\/\/0RD',      // Password gmail kamu
               'smtp_port' => 465,
		   ];
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('BTBS');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
			$this->session->set_flashdata('message', 'swal("Success", "Please proceed towards payment confirmation!", "success");');
            $this->load->view('frontend/checkout', $data);
        } else {
		//    echo 'Error! Send an error email';
		$this->session->set_flashdata('message', 'swal("Success", "Please proceed towards payment confirmation!", "success");');
            $this->load->view('frontend/checkout', $data);
        }
	}
	/* Log on to codeastro.com for more projects */
	public function caritiket(){
		$id = $this->input->post('kodetiket');
		$sqlcek = $this->db->query("SELECT * FROM siparis LEFT JOIN otobus on siparis.kd_otobus = otobus.kd_otobus LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer WHERE kd_siparis ='".$id."'")->result_array();
		if ($sqlcek == NULL) {
			$this->session->set_flashdata('message', 'swal("Kosong", "Tidak Ada Tiket", "error");');
    		redirect('tiket/cektiket');
		}else{
			$data['tiket'] = $sqlcek;
			$this->load->view('frontend/payment', $data);
		}
	}
	public function konfirmasi($value='',$harga=''){
		$this->getsecurity();
		$data['id'] = $value;
		$data['total'] = $harga;
		$this->load->view('frontend/konfirmasi', $data);
	}
	public function insertkonfirmasi($value=''){
		$this->getsecurity();
		$config['upload_path'] = './assets/frontend/upload/payment';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('message', 'swal("Fail", "Check Your Confirmation Again", "error");');
			redirect('tiket/konfirmasi/'.$this->input->post('kd_siparis').'/'.$this->input->post('total'));
		}
		else{
			$upload_data = $this->upload->data();
			$featured_image = '/assets/frontend/upload/payment/'.$upload_data['file_name'];
			$data = array(
						'kd_konfirmasi' => $this->getkod_model->get_kodkon(),
						'kd_siparis'	=> $this->input->post('kd_siparis'),
						'nama_bank_konfirmasi'		=> $this->input->post('bank_km'),
						'nama_konfirmasi' =>  $this->input->post('nama'),
						'norek_konfirmasi'		=> $this->input->post('nomrek'),
						'total_konfirmasi' => $this->input->post('total'),
						'photo_konfirmasi' => $featured_image
					);
			$this->db->insert('tbl_konfirmasi', $data);
			$this->session->set_flashdata('message', 'swal("Success", "Thank you. Please wait for the verification!", "success");');
			redirect('profile/tiketsaya/'.$this->session->userdata('kd_pelanggan'));
		}
	}
	/* Log on to codeastro.com for more projects */
	public function cetak($id=''){
		$this->getsecurity();
		$order = $id;
		$data['cetak'] = $this->db->query("SELECT * FROM siparis LEFT JOIN otobus on siparis.kd_otobus = otobus.kd_otobus LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN varis on sefer.kd_varis = varis.kd_varis WHERE kd_siparis ='".$id."'")->result_array();
		$tiket = $this->db->query("SELECT email_pelanggan FROM tbl_pelanggan WHERE kd_pelanggan ='".$data['cetak'][0]['kd_pelanggan']."'")->row_array();
		die(print_r($tiket));
	}

}

/* End of file Tiket.php */
/* Location: ./application/controllers/Tiket.php */
