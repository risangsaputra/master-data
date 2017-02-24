<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bbaku extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));		
		$this->load->model('m_bahanbaku');
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
            
            $data['bb']=$this->m_bahanbaku->get_all_bb();
			$data['kodeunik'] = $this->m_bahanbaku->getkodeunik();
			$this->load->view('admin/header'); 
	        $this->load->view('admin/side_menu',$data);
	        $this->load->view('admin/bahan_baku',$data);
	        $this->load->view('admin/footer'); 
            
        }
		
	}
	 
	public function bb_add(){
			$data = array(
					'id' => $this->input->post('id'),
					'nama_bb' => $this->input->post('nama_bb'),
					'harga' => $this->input->post('harga'),
					// 'tanggal' => $this->input->post('tanggal'),
				);
			$insert = $this->m_bahanbaku->bb_add($data);
			echo json_encode(array("status" => TRUE));
		}
	public function ajax_edit($id){
			$data = $this->m_bahanbaku->get_by_id($id);
			echo json_encode($data);
		}
	
	public function bb_update(){
			$data = array(
					'id' => $this->input->post('id'),
					'nama_bb' => $this->input->post('nama_bb'),
					'harga' => $this->input->post('harga'),
					// 'tanggal' => $this->input->post('tanggal'),
				);
			$this->m_bahanbaku->bb_update(array('id' => $this->input->post('id')), $data);
			echo json_encode(array("status" => TRUE));
		}	
	public function bb_delete($id){
			$this->m_bahanbaku->delete_by_id($id);
			echo json_encode(array("status" => TRUE));
		}

}
