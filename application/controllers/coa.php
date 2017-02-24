<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coa extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));		
		$this->load->model('m_coa');
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
            
            $data['coa']=$this->m_coa->get_all_coa();
			$this->load->view('admin/header'); 
	        $this->load->view('admin/side_menu',$data);
	        $this->load->view('admin/coa',$data);
	        $this->load->view('admin/footer'); 
            
        }
		
	}
	 
	public function coa_add(){
			$data = array(
					'id' => $this->input->post('id'),
					'nama_akun' => $this->input->post('nama_akun'),
					// 'tanggal' => $this->input->post('tanggal'),
				);
			$insert = $this->m_coa->coa_add($data);
			echo json_encode(array("status" => TRUE));
		}
	public function ajax_edit($id){
			$data = $this->m_coa->get_by_id($id);
			echo json_encode($data);
		}
	
	public function coa_update(){
			$data = array(
					'id' => $this->input->post('id'),
					'nama_akun' => $this->input->post('nama_akun'),
					// 'tanggal' => $this->input->post('tanggal'),
				);
			$this->m_coa->coa_update(array('id' => $this->input->post('id')), $data);
			echo json_encode(array("status" => TRUE));
		}	
	public function coa_delete($id){
			$this->m_coa->delete_by_id($id);
			echo json_encode(array("status" => TRUE));
		}

}
