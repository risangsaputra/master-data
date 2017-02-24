<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_transaksi');
		$this->load->library(array('form_validation','session'));
		$this->load->model('loginModel');

	}

	function index(){
		$session = $this->session->userdata('isLogin');
        if($session==FALSE){

            redirect('loginControl/login');

            
        }else{
            $data['session'] = $this->session->userdata('isLogin');
            $username = $this->session->userdata('username');
            $data['user'] = $this->loginModel->get_users($username);
			$data['produk'] = $this->m_transaksi->data_produk();
			$data['customer'] = $this->m_transaksi->data_customer();
			$this->load->view('admin/header'); 
			$this->load->view('admin/side_menu',$data);
			$this->load->view('admin/transaksi',$data);
			$this->load->view('admin/footer'); 
            
        }
	}
	function add_transaksi_action(){
		$data=array(
				'kd_transaksi' => NULL,
				'nama_produk' => $this->input->post('nama_produk'), 
				'harga_produk' => $this->input->post('harga_produk'),
				'tgl_transaksi' => $this->input->post('tgl_transaksi'),
				'customer_id' => $this->input->post('customer_id')
			); 
		$this->m_transaksi->add_transaksi($data); 
		redirect('transaksi'); 
	}

	function get_bahan(){
		$id = $this->input->post('id');
		$produk = $this->m_transaksi->get_data_produk($id);
		if(count($produk)>0){
			$pro_select_box = '';
			
			foreach ($produk as $produk) {
				$pro_select_box .=$produk->b_baku;	
			}
			echo json_encode($pro_select_box);
		}
	}
	function get_harga(){
		$id = $this->input->post('id');
		$produk = $this->m_transaksi->get_data_produk($id);
		if(count($produk)>0){
			$pro_select_box = '';
			
			foreach ($produk as $produk) {
				$pro_select_box .='<option value="'.$produk->harga.'">'.$produk->harga.'</option>';	
			}
			echo json_encode($pro_select_box);
		}
	}


}
?>