<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));
		$this->load->helper('url');
	 	$this->load->model('m_customer');
	 	$this->load->model('loginModel');
	}
	public function index()
	{
 		$session = $this->session->userdata('isLogin');
        if($session==FALSE){

            redirect('loginControl/login');

            
        }else{
            $data['session'] = $this->session->userdata('isLogin');
            $username = $this->session->userdata('username');
            $data['user'] = $this->loginModel->get_users($username);
            
            $data['customer']=$this->m_customer->get_all_customer();
            $data['kodeunik'] = $this->m_customer->getkodeunik();
		
			$this->load->view('admin/header'); 
	        $this->load->view('admin/side_menu',$data);
	        $this->load->view('admin/customer',$data);
	        $this->load->view('admin/footer'); 
            
        }
		
	}
	public function customer_add()
		{
			$data = array(
					'id' => $this->input->post('id'),
					'nama_pelanggan' => $this->input->post('nama_pelanggan'),
					'alamat' => $this->input->post('alamat'),
					'email' => $this->input->post('email'),
					'tlp' => $this->input->post('tlp'),
				);
			$insert = $this->m_customer->customer_add($data);
			echo json_encode(array("status" => TRUE));
		}
	public function ajax_edit($id)
		{
			$data = $this->m_customer->get_by_id($id);
 
 
 
			echo json_encode($data);
		}
	
	public function customer_update()
		{
			$data = array(
					'id' => $this->input->post('id'),
					'nama_pelanggan' => $this->input->post('nama_pelanggan'),
					'alamat' => $this->input->post('alamat'),
					'email' => $this->input->post('email'),
					'tlp' => $this->input->post('tlp'),
				);
			$this->m_customer->customer_update(array('id' => $this->input->post('id')), $data);
			echo json_encode(array("status" => TRUE));
		}	

	public function customer_delete($id)
		{
			$this->m_customer->delete_by_id($id);
			echo json_encode(array("status" => TRUE));
		}
}	