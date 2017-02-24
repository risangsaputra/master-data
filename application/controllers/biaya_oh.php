<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biaya_oh extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));		
		$this->load->model('m_oh');
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
            
            $data['oh']=$this->m_oh->get_all_oh();
			$data['kodeunik'] = $this->m_oh->getkodeunik();
			$data['akun'] = $this->m_oh->data_akun();
			$this->load->view('admin/header'); 
	        $this->load->view('admin/side_menu',$data);
	        $this->load->view('admin/oh',$data);
	        $this->load->view('admin/footer'); 
            
        }
		
	}
	 
	public function oh_add(){
			$data = array(
					'id' => $this->input->post('id'),
					'nama_aktivitas' => $this->input->post('nama_aktivitas'),
					'satuan' => $this->input->post('satuan'),
					'kode_akun' => $this->input->post('kode_akun'),
					// 'tanggal' => $this->input->post('tanggal'),
				);
			$insert = $this->m_oh->oh_add($data);
			echo json_encode(array("status" => TRUE));
		}
	public function ajax_edit($id){
			$data = $this->m_oh->get_by_id($id);
			echo json_encode($data);
		}
	
	public function oh_update(){
			$data = array(
					'id' => $this->input->post('id'),
					'nama_aktivitas' => $this->input->post('nama_aktivitas'),
					'satuan' => $this->input->post('satuan'),
					'kode_akun' => $this->input->post('kode_akun'),
				);
			$this->m_oh->oh_update(array('id' => $this->input->post('id')), $data);
			echo json_encode(array("status" => TRUE));
		}	
	public function oh_delete($id){
			$this->m_oh->delete_by_id($id);
			echo json_encode(array("status" => TRUE));
		}

}
