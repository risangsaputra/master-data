<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));		
		$this->load->model('m_pekerjaan');
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
            
            $data['pekerjaan']=$this->m_pekerjaan->get_all_pekerjaan();
			$data['kodeunik'] = $this->m_pekerjaan->getkodeunik();
			$this->load->view('admin/header'); 
	        $this->load->view('admin/side_menu',$data);
	        $this->load->view('admin/pekerjaan',$data);
	        $this->load->view('admin/footer'); 
            
        }
		
	}
	 
	public function pekerjaan_add(){
			$data = array(
					'id' => $this->input->post('id'),
					'nama_pekerjaan' => $this->input->post('nama_pekerjaan'),
					'tarif' => $this->input->post('tarif'),
					// 'tanggal' => $this->input->post('tanggal'),
				);
			$insert = $this->m_pekerjaan->pekerjaan_add($data);
			echo json_encode(array("status" => TRUE));
		}
	public function ajax_edit($id){
			$data = $this->m_pekerjaan->get_by_id($id);
			echo json_encode($data);
		}
	
	public function pekerjaan_update(){
			$data = array(
					'id' => $this->input->post('id'),
					'nama_pekerjaan' => $this->input->post('nama_pekerjaan'),
					'tarif' => $this->input->post('tarif'),
					// 'tanggal' => $this->input->post('tanggal'),
				);
			$this->m_pekerjaan->pekerjaan_update(array('id' => $this->input->post('id')), $data);
			echo json_encode(array("status" => TRUE));
		}	
	public function pekerjaan_delete($id){
			$this->m_pekerjaan->delete_by_id($id);
			echo json_encode(array("status" => TRUE));
		}

}
