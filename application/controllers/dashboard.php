<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));
			// $this->load->model('db_forum');		
		$this->load->model('m_produk');
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
            
            $data['produk']=$this->m_produk->get_all_produk();
			$data['kodeunik'] = $this->m_produk->getkodeunik();
			$this->load->view('admin/header'); 
	        $this->load->view('admin/side_menu',$data);
	        $this->load->view('admin/produk',$data);
	        $this->load->view('admin/footer'); 
            
        }
		
	}
	 
	
	public function produk_add()
		{
			$data = array(
					'id' => $this->input->post('id'),
					'nama_produk' => $this->input->post('nama_produk'),
					'harga' => $this->input->post('harga'),
					// 'tanggal' => $this->input->post('tanggal'),
				);
			$insert = $this->m_produk->produk_add($data);
			echo json_encode(array("status" => TRUE));
		}
	public function ajax_edit($id)
		{
			$data = $this->m_produk->get_by_id($id);
 
 
 
			echo json_encode($data);
		}
	
	public function produk_update()
		{
			$data = array(
					'id' => $this->input->post('id'),
					'nama_produk' => $this->input->post('nama_produk'),
					'harga' => $this->input->post('harga'),
					// 'tanggal' => $this->input->post('tanggal'),
				);
			$this->m_produk->produk_update(array('id' => $this->input->post('id')), $data);
			echo json_encode(array("status" => TRUE));
		}	

	public function produk_delete($id)
		{
			$this->m_produk->delete_by_id($id);
			echo json_encode(array("status" => TRUE));
		}











































	function m_forum(){
		$data['get']=$this->db_forum->m_forum(); 
		$this->load->view('admin/header'); 
		$this->load->view('admin/side_menu');
		$this->load->view('admin/m_forum',$data);
		$this->load->view('admin/footer'); 		
	}
	function add_forum(){
		//form 
		$this->load->view('admin/header'); 
		$this->load->view('admin/side_menu');
		$this->load->view('admin/add_forum');
		$this->load->view('admin/footer'); 	
	}
	function add_forum_action(){
		$name=$this->input->post('forum_name'); 
		$insert=$this->db_forum->add_forum($name); 
			redirect('admin/m_forum'); 
	}
	function add_category(){
		$data['forum']=$this->db_forum->get_forum(); 
		$this->load->view('admin/header'); 
		$this->load->view('admin/side_menu');
		$this->load->view('admin/add_category',$data);
		$this->load->view('admin/footer'); 	
	}
	function add_category_action(){
		$data=array(
				'id_category' => NULL,
				'category_desc' => $this->input->post('category'), 
				'forum_id' => $this->input->post('parent')
			); 
		$this->db_forum->add_category_forum($data); 
		redirect('admin/m_forum'); 
	}

	function m_permis(){
	/*
		$this->load->view('admin/header'); 
		$this->load->view('admin/side_menu');
		$this->load->view('admin/m_permis');
		$this->load->view('admin/footer'); 	
	*/
	}
}
